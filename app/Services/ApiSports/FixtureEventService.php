<?php
namespace App\Services\ApiSports;

use App\Models\FixtureEvent;
use App\Services\ApiSports\ParallelTasks\FixtureEventTask;

class FixtureEventService extends BaseService
{
    protected function getBaseModel(): string
    {
        return FixtureEvent::class;
    }

    protected function getBaseParallelTask(): string
    {
        return FixtureEventTask::class;
    }

    protected function handleData(array $events): bool
    {
        if (!empty($events)) {
            $this->setLiveReport($events);

            return $this->syncBatch($events, ['unique_combined_columns']);
        }

        return false;
    }
}
