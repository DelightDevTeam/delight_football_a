<?php

namespace App\Enums;

enum BetStatus: string
{
    case Pending = "pending";
    case Ongoing = "ongoing";
    case Win = "win";
    case Lose = "lose";
    case Draw = "draw";
    case Cancelled = "cancelled";
}
