<?php

namespace App\MyCalculator\Actions;


use App\MyCalculator\Interfaces\ICalculator;

class Minus implements ICalculator
{
    public function calculate(int|float $fistNum, int|float $secondNum): int|float
    {
        return $fistNum - $secondNum;
    }
}