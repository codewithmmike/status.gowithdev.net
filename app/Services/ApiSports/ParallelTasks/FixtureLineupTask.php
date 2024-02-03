<?php
namespace App\Services\ApiSports\ParallelTasks;

class FixtureLineupTask extends BaseTask
{

    public function fetchApiData(): array
    {
        $fixtureId = $this->args['fixture_id'];

        return $this->httpClient->getFixtureLineups([
            'fixture' => $fixtureId,
        ]);
    }

    public function transformData(array $items): array
    {
        return array_map(fn ($item) => [
            'fixture_id' => $this->args['fixture_id'],
            'team_id' => empty($item['team']) ? null : ($item['team']['id'] ?? null),
            'coach_id' => empty($item['coach']) ? null : ($item['coach']['id'] ?? null),
            'team' => $item['team'] ?? null,
            'coach' => $item['coach'] ?? null,
            'formation' => $item['formation'] ?? null,
            'startXI' => $item['startXI'] ?? null,
            'substitutes' => $item['substitutes'] ?? null,
        ], $items);
    }
}
