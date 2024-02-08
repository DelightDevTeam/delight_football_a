<?php

namespace App\Services\Calculation;

abstract class CalculateSlipService implements CalculateSlipInterface
{
    protected float $profit;
    protected float $payout;

    public function getProfit()
    {
        if (!isset($this->profit)) {
            $this->calculateProfit();
        }

        return $this->profit;
    }

    public function getPayout(){
        if(!isset($this->payout)){
            $this->calculatePayout();
        }

        return $this->payout;
    }
}
