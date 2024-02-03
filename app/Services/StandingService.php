<?php
namespace App\Services;

use App\Models\Standing;
use App\Models\Season;
use App\Models\League;
use App\Http\Resources\LeagueResource;
use App\Http\Resources\StandingResource;
use App\Http\Resources\SeasonResource;
use Illuminate\Database\Eloquent\Collection;

class StandingService extends BaseService
{
    const STANDING_LIMIT = 8;

    public function index(): array
    {
        $responseData = [];
        $popularLeagues = config('leagues.popular_leagues');
        $leagues = League::whereIn('id', $popularLeagues)->get();

        foreach ($leagues as $league) {
            $season = Season::getCurrentSeason($league->id, 0)->year;
            $standings = Standing::getBySeasonLeague($season, $league->id, self::STANDING_LIMIT);
            $responseData[] = [
                'league' => new LeagueResource($league),
                'standings' => $this->splitStandingsIntoGroups($standings)
            ];
        }

        return [
            'data' => $responseData
        ];
    }

    public function getByLeagueAndSeason(League $league, int $season = 0): array
    {
        if (!$season) {
            $season = Season::where('league_id', $league->id)->current()->firstOrFail();
        } else {
            $season = Season::where('league_id', $league->id)->where('year', $season)->firstOrFail();
        }
        $standings = Standing::getBySeasonLeague($season->year, $league->id);
        $colorInfo = config('leagues.color_info');

        return [
            'data' => [
                'league' => new LeagueResource($league),
                'season' => new SeasonResource($season),
                'color_info' => $colorInfo[$league->id] ?? [],
                'standings' => $this->splitStandingsIntoGroups($standings)
            ]
        ];
    }

    private function splitStandingsIntoGroups(Collection $standings): array
    {
        $standingGroups = [];
        $group = null;
        foreach ($standings as $standing) {
            if (empty($group)) {
                $group = [
                    'group' => $standing->group,
                    'items' => []
                ];
            }

            if ($standing->group === $group['group']) {
                $group['items'][] = new StandingResource($standing);
            } else {
                $standingGroups[] = $group;
                // create new group
                $group = [
                    'group' => $standing->group,
                    'items' => [new StandingResource($standing)]
                ];
            }
        }
        $standingGroups[] = $group;

        return $standingGroups;
    }
}
