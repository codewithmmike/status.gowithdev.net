<?php
namespace App\Services\ApiSports;

use App\Models\Round;
use App\Models\Fixture;
use App\Services\ApiSports\ParallelTasks\FixtureTask;
use Carbon\Carbon;

class FixtureService extends BaseService
{
    protected function getBaseModel(): string
    {
        return Fixture::class;
    }

    protected function getBaseParallelTask(): string
    {
        return FixtureTask::class;
    }

    protected function handleData(array $items): bool
    {
        if (!empty($items)) {
            $fixtures = [];
            foreach ($items as &$item) {
                $leagueId = $item['league_id'];
                $season = $item['season'];
                $fixture = $item['fixture'];
                $teams = $item['teams'];
                if (!empty($teams['home']['id'])) {
                    $fixture['home_team_id'] = $teams['home']['id'];
                }
                if (!empty($teams['away']['id'])) {
                    $fixture['away_team_id'] = $teams['away']['id'];
                }
                $fixture['teams'] = $teams;
                $fixture['goals'] = $item['goals'];
                $fixture['score'] = $item['score'];
                $fixture['date'] = $fixture['date'] ? Carbon::parse($fixture['date'])->format('Y-m-d H:i:s') : null;

                $round = $item['league']['round'];
                $roundId = Round::where('league_id', $leagueId)
                    ->where('season', $season)
                    ->where('name', $round)
                    ->select('id')
                    ->first()?->id;

                if (!$roundId) {
                    $roundId = Round::create([
                        'league_id' => $leagueId,
                        'season' => $season,
                        'name' => $round,
                        'sync_count' => 0,
                    ])->id;
                }

                $fixture['round'] = $round;
                $fixture['round_id'] = $roundId;
                $fixture['league_id'] = $leagueId;
                $fixture['season'] = $season;
                $fixture['venue_id'] = $fixture['venue']['id'];
                $fixtures[] = $fixture;
                unset($item);
            }

            return $this->syncBatch($fixtures, ['id']);
        }

        return false;
    }
}
