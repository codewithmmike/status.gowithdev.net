<?php
namespace App\Services\ApiSports\ParallelTasks;

class StandingTask extends BaseTask
{
    public function fetchApiData(): array
    {
        $leagueId = $this->args['league_id'];
        $season = $this->args['season'];

        return $this->httpClient->getStandings([
            'league' => $leagueId,
            'season' => $season,
        ]);
    }

    public function transformData(array $items): array
    {
        $mappingStandings = [];
        foreach ($items as $item) {
            $leagueId = $this->args['league_id'];
            $season = $this->args['season'];
            foreach ($item['league']['standings'] as $standings) {
                $newStandings = array_map(fn ($standing) => [
                    'league_id' => $leagueId,
                    'season' => $season,
                    ...$standing
                ], $standings);
                $mappingStandings = array_merge($mappingStandings, $newStandings);
            } 
        }
        
        return $mappingStandings;
    }
}