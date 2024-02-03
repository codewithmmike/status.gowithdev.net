<?php
namespace App\Services\ApiSports;

use App\Models\FixtureStatistics;
use App\Services\ApiSports\ParallelTasks\FixtureStatisticsTask;

class FixtureStatisticsService extends BaseService
{
    protected function getBaseModel(): string
    {
        return FixtureStatistics::class;
    }

    protected function getBaseParallelTask(): string
    {
        return FixtureStatisticsTask::class;
    }

    protected function handleData(array $statistics): bool
    {
        if (!empty($statistics)) {
            $this->setLiveReport($statistics);

            return $this->syncBatch($statistics, ['fixture_id', 'team_id']);
        }

        return false;
    }
}
