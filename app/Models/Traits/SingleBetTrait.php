<?php

namespace App\Models\Traits;

use App\Enums\BetType;

trait SingleBetTrait
{
    public function getSelectedSide()
    {
        if ($this->type == BetType::Ab) {
            return $this->ab_selected_side;
        }

        return $this->ou_selected_side;
    }

    public function getUpperTeamGoal()
    {
        if ($this->isHomeTeamUpper()) {
            return $this->fixture->ft_home_goal;
        }

        return $this->fixture->ft_away_goal;
    }

    public function getLowerTeamGoal()
    {
        if ($this->isHomeTeamUpper()) {
            return $this->fixture->ft_away_goal;
        }

        return $this->fixture->ft_home_goal;
    }

    public function isHomeTeamUpper()
    {
        return $this->home_team_id == $this->upper_team_id;
    }

    public function getHandicap()
    {
        if ($this->type == BetType::Ab) {
            return $this->ab_obj["handicap"];
        }

        return $this->ou_obj["handicap"];
    }

    public function getOdd()
    {
        if ($this->type == BetType::Ab) {
            return $this->ab_obj["odd"];
        }

        return $this->ou_obj["odd"];
    }
}
