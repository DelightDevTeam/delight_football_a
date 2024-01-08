<?php

namespace App\Services\Calculation;

use App\Enums\AbSelectableSide;
use App\Enums\BetStatus;
use App\Enums\OuSelectableSide;

class CalculateSingleBetService
{
    protected int $win_percent;

    public function __construct(
        public AbSelectableSide|OuSelectableSide $selected_side,
        public int $upper_team_goal,
        public int $lower_team_goal,
        public array $handicap
    ) {
    }

    public function calculateWinPercent()
    {
        $spread = $this->handicap[0];
        $price = isset($this->handicap[1]) ? $this->handicap[1] : 0;

        if ($this->selected_side instanceof AbSelectableSide) {
            $goal_diff = $this->upper_team_goal - $this->lower_team_goal;

            $upper_side = AbSelectableSide::Upper;
        } else {
            $goal_diff = $this->upper_team_goal + $this->lower_team_goal;

            $upper_side = OuSelectableSide::Over;
        }

        if ($goal_diff == 0) {
            if ($spread == 0) { // goal diff 0 and hdp goal 0
                $this->win_percent = $price;
            } else { // goal diff 0 and hdp goal 2
                $this->win_percent = $this->selected_side == $upper_side ? -100 : 100;
            }
        } else {
            if ($goal_diff > $spread) { // goal diff is 5 and hdp goal is 2
                $this->win_percent = $this->selected_side == $upper_side ? 100 : -100;
            } else if ($goal_diff < $spread) { // goal diff is 3 and hdp goal is 5
                $this->win_percent = $this->selected_side == $upper_side ? -100 : 100;
            } else { // goal diff is 5 and hdp goal is 5
                $this->win_percent = $price;
            }
        }

        return $this;
    }
    
    public function getWinPercent(){
        if(!isset($this->win_percent)){
            $this->calculateWinPercent();
        }

        return $this->win_percent;
    }

    public function getResult()
    {
        if ($this->getWinPercent() > 0) {
            return BetStatus::Win;
        }
        
        return BetStatus::Lose;
    }
}
