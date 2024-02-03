<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Models\Season;
use App\Models\Round;
use App\Models\League;
use Illuminate\Console\Command;
use DB;

class CalculateCurrentSeasonRound extends Command
{
    protected $signature = 'calculate-current-season-round';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and set current season and current round for Leagues and Cups';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $timeStart = time();
        $this->info(get_class($this) . ' started at the second(s) ' . $timeStart);
        $leagues = DB::select("SELECT s.league_id, MAX(s.year) as year FROM `seasons` s join leagues l ON l.id = s.league_id GROUP BY s.league_id");

        // Reset current seasons
        Season::where('current', true)->update(['current' => false]);
        // Calculate current season
        foreach ($leagues as $league) {
            Season::where('league_id', $league->league_id)
                ->where('year', $league->year)
                ->update(['current' => true]);
        }

        // Calculate current round
        $leagueIds = League::where('type', League::TYPE_LEAGUE)->pluck('id')->toArray();
        $newLeagues = array_filter($leagues, fn ($item) => in_array($item->league_id, $leagueIds));
        $roundIds = [];
        foreach ($newLeagues as $league) {
            $fixtures = Fixture::where('league_id', $league->league_id)
                ->where('season', $league->year)
                ->whereJsonContains('status->long', Fixture::STATUS_MATCH_FINISHED)
                ->select('round', 'round_id')
                ->groupBy('round', 'round_id')
                ->get();

            if (!$fixtures->isEmpty()) {
                $roundIds[] = $fixtures->sortByDesc('round', SORT_NATURAL)->first()->round_id;
            }
        }
        // Reset current rounds
        Round::where('current', true)->update(['current' => false]);
        Round::whereIn('id', $roundIds)->update(['current' => true]);

        $this->info(get_class($this) . ' is finished. Total seconds: ' . (time() - $timeStart));
    }
}
