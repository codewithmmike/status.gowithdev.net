<?php
namespace App\Services\ApiSports\ParallelTasks;

class RoundTask extends BaseTask
{
    public function fetchApiData(): array
    {
        $leagueId = $this->args['league_id'];
        $season = $this->args['season'];

        return $this->httpClient->getFixtureRounds([
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    public function transformData(array $items): array
    {
        return array_map(fn ($name) => [
            'league_id' => $this->args['league_id'],
            'season' => $this->args['season'],
            'name' => $name,
        ], $items);
    }
}