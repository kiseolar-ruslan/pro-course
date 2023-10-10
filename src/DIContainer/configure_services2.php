<?php

declare(strict_types=1);

use App\DIContainer\Services\EmailSender;

require_once __DIR__ . '/../../vendor/autoload.php';

return [
    EmailSender::class => function () {
        return new EmailSender();
    },
];
