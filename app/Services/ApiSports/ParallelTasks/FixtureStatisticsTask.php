<?php
namespace App\Services\ApiSports\ParallelTasks;

class FixtureStatisticsTask extends BaseTask
{

    // public function getDataByLeagueSeason(array $params): array
    // {
    //     return $this->httpClient->getFixtures($params);
    // }

    public function fetchApiData(): array
    {
        $fixtureId = $this->args['fixture_id'];

        return $this->httpClient->getFixtureStatistics([
            'fixture' => $fixtureId,
        ]);
    }

    public function transformData(array $items): array
    {
        $typeColumns = [
            'shots_on_goal',
            'shots_off_goal',
            'total_shots',
            'blocked_shots',
            'shots_insidebox',
            'shots_outsidebox',
            'fouls',
            'corner_kicks',
            'offsides',
            'ball_possession',
            'yellow_cards',
            'red_cards',
            'goalkeeper_saves',
            'total_passes',
            'passes_accurate',
            'passes_%',
        ];
        $standardColumns = [];
        array_map(function ($column) use (&$standardColumns) {
            $standardColumns[$column] = null;
        }, $typeColumns);

        $fixtureId = $this->args['fixture_id'];
        return array_map(function ($item) use ($fixtureId, $standardColumns) {
            $statistics = array_merge($standardColumns, [
                'fixture_id' => $fixtureId,
                'team_id' => $item['team']['id']
            ]);

            foreach ($item['statistics'] as $type) {
                $name = strtolower(str_replace(' ', '_', $type['type']));
                $statistics[$name] = $type['value'];
            }

            return $statistics;
        }, $items);
    }
}
