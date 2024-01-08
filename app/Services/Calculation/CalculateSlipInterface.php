<?php

namespace App\Services\Calculation;

interface CalculateSlipInterface{
    public function calculateResult();
    
    public function calculateProfit();

    public function calculatePayout();
}