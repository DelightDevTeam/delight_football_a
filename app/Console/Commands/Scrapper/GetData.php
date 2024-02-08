<?php

namespace App\Console\Commands\Scrapper;

use App\Http\Integrations\Scrapper\Requests\ScrapperMarketRequest;
use App\Http\Integrations\Scrapper\ScrapperConnector;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Market;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:get-markets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $connector = new ScrapperConnector;

        $request = new ScrapperMarketRequest;
        
        $response = $connector->send($request);

        $data = $response->json();

        if ($data["success"] == true && $data['data']) {
            $this->processLeagues($data['data']['leagues']);
        }
    }

    protected function processLeagues(array $leagues)
    {
        $defaultMMOdd = config('system.default_mm_odd');

        foreach ($leagues as $league) {
            $dbLeague = $this->createOrUpdateLeague($league);

            foreach ($league['fixtures'] as $fixture) {
                $dbHomeTeam = $this->createOrUpdateTeam($fixture['home_team'], $dbLeague);
                $dbAwayTeam = $this->createOrUpdateTeam($fixture['away_team'], $dbLeague);
                $dbFixture = $this->createOrUpdateFixture($fixture, $dbLeague, $dbHomeTeam, $dbAwayTeam);
                if (!$dbFixture->stop_update && !$dbFixture->manually_updated && count($fixture['markets'])) {
                    $this->createMarket($fixture['markets'][0], $dbHomeTeam, $dbAwayTeam, $dbFixture, $defaultMMOdd);
                }
            }
        }
    }

    protected function createOrUpdateLeague(array $leagueData)
    {
        return League::firstOrCreate(
            [
                'scraper_id' => $leagueData['id'],
                'name' => $leagueData['name'],
            ],
            [
                'scraper_id' => $leagueData['id'],
                'name' => $leagueData['name'],
            ]
        );
    }

    protected function createOrUpdateTeam(array $teamData, League $dbLeague)
    {
        $scraperTeam = Team::firstOrCreate(
            [
                'scraper_id' => $teamData['id'],
                'name' => $teamData['name'],
            ],
            [
                'scraper_id' => $teamData['id'],
                'name' => $teamData['name'],
            ]
        );

        $dbLeague->teams()->syncWithoutDetaching($scraperTeam->id);

        return $scraperTeam;
    }

    protected function createOrUpdateFixture(array $fixtureData, League $dbLeague, Team $dbHomeTeam, Team $dbAwayTeam)
    {
        $scraperFixture = Fixture::firstOrCreate(
            [
                'scraper_id' => $fixtureData['id'],
                'league_id' => $dbLeague->id,
                'home_team_id' => $dbHomeTeam->id,
                'away_team_id' => $dbAwayTeam->id,
            ],
            [
                'scraper_id' => $fixtureData['id'],
                'league_id' => $dbLeague->id,
                'home_team_id' => $dbHomeTeam->id,
                'away_team_id' => $dbAwayTeam->id,
                'raw_date_time' => $fixtureData['raw_date_time'],
                'date_time' => $fixtureData['date_time'],
                'est_finished_date_time' => Carbon::parse($fixtureData['date_time'])->addMinutes(120)->format('Y-m-d H:i:s'),
                'status' => $fixtureData["ft_status"],
            ]
        );

        if ($scraperFixture->date_time->format("Y-m-d H:i:s") != $fixtureData['date_time']) {
            $scraperFixture->update([
                'date_time' => $fixtureData['date_time'],
                'est_finished_date_time' => Carbon::parse($fixtureData['date_time'])->addMinutes(120)->format('Y-m-d H:i:s')
            ]);
        }

        return $scraperFixture;
    }

    protected function createMarket(array $market, Team $dbHomeTeam, Team $dbAwayTeam, Fixture $dbFixture, $defaultMMOdd)
    {
        return Market::create([
            'scrapper_id' => $market['id'],
            'league_id' => $dbFixture->league_id,
            'fixture_id' => $dbFixture->id,
            'upper_team_id' => $dbHomeTeam->scraper_id == $market['ft_upper_team_id'] ? $dbHomeTeam->id : $dbAwayTeam->id,
            'lower_team_id' => $dbAwayTeam->scraper_id == $market['ft_lower_team_id'] ? $dbAwayTeam->id : $dbHomeTeam->id,
            'handicap_team_id' => $market['home_team_has_handicap'] ? $dbHomeTeam->id : $dbAwayTeam->id,
            'ab' => $market['ft_ab'],
            'ab_odd' =>$defaultMMOdd,
            'ou' => $market['ft_ou'],
            'ou_odd' => $defaultMMOdd,
        ]);
    }
}
