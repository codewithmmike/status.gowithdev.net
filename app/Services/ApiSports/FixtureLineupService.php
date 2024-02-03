<?php
namespace App\Services\ApiSports;

use App\Models\FixtureLineup;
use App\Services\ApiSports\ParallelTasks\FixtureLineupTask;

class FixtureLineupService extends BaseService
{
    protected function getBaseModel(): string
    {
        return FixtureLineup::class;
    }

    protected function getBaseParallelTask(): string
    {
        return FixtureLineupTask::class;
    }

    protected function handleData(array $lineups): bool
    {
        if (!empty($lineups)) {
            $this->setLiveReport($lineups);

            return $this->syncBatch($lineups, ['fixture_id', 'team_id']);
        }

        return false;
    }
}
