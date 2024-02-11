<?php

namespace App\Enums;

enum FixtureStatus: string
{
    use HasLabelTrait;

    case NS = 'NS';
    case FT = 'FT';
    case CANC = 'CANC';

    const BET_CALC_STATUSES = [self::FT, self::CANC];

    public static function all()
    {
        $statuses = [];
        foreach (self::cases() as $case) {
            $statuses[] = ['value' => $case->value, 'label' => $case->label()];
        }
        return $statuses;
    }
}
