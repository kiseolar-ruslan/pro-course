<?php

namespace App\MyCalculator\Actions;

use App\MyCalculator\Interfaces\ICalculator;
use Exception;

class Divide implements ICalculator
{
    /**
     * @throws Exception
     */
    public function calculate(int|float $fistNum, int|float $secondNum): int|float
    {
        if ($secondNum === 0) {
            throw new Exception("You can't divide by zero");
        }

        return $fistNum / $secondNum;
    }
}