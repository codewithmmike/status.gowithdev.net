<?php

namespace App\Http\Controllers\Api;

use App\Services\StandingService;

use App\Http\Controllers\Controller as BaseController;
use App\Models\League;

class StandingController extends BaseController
{
    private StandingService $service;

    public function __construct(StandingService $service)
    {
        $this->service = $service;
    }

    public function index(): array
    {
        return $this->service->index();
    }

    public function getByLeague(int $leagueId): array
    {
        $league = League::with('seasons')->findOrFail($leagueId);

        return $this->service->getByLeagueAndSeason($league);
    }

    public function getByLeagueAndSeason(int $leagueId, int $season): array
    {
        $league = League::with('seasons')->findOrFail($leagueId);

        return $this->service->getByLeagueAndSeason($league, $season);
    }
}
