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

function convertHandicap(?array $handicap)
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

function subtractBetweenTwoDecimalFloats(float $first, float $second)
{
    return (($first * 100) - ($second * 100)) / 100;
}

function nearestLargerNumber($index, array $array) {
    $keys = array_keys($array);

    $parsedIndex = array_search($index, $keys);

    if ($parsedIndex === false || $parsedIndex === count($keys) - 1) {
        return null;
    }

    $nearestLargerIndex = $keys[$parsedIndex + 1];

    return $array[$nearestLargerIndex];
}
