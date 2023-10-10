<?php

declare(strict_types=1);

namespace App\MyCalculator;

use App\MyCalculator\Interfaces\ICalculator;

class Calculator implements ICalculator
{
    public function __construct(
        protected ICalculator $action
    ) {
    }

    public function changeAction(ICalculator $action): static
    {
        $this->action = $action;
        return $this;
    }

    public function calculate(int|float $fistNum, int|float $secondNum): int|float
    {
        return $this->action->calculate($fistNum, $secondNum);
    }
}