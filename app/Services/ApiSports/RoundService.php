<?php
namespace App\Services\ApiSports;

use App\Models\Round;
use App\Services\ApiSports\ParallelTasks\RoundTask;


class RoundService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Round::class;
    }

    protected function getBaseParallelTask(): string
    {
        return RoundTask::class;
    }

    protected function handleData(array $rounds): bool
    {
        if (!empty($rounds)) {
            return $this->syncBatch($rounds, ['league_id', 'season', 'name']);
        }

        return false;
    }
}