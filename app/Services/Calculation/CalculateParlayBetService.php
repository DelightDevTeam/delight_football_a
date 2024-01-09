<?php

namespace App\Services\Calculation;

use App\Enums\BetStatus;
use App\Models\ParlayBet;

class CalculateParlayBetService {
    protected CalculateSingleBetService $calculateSingleBetService;
    protected BetStatus $result;
    protected int $win_percent;
    
    public function __construct(
        protected ParlayBet $parlay_bet,
    )
    {
        $selected_side = $parlay_bet->getSelectedSide();
        $upper_team_goal = $parlay_bet->getUpperTeamGoal();
        $lower_team_goal = $parlay_bet->getLowerTeamGoal();
        $handicap = $parlay_bet->getHandicap();

        $this->calculateSingleBetService = new CalculateSingleBetService($selected_side, $upper_team_goal, $lower_team_goal, $handicap);
    }

    public function calculateWinPercent(){
        $this->win_percent = $this->calculateSingleBetService->calculateWinPercent()->getWinPercent();

        return $this;
    }

    public function getWinPercent(){
        if(!isset($this->win_percent)){
            $this->calculateWinPercent();
        }

        return $this->win_percent;
    }

    public function setWinPercent($win_percent){
        $this->win_percent = $win_percent;

        return $this;
    }

    public function calculateResult(){
        $this->result = $this->calculateSingleBetService->getResult();

        return $this;
    }

    public function getResult(){
        if(!isset($this->result)){
            $this->calculateResult();
        }

        return $this->result;
    }
}