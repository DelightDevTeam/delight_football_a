<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LeagueTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relations = [];

        $leagues = File::get(storage_path("leagues.json"));

        $leagues = json_decode($leagues, true);

        foreach ($leagues as $league) {
            $db_league = League::create($league);

            $relations[$db_league->id] = [];
        }

        $teams = File::get(storage_path("teams.json"));

        $teams = json_decode($teams, true);

        foreach ($teams as $team) {
            $db_team = Team::create($team);

            $index = array_rand($relations);

            $relations[$index][] = $db_team->id;
        }

        foreach($relations as $league_id => $team_ids) {
            foreach($team_ids as $team_id) {
                DB::table("league_team")->insert([
                    "league_id" => $league_id,
                    "team_id" => $team_id,
                ]);
            }
        }
    }
}
