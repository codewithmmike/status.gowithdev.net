<?php
namespace App\Services;

use App\Models\Fixture;
use App\Models\League;
use App\Http\Resources\LeagueResource;
use App\Http\Resources\FixtureResource;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class LiveScoreService extends BaseService
{

    /**
     * For livescore
     */
    public function getByLeagueAndDate(League|null $league, string|null $date): array
    {
        if (empty($date)) {
            $yesterday = Carbon::now()->subDay(1)->format('Y-m-d');
            $tomorrow = Carbon::now()->addDay(1)->format('Y-m-d');
            $fromDate = $yesterday . ' 00:00:00';
            $toDate = $tomorrow . ' 23:59:59';
        } else {
            $fromDate = $date . ' 00:00:00';
            $toDate = $date . ' 23:59:59';
        }

        $query = Fixture::with('league', 'league.country')
            ->whereBetween('date', [
                $fromDate,
                $toDate
            ])->orderBy('date', 'asc');

        if ($league) {
            $query->where('league_id', $league->id);
        }

        $fixtures = $query->get();
        $responseData = $this->splitfixturesIntoDates($fixtures);

        return array_values($responseData);
    }

    private function splitFixturesIntoDates(Collection $fixtures): array
    {
        $items = [];
        foreach ($fixtures as $fixture) {
            $leagueId = $fixture->league_id;
            $date = Carbon::parse($fixture->date)->format('Y-m-d');
            if (empty($items[$date])) {
                $items[$date] = [
                    'date' => $date,
                    'timestamp' => $fixture->timestamp,
                    'leagues' => []
                ];
            }

            $date = Carbon::parse($fixture->date)->format('Y-m-d');
            if (empty($items[$date]['leagues'][$leagueId])) {
                $items[$date]['leagues'][$leagueId] = [
                    'league' => new LeagueResource($fixture->league),
                    'matches' => []
                ];
            }

            $items[$date]['leagues'][$leagueId]['matches'][] =  new FixtureResource($fixture);
        }

        return $items;
    }
}
