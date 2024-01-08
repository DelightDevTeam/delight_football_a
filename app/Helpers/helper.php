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