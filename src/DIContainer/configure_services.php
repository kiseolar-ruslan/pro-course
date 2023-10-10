<?php

declare(strict_types=1);

use App\DIContainer\Services\EmailSender;
use App\DIContainer\Services\InstagramSender;
use App\DIContainer\Services\MessageHandler;
use App\DIContainer\Services\TelegramSender;

require_once __DIR__ . '/../../vendor/autoload.php';

return [
    InstagramSender::class => function () {
        return new InstagramSender();
    },

    TelegramSender::class => function () {
        return new TelegramSender();
    },

    EmailSender::class    => function () {
        return new EmailSender();
    },

    //Default value.
    MessageHandler::class => function ($container) {
        return new MessageHandler(
            $container->get(EmailSender::class)
        );
    },

    'MessageToTelegram' => function ($container) {
        return new MessageHandler(
            $container->get(TelegramSender::class)
        );
    },

    'MessageToInstagram' => function ($container) {
        return new MessageHandler(
            $container->get(InstagramSender::class)
        );
    },

    'MessageToEmail' => function ($container) {
        return new MessageHandler(
            $container->get(EmailSender::class)
        );
    },

];
