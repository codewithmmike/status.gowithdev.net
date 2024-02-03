<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fixture;

class FixtureHomeAwayTeamIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->syncHomeAwayTeamIds(492603);
        // Error: 61305, 61316, 61327, 61337, 61340, 61346, 61348, 61354, 61355, 117899, 117906
    }

    private function syncHomeAwayTeamIds(int $initialId = 0, int $limit = 1000)
    {
        $fixtures = Fixture::where('id', '>', $initialId)
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->get();

        if (empty($fixtures)) {
            return;
        }

        $lastFixtureId = 0;
        foreach ($fixtures as $fixture) {
            if (!empty($fixture->teams['home'])) {
                $fixture->home_team_id = $fixture->teams['home']['id'];
            }

            if (!empty($fixture->teams['away'])) {
                $fixture->away_team_id = $fixture->teams['away']['id'];
            }
            $status = $fixture->save();
            $lastFixtureId = $fixture->id;
        }
        unset($fixtures);
        $this->syncHomeAwayTeamIds($lastFixtureId, $limit);
    }
}
