<?php

namespace App\Http\Controllers\Api;

use App\Services\LiveScoreService;

use App\Http\Controllers\Controller as BaseController;
use App\Models\League;

class LiveScoreController extends BaseController
{
    private LiveScoreService $service;

    public function __construct(LiveScoreService $service)
    {
        $this->service = $service;
    }

    public function index(): array
    {
        return $this->response($this->service->getByLeagueAndDate(null, null));
    }

    public function getByDate(string $date): array
    {
        return $this->response($this->service->getByLeagueAndDate(null, $date));
    }

    public function getByLeague(int $leagueId): array
    {
        $league = League::with('country')->findOrFail($leagueId);

        return $this->response($this->service->getByLeagueAndDate($league, ''));
    }

    public function getByLeagueAndDate(int $leagueId, string $date): array
    {
        $league = League::with('country')->findOrFail($leagueId);

        return $this->response($this->service->getByLeagueAndDate($league, $date));
    }
}
