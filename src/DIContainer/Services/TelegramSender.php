<?php

declare(strict_types=1);

namespace App\DIContainer\Services;

use App\DIContainer\Interfaces\ISender;
use UfoCms\ColoredCli\CliColor;

class TelegramSender implements ISender
{
    public function send(): string
    {
        return CliColor::YELLOW->value . 'Sent a notification to Telegram!' . CliColor::RESET->value . PHP_EOL;
    }
}