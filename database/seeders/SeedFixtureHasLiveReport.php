<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fixture;
use DB;

class SeedFixtureHasLiveReport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventFixtureIds = DB::select('SELECT DISTINCT fixture_id FROM fixture_events');
        $eventFixtureIds = array_map(fn ($item) => $item->fixture_id, $eventFixtureIds);

        $lineupFixtureIds = DB::select('SELECT DISTINCT fixture_id FROM fixture_lineups');
        $lineupFixtureIds = array_map(fn ($item) => $item->fixture_id, $lineupFixtureIds);

        $statisticsFixtureIds = DB::select('SELECT DISTINCT fixture_id FROM fixture_statistics');
        $statisticsFixtureIds = array_map(fn ($item) => $item->fixture_id, $statisticsFixtureIds);

        $this->syncHasLiveReport($eventFixtureIds);
        $this->syncHasLiveReport($lineupFixtureIds);
        $this->syncHasLiveReport($statisticsFixtureIds);
    }

    private function syncHasLiveReport(array $ids)
    {
        $this->command->info('[' . get_class($this) . '] - Sync a number of fixture_ids: ' . count($ids));

        foreach (array_chunk($ids, 1000) as $fixtureIds) {
            Fixture::whereIn('id', $fixtureIds)
                ->where('has_live_report', false)
                ->update(['has_live_report' => true]);
        }
    }
}
