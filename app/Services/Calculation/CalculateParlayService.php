<?php

namespace App\Services\Calculation;

use App\Enums\BetStatus;
use App\Models\Parlay;

class CalculateParlayService extends CalculateSlipService
{
    protected BetStatus $result;
    protected array $parlay_bet_win_percents;
    protected float $profit;
    protected float $payout;

    public function __construct(
        protected Parlay $parlay,
    ) {
    }

    public function calculateParlayBetWinPercents()
    {
        foreach ($this->parlay->parlayBets as $parlay_bet) {
            $win_percent = (new CalculateParlayBetService($parlay_bet))->calculateWinPercent()->getWinPercent();

            $this->parlay_bet_win_percents[] = [
                "parlay_bet_id" => $parlay_bet->id,
                "win_percent" => $win_percent
            ];
        }

        return $this;
    }

    public function getParlayBetWinPercents()
    {
        if (!isset($this->parlay_bet_win_percents)) {
            $this->calculateParlayBetWinPercents();
        }

        return $this->parlay_bet_win_percents;
    }

    public function setParlayBetWinPercents($parlay_bet_win_percents)
    {
        $this->parlay_bet_win_percents = $parlay_bet_win_percents;

        return $this;
    }

    public function calculateResult()
    {
        $has_full_lose = collect($this->getParlayBetWinPercents())->contains(function ($value, $key) {
            return $value["win_percent"] < 0;
        });

        $this->result = $has_full_lose ? BetStatus::Lose : BetStatus::Win;

        return $this;
    }

    public function getResult()
    {
        if (!isset($this->result)) {
            $this->calculateResult();
        }

        return $this->result;
    }

    public function calculateProfit()
    {
        $win_percents = collect($this->getParlayBetWinPercents())->pluck("win_percent")->toArray();

        $plus = [];
        $minus = [];
        $zeros = [];

        foreach ($win_percents as $win_percent) {
            if ($win_percent == 0) {
                $zeros[] = $win_percent;
            } else if ($win_percent > 0) {
                $plus[] = $win_percent;
            } else {
                $minus[] = $win_percent;
            }
        }

        rsort($plus);

        sort($minus);

        $win_percents = [...$plus, ...$zeros, ...$minus];

        $this->profit = $this->parlay->amount;
        foreach ($win_percents as $win_percent) {
            $this->profit = $this->profit + ($this->profit * ($win_percent / 100));
        }

        // TODO: implement: add fee percent from db
        $fee_percent = 20;

        $fee = $this->profit * ($fee_percent / 100);

        $this->profit = ($this->profit - $fee) - $this->parlay->amount;

        return $this;
    }

    public function getProfit()
    {
        if (!isset($this->profit)) {
            $this->calculateProfit();
        }

        return $this->profit;
    }

    public function calculatePayout()
    {
        $this->payout = $this->getProfit() + $this->parlay->amount;
    }

    public function getPayout()
    {
        if (!isset($this->payout)) {
            $this->calculatePayout();
        }

        return $this->payout;
    }
}
