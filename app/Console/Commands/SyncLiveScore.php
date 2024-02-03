<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use App\Services\ApiSports\LiveScoreService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Carbon;
use App\Models\Fixture;

class SyncLiveScore extends BaseCommand
{
    private LiveScoreService $service;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:livescores {--thread=10} {--date-from=} {--date-to=} {--live}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync livescores from the ApiSports 3rd party api';

    /**
     * Execute the console command.
     */
    public function handle(LiveScoreService $service): void
    {
        $this->service = $service;
        $timeStart = time();
        $this->log('Start syncing livescore at second: ' . $timeStart);

        $options = $this->options();
        $isLive = $options['live'] ?? false;
        $thread = (int) $options['thread'];
        if ($thread < 1) {
            throw Exception('Invalid the --thread option. It should be larger than 0');
        }

        if ($isLive) {
            $this->syncLiveScore();
        } else {
            $dateFrom = $options['date-from'] ?? '';
            $dateTo = $options['date-to'] ?? '';

            $dateArr = [];
            if ($dateFrom && $dateFrom <= $dateTo) {
                $dateTimeFrom = Carbon::parse($dateFrom);
                $dateTimeTo = Carbon::parse($dateTo);
                while ($dateTimeFrom <= $dateTimeTo) {
                    $dateArr[] = $dateTimeFrom->format('Y-m-d');
                    $dateTimeFrom->addDay();
                }
            } else {
                $dateTime = Carbon::now();
                $dateArr[] = $dateTime->format('Y-m-d');
            }

            foreach (array_chunk($dateArr, $thread) as $dates) {
                $this->syncLivescoresByDate($dates);
            }
        }

        $this->log('Finish syncing livescore. Total seconds: ' . (time() - $timeStart));
    }

    private function syncLiveScore()
    {
        $tz = config('app.timezone');
        $host = env('API_SPORT_BASE_URL');
        $headers = [
            "x-rapidapi-host" => $host,
            "x-rapidapi-key" => env('API_SPORT_KEY'),
        ];
        $endpoint = 'https://' . $host . '/v3/fixtures?timezone=' . $tz . '&live=all';

        $response = Http::withHeaders($headers)->retry(2, 100)->get($endpoint);
        if ($response->ok()) {
            $responseData = $response->json()['response'] ?? [];
            // Reset live fixtures
            $this->resetLiveFixtureItems();
            $responseData = array_map(function ($item) {
                $item['fixture']['is_live'] = true;
                return $item;
            }, $responseData);

            $this->service->sync($responseData);
        }
    }

    private function resetLiveFixtureItems()
    {
        $dateTime = Carbon::now();
        $dateTimeTo = $dateTime->format('Y-m-d H:i:s');
        $dateTimeFrom = $dateTime->subHours(12)->format('Y-m-d H:i:s');

        Fixture::where('is_live', true)
            ->whereBetween('date', [
                $dateTimeFrom,
                $dateTimeTo
            ])
            ->update(['is_live' => false]);
    }

    private function syncLivescoresByDate(array $dates): void
    {
        $tz = config('app.timezone');
        $host = env('API_SPORT_BASE_URL');
        $headers = [
            "x-rapidapi-host" => $host,
            "x-rapidapi-key" => env('API_SPORT_KEY'),
        ];

        $endpoint = 'https://' . $host . '/v3/fixtures?timezone=' . $tz . '&date=';
        $dateUrls = array_map(fn ($date) => $endpoint . $date, $dates);

        // Fetch images
        $responses = Http::pool(function (Pool $pool) use ($headers, $dateUrls) {
            $fixtureResponses = [];
            foreach ($dateUrls as $dateUrl) {
                $fixtureResponses[] = $pool->withHeaders($headers)->retry(2, 100)->get($dateUrl);
            }

            return $fixtureResponses;
        });

        $responseData = [];
        $retryDates = [];
        foreach ($dates as $index => $date) {
            $response = $responses[$index];
            if (!$response->ok()) {
                $retryDates[] = $date;
            } else {
                $responseData = array_merge($responseData, $response->json()['response'] ?? []);
            }
        }
        $this->service->sync($responseData);

        if (!empty($retryDates)) {
            $this->log('Retry ' . count($retryDates) . ' items');
            $this->syncLivescoresByDate($retryDates);
        }

        $updateFixtureIds = array_map(fn ($item) => $item['fixture']['id'], $responseData);
        $fixtureIds = $this->getFixtureIdsByDateRange($dates[0], end($dates));
        $willDeleteFixtureIds = array_diff($fixtureIds, $updateFixtureIds);

        Fixture::whereIn('id', $willDeleteFixtureIds)->delete();
    }

    private function getFixtureIdsByDateRange(string $dateFrom, string $dateTo): array
    {
        return Fixture::whereBetween('date', [
            $dateFrom . ' 00:00:00',
            $dateTo . ' 23:59:59'
        ])->pluck('id')->toArray();
    }

}
