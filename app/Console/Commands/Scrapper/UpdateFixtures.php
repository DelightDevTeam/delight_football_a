<?php

namespace App\Console\Commands\Scrapper;

use App\Http\Integrations\Scrapper\Requests\ScrapperFixtureRequest;
use App\Http\Integrations\Scrapper\ScrapperConnector;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:v2-update-fixtures';

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
        $fromDate = now()->subDays(2)->startOfDay()->format("Y-m-d H:i:s");
        $toDate = now()->addDay()->endOfDay()->format("Y-m-d H:i:s");

        $connector = new ScrapperConnector();

        $request = new ScrapperFixtureRequest();

        $request->query()->add("from_date", $fromDate);
        $request->query()->add("to_date", $toDate);

        $response = $connector->send($request);

        $data = $response->json();

        if ($data["success"] == true && $data['data']) {
            $this->processLeagues($data['data']['leagues']);
        }
    }

    protected function processLeagues(array $leagues)
    {
        foreach ($leagues as $league) {
            $dbLeague = $this->getScraperLeague($league);

            if ($dbLeague) {
                foreach ($league['fixtures'] as $fixture) {
                    $dbHomeTeam = $this->getScraperTeam($fixture['home_team'], $dbLeague);
                    $dbAwayTeam = $this->getScraperTeam($fixture['away_team'], $dbLeague);

                    if ($dbHomeTeam && $dbAwayTeam) {
                        $dbFixture = $this->getScraperFixture($fixture, $dbLeague, $dbHomeTeam, $dbAwayTeam);

                        if ($dbFixture && (!$dbFixture->stop_update && !$dbFixture->manually_updated)) {
                            $this->updateScraperFixture($fixture, $dbFixture);
                        }
                    }
                }
            }
        }
    }

    private function getScraperLeague(array $leagueData)
    {
        return League::where('scraper_id', $leagueData['id'])->first();
    }

    private function getScraperTeam(array $teamData, League $dbLeague)
    {
        return $dbLeague->teams()->where(
            [
                'scraper_id' => $teamData['id'],
                'name' => $teamData['name'],
            ]
        )->first();
    }

    protected function getScraperFixture(array $fixtureData, League $dbLeague, Team $dbHomeTeam, Team $dbAwayTeam)
    {
        return $dbLeague->fixtures()->where(
            [
                'scraper_id' => $fixtureData['id'],
                'league_id' => $dbLeague->id,
                'home_team_id' => $dbHomeTeam->id,
                'away_team_id' => $dbAwayTeam->id,
            ]
        )->first();
    }

    protected function updateScraperFixture(array $fixtureData, Fixture $dbFixture)
    {
        $dbFixture->update(
            [
                "ft_home_goal" => $fixtureData["ft_home_goal"],
                "ft_away_goal" => $fixtureData["ft_away_goal"],
                'status' => $fixtureData["ft_status"],
                'ft_status' => $fixtureData["ft_status"],
                'date_time' => $fixtureData["date_time"],
                'est_finished_date_time' => Carbon::parse($fixtureData['date_time'])->addMinutes(120)->format('Y-m-d H:i:s')
            ]
        );

        if ($fixtureData["ft_status"] != "NS") {
            $dbFixture->update([
                "stop_update" => true,
                "confirmed" => config("system.auto_confirm_fixtures") ? true : $dbFixture->confirmed
            ]);
        }
    }
}
