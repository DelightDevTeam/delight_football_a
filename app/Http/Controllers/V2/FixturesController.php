<?php

namespace App\Http\Controllers\V2;

use App\Models\Fixture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FixturesController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::latest()->paginate(4);
        //return $fixtures;
        return view('v2_views.fixtures.index', compact('fixtures'));
    }
}
