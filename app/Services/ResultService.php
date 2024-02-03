<?php
namespace App\Services;

use App\Models\Fixture;
use App\Models\Round;
use App\Models\League;
use App\Models\Season;
use App\Http\Resources\LeagueResource;
use App\Http\Resources\FixtureResource;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\RoundResource;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class ResultService extends BaseService
{

    public function getByDate(string $date): array
    {
        $today = Carbon::now()->format('Y-m-d');
        $dateTo = $date . ' 23:59:59';
        if ($date == $today) {
            $dateTo = Carbon::now()->addHours(Fixture::HOURS_COMING)->format('Y-m-d H:i:s');
        }

        $query = Fixture::whereBetween('date', [
            $date . ' 00:00:00',
            $dateTo,
        ])->orderBy('league_id')
        ->orderBy('date', 'asc');

        $fixtures = $query->get();
        if ($fixtures->isEmpty()) {
            return [];
        }

        $items = $this->splitFixturesIntoLeagues($fixtures);
        $leagues = League::with('country')
            ->whereIn('id', array_keys($items))
            ->orderBy('order', 'desc')
            ->get();

        $responseData = [];
        foreach ($leagues as $league) {
            $item = $items[$league->id];
            $item['league'] = new LeagueResource($league);
            $responseData[] = $item;
        }

        return $responseData;
    }

    // public function getByLeagueAndDate(League $league, string $date): array
    // {
    //     $query = Fixture::where('league_id', $league->id)
    //         ->whereBetween('date', [
    //             $date . ' 00:00:00',
    //             $date . ' 23:59:59',
    //         ])->orderBy('league_id')
    //         ->orderBy('date', 'desc');

    //     $fixtures = $query->get();
    //     $items = $this->splitFixturesIntoLeagues($fixtures);

    //     $leagues = League::with('country')
    //         ->whereIn('id', array_keys($items))
    //         ->orderBy('order', 'asc')
    //         ->get();

    //     $responseData = [];
    //     foreach ($leagues as $league) {
    //         $item = $items[$league->id];
    //         $item['league'] = new LeagueResource($league);
    //         $responseData[] = $item;
    //     }

    //     return [
    //         'data' => $responseData
    //     ];
    // }

    private function getCurrentRound($fixtures): Round|null
    {
        $fixture = $fixtures->filter(function ($item) {
            return $item->status['long'] == Fixture::STATUS_MATCH_FINISHED;
        })->sortByDesc('round', SORT_NATURAL)
        ?->first();

        if ($fixture) {
            return Round::findOrFail($fixture->round_id);
        }

        $fixture = $fixtures->filter(function ($item) {
            return $item->status['long'] == Fixture::STATUS_NOT_STARTED;
        })->sortBy('round', SORT_NATURAL)
        ?->first();

        return $fixture ? Round::findOrFail($fixture->round_id) : null;
    }

    public function getByLeague(League $league, int $season = 0): array
    {
        $leagueId = $league->id;
        $currentSeason = Season::getCurrentSeason($leagueId, $season);
        $currentSeason->rounds = $currentSeason->rounds;

        $fixtures = Fixture::getByLeagueAndSeason($leagueId, $currentSeason->year, false);
        if ($fixtures->isEmpty()) {
            return [
                'league' => new LeagueResource($league),
                'current_season' => new SeasonResource($currentSeason),
                'current_round' => null,
                'dates' => [],
            ];
        }

        $items = $this->splitFixturesIntoLeagues($fixtures);
        $formattedLeague = $items[$leagueId];

        if (League::TYPE_LEAGUE == $league->type) {
            $currentRound = $this->getCurrentRound($fixtures);
        }

        return [
            'league' => new LeagueResource($league),
            'current_season' => new SeasonResource($currentSeason),
            'current_round' => isset($currentRound) ? new RoundResource($currentRound) : null,
            'dates' => $formattedLeague['dates'],
        ];
    }

    public function getByLeagueAndSeason(League $league, int $season): array
    {
        return $this->getByLeague($league, $season);
    }

    public function getByLeagueAndRound(League $league, Round $round): array
    {
        $leagueId = $league->id;
        $currentSeason = $round->seasonRelation;
        $currentSeason->rounds = $currentSeason->rounds;
        $fixtures = Fixture::getByLeagueAndRound($leagueId, $round->id, false);
        if ($fixtures->isEmpty()) {
            return [
                'league' => new LeagueResource($league),
                'current_season' => new SeasonResource($currentSeason),
                'current_round' => new RoundResource($round),
                'dates' => [],
            ];
        }

        $items = $this->splitFixturesIntoLeagues($fixtures);
        $formattedLeague = $items[$leagueId];

        return [
            'league' => new LeagueResource($league),
            'current_season' => new SeasonResource($currentSeason),
            'current_round' => new RoundResource($round),
            'dates' => $formattedLeague['dates'],
        ];
    }

    private function splitFixturesIntoLeagues(Collection $fixtures): array
    {
        $items = [];
        foreach ($fixtures as $fixture) {
            $leagueId = $fixture->league_id;
            if (empty($items[$leagueId])) {
                $items[$leagueId] = [
                    'league' => $leagueId,
                    'dates' => []
                ];
            }

            $date = Carbon::parse($fixture->date)->format('Y-m-d');
            if (empty($items[$leagueId]['dates'][$date])) {
                $items[$leagueId]['dates'][$date] = [
                    'date' => $date,
                    'timestamp' => $fixture->timestamp,
                    'matches' => []
                ];
            }

            $items[$leagueId]['dates'][$date]['matches'][] = new FixtureResource($fixture);
        }

        return $items;
    }
}
