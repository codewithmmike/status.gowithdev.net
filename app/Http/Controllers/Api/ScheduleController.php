<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use App\Services\ScheduleService;
use App\Models\League;
use App\Models\Round;

class ScheduleController extends BaseController
{
    private ScheduleService $service;

    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }

    public function index(): array
    {
        $today = date('Y-m-d');

        return $this->response($this->service->getByDate($today));
    }

    public function getByDate(string $date): array
    {
        // $date = date('Y-m-d');

        return $this->response($this->service->getByDate($date));
    }

    public function getByLeague(int $leagueId): array
    {
        $league = League::findOrFail($leagueId);

        return $this->response($this->service->getByLeague($league));
    }

    // public function getByLeagueAndDate(int $leagueId, string $date): array
    // {
    //     $league = League::findOrFail($leagueId);

    //     return $this->service->getByLeagueAndDate($league, $date, true);
    // }

    public function getByLeagueAndRound(int $leagueId, int $roundId): array
    {
        $league = League::with('seasons')->findOrFail($leagueId);
        $round = Round::findOrFail($roundId);

        return $this->response($this->service->getByLeagueAndRound($league, $round));
    }
}
