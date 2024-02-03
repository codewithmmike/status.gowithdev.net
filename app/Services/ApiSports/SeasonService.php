<?php
namespace App\Services\ApiSports;

use App\Models\Season;

class SeasonService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Season::class;
    }
}