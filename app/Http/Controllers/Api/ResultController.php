<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use App\Services\ResultService;
use App\Models\League;
use App\Models\Round;

class ResultController extends BaseController
{
    private ResultService $service;

    public function __construct(ResultService $service)
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
        return $this->response($this->service->getByDate($date));
    }

    public function getByLeague(int $leagueId): array
    {
        $league = League::findOrFail($leagueId);

        return $this->response($this->service->getByLeague($league));
    }

    public function getByLeagueAndSeason(int $leagueId, int $season): array
    {
        $league = League::findOrFail($leagueId);

        return $this->response($this->service->getByLeagueAndSeason($league, $season));
    }

    public function getByLeagueAndRound(int $leagueId, int $roundId): array
    {
        $league = League::with('seasons')->findOrFail($leagueId);
        $round = Round::findOrFail($roundId);

        return $this->response($this->service->getByLeagueAndRound($league, $round));
    }
}
