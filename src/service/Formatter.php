<?php


namespace Service;

class Formatter
{

    public static function printResult(string $value, int $precisionCount): string
    {
        return number_format($value, $precisionCount, ".", "");
    }
}
