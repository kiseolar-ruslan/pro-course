<?php

declare(strict_types=1);

namespace App\DIContainer\Services;

use App\DIContainer\Interfaces\ISender;
use UfoCms\ColoredCli\CliColor;

class EmailSender implements ISender
{
    public function send(): string
    {
        return CliColor::YELLOW->value . 'Sent a notification to Email!' . CliColor::RESET->value . PHP_EOL;
    }
}