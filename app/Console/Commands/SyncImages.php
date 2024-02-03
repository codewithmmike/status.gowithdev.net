<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\Venue;
use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;

class SyncImages extends BaseCommand
{
    const IMAGE_TYPE_LEAGUE = 'leagues';
    const IMAGE_TYPE_COUNTRY = 'countries';
    const IMAGE_TYPE_TEAM = 'teams';
    const IMAGE_TYPE_VENUE = 'venues';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:images {--thread=20} {--index-from=0} {--index-to=0}
        {--only-country} {--only-league} {--only-venue} {--only-team}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync images of teams, leagues, countries, venues from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $timeStart = time();
        $this->log('Start syncing images at second: ' . $timeStart);

        $thread = (int) $this->option('thread');
        if ($thread < 1) {
            throw new \Exception('thread must be a positive integer');
        }
        if ($thread > self::MAX_THREADS) {
            throw new \Exception('the max thread number is ' . self::MAX_THREADS);
        }

        $options = $this->options();

        $indexFrom = (int) $options['index-from'];
        $onlyCountry = $options['only-country'];
        $onlyLeague = $options['only-league'];
        $onlyVenue = $options['only-venue'];
        $onlyTeam = $options['only-team'];
        $args = [
            'type' => $this->getCommandType(),
            'thread' => $thread,
            'index_from' => $indexFrom,
            'only_country' => $onlyCountry,
            'only_league' => $onlyLeague,
            'only_venue' => $onlyVenue,
            'only_team' => $onlyTeam,
        ];

        $indexTo = intval($options['index-to'] ?? 0);
        if (!empty($indexTo) && $indexTo > $indexFrom) {
            $args['index_to'] = $indexTo;
        }
        
        $this->syncWithThreads($args);

        $this->log('Syncing is finished. Total seconds: ' . (time() - $timeStart));
    }
    
    public function syncWithThreads(array $args): void
    {
        if ($args['only_country']) {
            $this->syncCountries($args);
            return;
        }

        if ($args['only_league']) {
            $this->syncLeagues($args);
            return;
        }

        if ($args['only_venue']) {
            $this->syncVenues($args);
            return;
        }

        if ($args['only_team']) {
            $this->syncTeams($args);
            return;
        }
        
        $this->syncCountries($args);
        $this->syncLeagues($args);
        $this->syncVenues($args);
        $this->syncTeams($args);
    }

    private function syncCountries(array $args): void
    {
        $countries = Country::whereNotNull('flag')
            ->orderBy('id', 'asc')
            ->selectRaw('id, flag as image_url')
            ->get();
        $this->syncImages($countries, self::IMAGE_TYPE_COUNTRY, $args['thread'], $args['index_from'], $args['index_to'] ?? 0);
    }

    private function syncLeagues(array $args): void
    {
        $leagues = League::whereNotNull('logo')
            ->orderBy('id', 'asc')
            ->selectRaw('id, logo as image_url')
            ->get();
        $this->syncImages($leagues, self::IMAGE_TYPE_LEAGUE, $args['thread'], $args['index_from'], $args['index_to'] ?? 0);
    }

    private function syncVenues(array $args): void
    {
        $venues = Venue::whereNotNull('image')
            ->orderBy('id', 'asc')
            ->selectRaw('id, image as image_url')
            ->get();
        $this->syncImages($venues, self::IMAGE_TYPE_VENUE, $args['thread'], $args['index_from'], $args['index_to'] ?? 0);
    }

    private function syncTeams(array $args): void
    {
        $teams = Team::whereNotNull('logo')
        ->orderBy('id', 'asc')
        ->selectRaw('id, logo as image_url')
        ->get();
        $this->syncImages($teams, self::IMAGE_TYPE_TEAM, $args['thread'], $args['index_from'], $args['index_to'] ?? 0);
    }

    private function syncImages(Collection $items, string $imageType, int $thread, int $indexFrom, int $indexTo): void
    {
        $host = env('API_SPORT_BASE_URL');
        $headers = [
            "x-rapidapi-host" => $host,
            "x-rapidapi-key" => env('API_SPORT_KEY'),
        ];

        $this->prefixLog = $imageType;
        $retryItems = new Collection();
        $chunkedItems = $items->chunk($thread);
        $this->log('There are ' . $chunkedItems->count() . ' batches to be synced', $imageType);
        foreach ($chunkedItems as $index => $batches) {
            if ($index < $indexFrom) {
                continue;
            }
            if ($indexTo && $index > $indexTo) {
                break;
            }
            $batchTimeStart = time();
            $this->log('Start syncing the batch #: ' . $index, $imageType);

            // Fetch images
            $responses = Http::pool(function (Pool $pool) use ($headers, $batches) {
                $logoResponses = [];
                foreach ($batches as $team) {
                    $logoResponses[] = $pool->as($team->id)->withHeaders($headers)->retry(2, 100)->get($team->image_url);
                }

                return $logoResponses;
            });

            // save images
            foreach ($batches as $item) {
                try {
                    $logoRes = $responses[$item->id];
                    if (!$logoRes->ok()) {
                        $retryItems->push($item);
                    } else {
                        $this->saveImage($item, $logoRes, $imageType);
                    }
                } catch (\Throwable $e) {
                    $retryItems->push($item);
                }
            }

            $this->log('Finish syncing the batch #: ' . $index . '. Total seconds: ' . (time() - $batchTimeStart), $imageType);
        }

        if ($retryItems->isNotEmpty()) {
            $this->log('Retry ' . $retryItems->count() . ' items', $imageType);
            $this->syncImages($retryItems, $imageType, $thread, $indexFrom, $indexTo);
        }
    }

    private function saveImage(Model $item, Response $imageResponse, string $imageType): void
    {
        $filePath = "images/{$imageType}/" . basename($item->image_url);
        Storage::disk('public')->put($filePath, $imageResponse->body());

        switch ($imageType) {
            case self::IMAGE_TYPE_COUNTRY:
                $item->local_flag = $filePath;
                break;

            case self::IMAGE_TYPE_VENUE:
                $item->local_image = $filePath;
                break;

            case self::IMAGE_TYPE_LEAGUE:
                $item->local_logo = $filePath;
                break;

            case self::IMAGE_TYPE_TEAM:
                $item->local_logo = $filePath;
                break;
        }
        
        $item->save();
    }
}
