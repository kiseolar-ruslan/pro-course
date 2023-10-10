<?php

namespace App\Core\CLI\Commands;

use App\Calculator\Calculator;

class CalculatorCommand extends AbstractCommand
{
    public const NAME = 'calc';

    public function __construct(protected Calculator $calculator)
    {
    }

    public static function getCommandDesc(): string
    {
        return 'Simple cli calculator';
    }

    protected function runAction(): string
    {
        try {
            $result = 'Result: ' . $this->calculator->calculate($this->params[0], $this->params[1], $this->params[2]);
        } catch (\Throwable) {
            $result = 'Actions: ' . implode(', ', $this->calculator->getCalculatePossibilities());
        }
        return $result;
    }
}
