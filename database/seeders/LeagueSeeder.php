<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\League;
use Illuminate\Support\Str;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        League::whereNotNull('slug')->update(['slug' => null]);
        $leagues = League::all();
        foreach ($leagues as $league) {
            $nameVi = null;
            switch ($league->id) {
                case 2:
                    $nameVi = 'Cúp C1';
                    break;

                case 3:
                    $nameVi = 'Europa League';
                    break;

                case 39:
                    $nameVi = 'Ngoại hạng Anh';
                    break;

                case 61:
                    $nameVi = 'Ligue 1';
                    break;

                case 135:
                    $nameVi = 'Serie A';
                    break;

                case 140:
                    $nameVi = 'La Liga';
                    break;

                case 78:
                    $nameVi = 'Bundesliga';
                    break;

                case 340:
                    $nameVi = 'V-League';
                    break;

                default:
                    break;

            }

            $slug = Str::slug($nameVi ?? $league->name, '-');
            $league->slug = $slug;
            
            $league->name_vi = $nameVi;

            try {
                $league->save();
            } catch (\Exception $e) {
                $league->slug = $slug . '-' . $league->id;
                $league->save();
            }
        }
    }
}
