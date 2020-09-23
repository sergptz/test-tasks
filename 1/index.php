<?php

function balance($firstPart, $secondPart): string
{
    $getWeightOfChar = function (string $char): int {
        if ($char === '!') return 2;
        if ($char === '?') return 3;
        throw new \RuntimeException("Wrong value given! Only '!' or '?' was expected, but got '$char'");
    };
    $reduceFunc = function ($accum, $value) use ($getWeightOfChar) {
        return $accum + $getWeightOfChar($value);
    };
    $firstPartWeight = array_reduce(str_split($firstPart), $reduceFunc);
    $secondPartWeight = array_reduce(str_split($secondPart), $reduceFunc);

    $result = '';

    if ($firstPartWeight > $secondPartWeight) $result = 'Left';
    elseif ($firstPartWeight < $secondPartWeight) $result = 'Right';
    else $result = 'Balance';

    return $result;
}


var_dump(balance("!!","??") === "Right");
var_dump(balance("!??","?!!") === "Left");
var_dump(balance("!?!!","?!?") === "Left");
var_dump(balance("!!???!????","??!!?!!!!!!!") === "Balance");
