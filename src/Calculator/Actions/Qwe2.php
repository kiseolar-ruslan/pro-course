<?php

namespace App\Calculator\Actions;

class Qwe2 extends AbstractAction
{
    const SIGNATURE = '!';

    public function calculate(float|int $val1, float|int $val2): int|float
    {
        return $val1 ** $val2;
    }
}
