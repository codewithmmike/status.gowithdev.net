<?php
namespace App\Services\ApiSports;

use slvler\LiveScoreService\LiveScoreClient;
use DB;
use App\Models\Season;
use App\Models\Fixture;
use Amp\Future;
use Amp\Parallel\Worker;
use App\Console\Commands\BaseCommand;
use Carbon\Carbon;

abstract class BaseService {
    protected LiveScoreClient $client;
    const LOW_RATE_LIMIT = 10;
    const MAX_PER_PAGE = 50;
    protected int $currentSyncCount = 0;

    public function __construct(LiveScoreClient $liveScoreClient)
    {
        ini_set('memory_limit', '512M');

        $this->client = $liveScoreClient;
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    abstract protected function getBaseModel(): string;

    protected function getCurrentSyncCount(): int
    {
        $latestItem = $this->getBaseModel()::orderBy('updated_at')->first();

        return $latestItem ? $latestItem->sync_count : 0;
    }

    /**
     * Make sure the output data is one-way array
     */
    protected function standardizeSingleItem(array &$data): array
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fillable)) {
                // TODO: log new key here
                unset($data[$key]);
                continue;
            }

            if (is_array($value)) {
                $data[$key] = json_encode($value);
            }
        }

        return $data;
    }

    /**
     * Append the two-way array with more fields, to upsert more data to database
     */
    protected function standardizeListItems(array &$items, array $fields): array
    {
        return array_map(function ($item) use ($fields) {
            $this->standardizeSingleItem($item);
            return array_merge($item, $fields);
        }, $items);
    }

    public function cleanUpSyncProcess(): bool
    {
        return $this->getBaseModel()::where('sync_count', '!=', $this->currentSyncCount + 1)->delete();
    }

    public function syncBatch(array &$batchToBeUpserted, array $uniqueKeys, bool $doIncreaseSyncCount = true): bool
    {
        $startTime = time();
        $entity = $this->getBaseModel();
        $this->log("Start Syncing " . count($batchToBeUpserted) . ' items');

        if (!$this->currentSyncCount) {
            $this->currentSyncCount = $this->getCurrentSyncCount();
        }

        if (empty($this->fillable)) {
            $this->fillable = app($this->getBaseModel())->getFillable();
        }

        $batchToBeUpserted = $this->standardizeListItems($batchToBeUpserted, [
            'sync_count' => $doIncreaseSyncCount ? $this->currentSyncCount + 1 : $this->currentSyncCount
        ]);

        // insert or update a list based on the primary key check
        $status = true;
        foreach (array_chunk($batchToBeUpserted, $this->getBaseModel()::SYNC_BATCH_SIZE) as $chunkedItems) {
            $status = $status && $entity::upsert($chunkedItems, $uniqueKeys);
        }

        $this->log("Finished Syncing " . count($batchToBeUpserted) . ' items. After a total seconds of: ' . (time() - $startTime));

        // reset $batchToBeUpserted after they are inserted to database
        $batchToBeUpserted = [];

        return $status;
    }

    // protected function handleRateLimit(array $rateLimit): void
    // {
    //     if ($rateLimit['remaining'] < self::LOW_RATE_LIMIT) {
    //         $sleepSeconds = $rateLimit['resets_in_seconds'] + 10;
    //         $this->log('Remaining rate limit is low: ' . $rateLimit['remaining']);
    //         $this->log('The script will continue after [' . $sleepSeconds . '] seconds');
    //         sleep($sleepSeconds);
    //     }
    // }

    public function syncWithThreads(array $args): bool
    {
        $type = $args['type'];
        $thread = $args['thread'];
        $indexFrom = $args['index_from'];
        $isLive = $args['is_live'];
        $indexTo = $args['index_to'] ?? 0;
        $onlyCurrent = $args['only_current'];
        $dateFrom = $args['date_from'] ?? '';
        $dateTo = $args['date_to'] ?? '';

        switch ($type) {
            case BaseCommand::TYPE_LEAGUE_SEASON:
                $baseItems = Season::getListOfLeagueSeasons($onlyCurrent);
                $totalItems = count($baseItems);
                break;

            case BaseCommand::TYPE_FIXTURE:
                $query = Fixture::query();
                if ($isLive) {
                    $dateTime = Carbon::now()->subDay();
                    $query->whereBetween('date', [
                        $dateTime->format('Y-m-d H:i:s'),
                        $dateTime->addDay()->format('Y-m-d H:i:s'),
                    ])->where('is_live', true);
                } else if ($dateFrom && $dateTo) {
                    $query->whereBetween('date', [
                        $dateFrom . ' 00:00:00',
                        $dateTo . ' 23:59:39',
                    ]);
                }
                $totalItems = $query->count();
                break;

            default:
                $this->log('Please specify sync type');
                return false;

        }

        if (empty($totalItems)) {
            $this->log('Please sync ' . $type . ' entities first');
            return false;
        }


        $totalBatches = ceil($totalItems / $thread);
        $this->log('There are ' . $totalItems . ' requests need to be synced. Splitted into ' . $totalBatches . ' batches');
        $lastFixtureId = 0;
        for ($batchIndex = 0; $batchIndex < $totalBatches; $batchIndex++) {
            if ($batchIndex < $indexFrom) {
                continue;
            }

            if ($indexTo && $batchIndex > $indexTo) {
                break;
            }

            switch ($type) {
                case BaseCommand::TYPE_FIXTURE:
                    $fixtureQuery = Fixture::select('id')
                        ->orderBy('id')
                        ->limit($thread);
                    if ($lastFixtureId > 0) {
                        $fixtureQuery->where('id', '>', $lastFixtureId);
                    } else {
                        $fixtureQuery->offset($batchIndex * $thread);
                    }

                    if ($isLive) {
                        $dateTime = Carbon::now()->subDay();
                        $fixtureQuery->whereBetween('date', [
                            $dateTime->format('Y-m-d H:i:s'),
                            $dateTime->addDay()->format('Y-m-d H:i:s'),
                        ])->where('is_live', true);
                    } else if ($dateFrom && $dateTo) {
                        $fixtureQuery->whereBetween('date', [
                            $dateFrom . ' 00:00:00',
                            $dateTo . ' 23:59:39',
                        ]);
                    }

                    $chunkedItems = $fixtureQuery->pluck('id')->toArray();
                    $lastFixtureId = max($chunkedItems);
                    break;

                default:
                    $chunkedItems = array_slice($baseItems, $batchIndex * $thread, $thread);
                    break;

            }

            $this->log("Start syncing the batchIndex: {$batchIndex}");
            $executions = [];
            foreach ($chunkedItems as $item) {
                $parallelTaskClass = $this->getBaseParallelTask();
                $taskArgs = $this->getTaskArgs($type, $item);
                $executions[] = Worker\submit(new $parallelTaskClass($taskArgs));
            }

            $timeStart = microtime(true);
            $responses = Future\await(array_map(
                fn (Worker\Execution $e) => $e->getFuture(),
                $executions,
            ));

            $items = array_reduce($responses, fn ($a, $b) => array_merge($a, $b), []);

            $this->handleData($items);
            $totalTime = microtime(true) - $timeStart;
            $this->log("Finish syncing the batchIndex: {$batchIndex}. Total second(s) ". $totalTime);
            if ($totalTime < 1.1) {
                usleep(intval((1.1 - $totalTime) * 1e6));
            }
        }

        return true;
    }

    protected function getTaskArgs(string $type, array|int $item): array
    {
        $taskArgs = [];
        switch ($type) {
            case BaseCommand::TYPE_LEAGUE_SEASON:
                $taskArgs = [
                    'league_id' => $item['league_id'],
                    'season' => $item['year'],
                ];
                break;

            case BaseCommand::TYPE_FIXTURE:
                $taskArgs = [
                    'fixture_id' => $item,
                ];
                break;
        }

        return $taskArgs;
    }

    protected function setLiveReport(array $items): bool
    {
        $fixtureIds = array_map(fn ($item) => $item['fixture_id'], $items);

        return Fixture::setLiveReport(array_unique($fixtureIds));
    }

    public function log(string $message): void
    {
        error_log('[' . $this->getBaseModel() . '] - ' . $message);
    }
}
