<?php

declare(strict_types=1);

use App\DIContainer\Services\TelegramSender;

require_once __DIR__ . '/../../vendor/autoload.php';

return [
    TelegramSender::class => function () {
        return new TelegramSender();
    },
];