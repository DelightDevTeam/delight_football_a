<?php

namespace App\Services\Calculation;

use App\Enums\BetStatus;
use App\Models\Single;

class CalculateSingleService extends CalculateSlipService{
    protected CalculateSingleBetService $calculateSingleBetService;
    protected BetStatus $result;
    protected int $win_percent;
    protected float $profit;
    protected float $payout;
    
    public function __construct(
        protected Single $single,
    )
    {
        $selected_side = $single->getSelectedSide();
        $upper_team_goal = $single->getUpperTeamGoal();
        $lower_team_goal = $single->getLowerTeamGoal();
        $handicap = $single->getHandicap();

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

    public function calculateProfit()
    {
        $odd = $this->single->getOdd();
        $win_percent = $this->getWinPercent();

        $this->profit = $this->single->amount * ($win_percent / 100);

        if (isNegativeValue($odd)) {
            if ($win_percent < 0) {
                $this->profit = $this->profit * abs($odd);
            }
        } else {
            if ($win_percent > 0) {
                $this->profit = $this->profit * abs($odd);
            }
        }

        return $this;
    }

    public function getProfit(){
        if(!isset($this->profit)){
            $this->calculateProfit();
        }

        return $this->profit;
    }

    public function calculatePayout() {
        $this->payout = $this->getProfit() + $this->single->amount;
    }
    
    public function getPayout(){
        if(!isset($this->payout)){
            $this->calculatePayout();
        }

        return $this->payout;
    }
}