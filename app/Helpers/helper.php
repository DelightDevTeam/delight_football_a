<?php

use Illuminate\Support\Str;

function isNegativeValue($value)
{
    return is_numeric($value) && $value < 0;
}

function isPositiveValue($value)
{
    return !isNegativeValue($value);
}

function convertHandicap(array $handicap)
{
    if (!$handicap) {
        return "";
    }

    $handicap[0] = $handicap[0] == 0 ? "=" : $handicap[0];

    if (isset($handicap[1])) {
        if ($handicap[1] == 0) {
            $handicap[1] = "=";
        } else if (isPositiveValue($handicap[1])) {
            $handicap[1] = "+" . $handicap[1];
        }
    }

    return implode("", $handicap);
}
