<?php
namespace App\Services\ApiSports\ParallelTasks;

class FixtureEventTask extends BaseTask
{

    public function fetchApiData(): array
    {
        $fixtureId = $this->args['fixture_id'];

        return $this->httpClient->getFixtureEvents([
            'fixture' => $fixtureId,
        ]);
    }

    public function transformData(array $items): array
    {
        $fixtureId = $this->args['fixture_id'];
        return array_map(function ($item) use ($fixtureId) {
            $timeElapsed = empty($item['time']) ? null : ($item['time']['elapsed'] ?? null);
            $teamId = empty($item['team']) ? null : ($item['team']['id'] ?? null);
            $playerId = empty($item['player']) ? null : ($item['player']['id'] ?? null);
            $assistId = empty($item['assist']) ? null : ($item['assist']['id'] ?? null);
            $uniqueCombinedColumns = "{$fixtureId}_{$teamId}_{$playerId}_{$assistId}_{$timeElapsed}_{$item['type']}";

            return [
                'fixture_id' => $fixtureId,
                'time_elapsed' => $timeElapsed,
                'team_id' => $teamId,
                'player_id' => $playerId,
                'assist_id' => $assistId,
                'unique_combined_columns' => $uniqueCombinedColumns,
                ...$item
            ];
        }, $items);
    }
}
