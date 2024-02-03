<?php
namespace App\Services;

use App\Models\Fixture;
use App\Models\League;
use App\Http\Resources\LeagueResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\FixtureResource;
use Illuminate\Database\Eloquent\Collection;

class CommonService extends BaseService
{

    public function getLeagues(): ResourceCollection
    {
        $leagues = League::with('currentSeason')->get();

        return LeagueResource::collection($leagues);
    }

    public function getMatchDetail(Fixture $fixture): array
    {
        $homeTeamId = $fixture->teams['home']['id'];
        $awayTeamId = $fixture->teams['away']['id'];

        $h2hFixtures = Fixture::getLatestHead2HeadFixtures($homeTeamId, $awayTeamId);
        $h2hFixtures = $this->splitMatchesIntoLeagues($h2hFixtures);
        $homeLatest = Fixture::getLatestFixtures($homeTeamId);
        $homeLatest = $this->splitMatchesIntoLeagues($homeLatest);
        $awayLatest = Fixture::getLatestFixtures($awayTeamId);
        $awayLatest = $this->splitMatchesIntoLeagues($awayLatest);

        return [
            'fixture' => new FixtureResource($fixture),
            'h2h' => $h2hFixtures,
            'latest' => [
                'home' => $homeLatest,
                'away' => $awayLatest,
            ],
            'standings' => [],
        ];
    }

    private function splitMatchesIntoLeagues(Collection $h2hFixtures): array
    {
        if ($h2hFixtures->isEmpty()) {
            return [];
        }

        $formattedFixtures = [];
        foreach ($h2hFixtures as $fixture) {
            if (empty($formattedFixtures[$fixture->league_id])) {
                $formattedFixtures[$fixture->league_id] = [
                    'league' => new LeagueResource($fixture->league),
                    'fixtures' => []
                ];
            }
            $formattedFixtures[$fixture->league_id]['fixtures'][] = new FixtureResource($fixture);
        }

        return array_values($formattedFixtures);
    }
}
