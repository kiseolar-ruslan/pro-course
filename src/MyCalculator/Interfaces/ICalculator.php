<?php

namespace App\MyCalculator\Interfaces;

interface ICalculator
{
    public function calculate(int|float $fistNum, int|float $secondNum): int|float;
}