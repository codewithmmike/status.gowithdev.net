<?php
namespace App\Services\ApiSports\ParallelTasks;

use GuzzleHttp\Client;
use slvler\LiveScoreService\Message\ResponseTransformer;

class HttpClient {
    private $client;
    private $retryCount = 0;
    private const MAX_RETRY_COUNT = 2;
    private const MAX_TIMEOUT = 15; // seconds
    private $timezone = 'Asia/Ho_Chi_Minh';

    public function __construct()
    {
        $this->client = new Client;
    }
    public function get(string $uri, array $params): array
    {
        $host = env('API_SPORT_BASE_URL');
        $baseUri = 'https://' . $host;
        $option = [
            'base_uri' => $baseUri,
            'headers' => [
                "x-rapidapi-host" => $host,
                "x-rapidapi-key" => env('API_SPORT_KEY'),
            ],
            'timeout'         => self::MAX_TIMEOUT,
            'connect_timeout' => self::MAX_TIMEOUT,
            'query' => $params,
        ];

        if (strpos($host, 'rapidapi')) {
            $uri = 'v3/' . $uri;
        }

        try {
            $response = $this->client->request("GET", $uri , $option);
            $transformer = new ResponseTransformer($response);

            return $transformer->toArray();
        } catch (\Exception $e) {
            while ($this->retryCount < self::MAX_RETRY_COUNT) {
                $this->retryCount++;
                $this->get($uri, $params);
            }
        }

        return [];
    }

    public function getFixtureRounds(array $params): array
    {
        return $this->get('fixtures/rounds', $params);
    }

    public function getFixtures(array $params): array
    {
        $params['timezone'] = $this->timezone;

        return $this->get('fixtures', $params);
    }

    public function getFixtureStatistics(array $params): array
    {
        return $this->get('fixtures/statistics', $params);
    }

    public function getFixtureLineups(array $params): array
    {
        return $this->get('fixtures/lineups', $params);
    }

    public function getFixtureEvents(array $params): array
    {
        return $this->get('fixtures/events', $params);
    }

    public function getStandings(array $params): array
    {
        return $this->get('standings', $params);
    }
}
