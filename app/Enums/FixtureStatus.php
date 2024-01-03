<?php

namespace App\Enums;

enum FixtureStatus: string
{
    case NS = 'NS';
    case FT = 'FT';
    case CANC = 'CANC';

    const BET_CALC_STATUSES = [self::FT, self::CANC];

    public function text(): string
    {
        return match ($this) {
            self::NS => 'Not Started',
            self::FT => 'Match Finished',
            self::CANC => 'Match Cancelled',
        };
    }

    public static function all()
    {
        $statuses = [];
        foreach (self::cases() as $case) {
            $statuses[] = ['value' => $case->value, 'label' => $case->text()];
        }
        return $statuses;
    }
}
