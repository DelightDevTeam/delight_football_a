<?php

namespace App\Services\Calculation;

interface CalculateSlipInterface{
    public function getResult();

    public function calculateResult();
    
    public function getProfit();
    
    public function calculateProfit();

    public function getPayout();
    
    public function calculatePayout();
}