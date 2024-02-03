<?php
namespace App\Services\ApiSports\ParallelTasks;

class FixtureTask extends BaseTask
{

    public function fetchApiData(): array
    {
        $leagueId = $this->args['league_id'];
        $season = $this->args['season'];

        return $this->httpClient->getFixtures([
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    public function transformData(array $items): array
    {
        return array_map(fn ($item) => [
            'league_id' => $this->args['league_id'],
            'season' => $this->args['season'],
            ...$item
        ], $items);
    }
}