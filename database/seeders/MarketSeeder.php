<?php

namespace Database\Seeders;

use App\Models\Fixture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fixtures = Fixture::whereNotStarted()->get();

        foreach ($fixtures as $fixture) {
            $fixture->markets()->create($this->generateData($fixture));
        }
    }

    private function flip()
    {
        return rand(0, 1);
    }

    private function generateData(Fixture $fixture)
    {
        if ($this->flip()) {
            $upper_team_id = $fixture->home_team_id;
            $lower_team_id = $fixture->away_team_id;
        } else {
            $upper_team_id = $fixture->away_team_id;
            $lower_team_id = $fixture->home_team_id;
        }

        $handicapData = $this->generateHandicap();
        $ouData = $this->generateOu();

        if (empty($handicapData) && empty($ouData)) {
            $forceGenerate = rand(0, 1);
            if ($forceGenerate) {
                $handicapData = $this->generateHandicap(true);
            } else {
                $ouData = $this->generateOu(true);
            }
        }


        return array_merge(
            [
                "upper_team_id" => $upper_team_id,
                "lower_team_id" => $lower_team_id,
                "handicap_team_id" => $this->flip() ? $upper_team_id : $lower_team_id,
            ],
            $handicapData,
            $ouData
        );
    }

    private function generateHandicap(bool $force = false)
    {
        if ($this->flip() || $force) {
            $odd = rand(50, 99) / 100;

            return [
                "hdp" => [rand(0, 3), rand(0, 100)],
                "hdp_home" => $odd,
                "hdp_away" => $odd,
            ];
        }

        return [];
    }

    private function generateOu(bool $force = false)
    {
        if ($this->flip() || $force) {
            $odd = rand(50, 99) / 100;

            return [
                "ou" => [rand(0, 3), rand(0, 100)],
                "ou_over" => $odd,
                "ou_under" => $odd,
            ];
        }

        return [];
    }
}
