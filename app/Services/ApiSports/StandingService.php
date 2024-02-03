<?php
namespace App\Services\ApiSports;

use App\Models\Standing;
use App\Services\ApiSports\ParallelTasks\StandingTask;

class StandingService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Standing::class;
    }

    protected function getBaseParallelTask(): string
    {
        return StandingTask::class;
    }

    protected function handleData(array $response): bool
    {
        if (empty($response)) {
            return false;
        }

        $standings = [];
        foreach ($response as $item) {
            $standing = [
                'league_id' => $item['league_id'],
                'season' => $item['season'],
                'rank' => $item['rank'],
                'team_id' => $item['team']['id'],
                'points' => $item['points'],
                'goalsDiff' => $item['goalsDiff'],
                'group' => $item['group'],
                'form' => $item['form'],
                'status' => $item['status'],
                'description' => $item['description'],
                'all' => $item['all'],
                'home' => $item['home'],
                'away' => $item['away'],
                'team' => $item['team'],
                'update' => $item['update'],
            ];
            unset($item);

            $standings[] = $standing;
        }
        
        return $this->syncBatch($standings, ['season', 'league_id', 'team_id']);
    }
}