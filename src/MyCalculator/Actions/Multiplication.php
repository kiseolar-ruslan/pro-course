<?php

namespace App\MyCalculator\Actions;


use App\MyCalculator\Interfaces\ICalculator;

class Multiplication implements ICalculator
{
    public function calculate(int|float $fistNum, int|float $secondNum): int|float
    {
        return $fistNum * $secondNum;
    }
}