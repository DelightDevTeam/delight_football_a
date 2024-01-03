<?php

namespace App\Services;

use App\Models\League;
use Carbon\Carbon;

class MarketService
{
    private static bool $ignore_time = false;

    public static function ignoreTime()
    {
        self::$ignore_time = true;
        return new static();
    }

    public static function getMarkets()
    {
        $instance = new static();
        return $instance->getData();
    }

    public function getData()
    {
        $now = now();

        $min_last_odd_created_at = Carbon::createFromFormat("Y-m-d H:i:s", $now)->subMinutes(3)->format("Y-m-d H:i:s");

        return League::whereHas('fixtures', function ($q) use ($now,) {
            $q->has("markets");

            if (!self::$ignore_time) {
                $q->where('date_time', '>=', $now);
            }
        })
            ->with(['fixtures' => function ($q) use ($now, $min_last_odd_created_at,) {

                if (!self::$ignore_time) {
                    $q->where("date_time", ">=", $now);

                    $q->whereHas("markets", function ($q) use ($min_last_odd_created_at) {
                        $q->where("created_at", ">=", $min_last_odd_created_at);
                    });
                }

                $q->with([
                    "homeTeam",
                    "awayTeam",
                    "latestMarket" => function ($q) {
                        $q->orderBy("created_at", "DESC");
                    }
                ]);

                $q->orderBy("date_time");
                $q->orderBy("id");
            }])
            ->orderBy("name")
            ->get();
    }
}
