<?php

namespace App\Http\Controllers\V2;

use App\Models\Fixture;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FixturesController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('query');

        $query = Fixture::query();
        if ($searchQuery) {
            $query->join('teams as home', 'fixtures.home_team_id', '=', 'home.id')
                ->join('teams as away', 'fixtures.away_team_id', '=', 'away.id')
                ->join('leagues', 'fixtures.league_id', '=', 'leagues.id')
                ->where(function ($query) use ($searchQuery) {
                    $query->where('fixtures.id', $searchQuery)
                        ->orWhere('home.name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('away.name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('leagues.name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhereDate('fixtures.date_time', $searchQuery);
                });
        } else {
            $query->orderBy('fixtures.id', 'asc');
        }
        $fixtures = $query->paginate(5);
        //return $fixtures;

        return view('v2_views.fixtures.index', compact('fixtures'));
    }


    public function edit($id)
    {
        $fixture = Fixture::find($id);
        return view('v2_views.fixtures.edit', compact('fixture'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'home_goal' => 'required|numeric',
            'away_goal' => 'required|numeric',
        ]);

        $fixture = Fixture::find($id);

        $fixture->ft_home_goal = $request->home_goal;
        $fixture->ft_away_goal = $request->away_goal;

        $fixture->active = $request->has('active');

        $fixture->save();

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture updated successfully.');
    }
}
