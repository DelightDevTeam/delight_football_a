<?php

namespace Database\Seeders;

use App\Models\Fixture;
use App\Models\League;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leagues = League::with("teams")->get();

        foreach ($leagues as $league) {
            $home_teams =  $league->teams->filter(function ($value, $index) {
                return $index % 2 !== 0;
            })->values();

            $away_teams =  $league->teams->filter(function ($value, $index) {
                return $index % 2 == 0;
            })->values();

            foreach ($home_teams as $index => $home_team) {
                $away_team = data_get($away_teams, $index);

                $date_time = rand(0, 1) ? now()->addHours(rand(0, 48)) : now()->subHours(rand(0, 48));

                if ($away_team) {
                    Fixture::create([
                        'league_id' => $league->id,
                        'home_team_id' => $home_team->id,
                        'away_team_id' => $away_team->id,
                        'raw_date_time' => $date_time,
                        'date_time' => $date_time
                    ]);
                }
            }
        }
    }
}
