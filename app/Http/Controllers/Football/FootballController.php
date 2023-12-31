<?php

namespace App\Http\Controllers\Football;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FootballController extends Controller
{
    public function index()
    {
        return view('football.pages.index');
    }
    public function maung()
    {
        return view('football.pages.maung');
    }
    public function bodyGoal()
    {
        return view('football.pages.body-goal');
    }
    public function match()
    {
        return view('football.pages.matches');
    }
    public function moneyList()
    {
        return view('football.pages.money-list');
    }
    public function goalResult()
    {
        return view('football.pages.goal-result');
    }
    public function moneyChange()
    {
        return view('football.pages.money-change');
    }
}
