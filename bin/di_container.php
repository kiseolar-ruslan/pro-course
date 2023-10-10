<?php

declare(strict_types=1);

use App\DIContainer\Services\EmailSender;
use App\DIContainer\Services\InstagramSender;
use App\DIContainer\Services\MessageHandler;
use App\DIContainer\Services\TelegramSender;

require_once __DIR__ . '/../vendor/autoload.php';
$container = require_once __DIR__ . '/../src/DIContainer/bootstrap.php';

try {
    $messageHandler = $container->get('MessageToInstagram');
    $outputMessage  = $messageHandler->send();
    echo $outputMessage;

    //Telegram message.
    $telegramMessage = $messageHandler->changeSender($container->get(TelegramSender::class));
    echo $telegramMessage->send();

    //Instagram message.
    $instagramMessage = $messageHandler->changeSender($container->get(InstagramSender::class));
    echo $instagramMessage->send();

    //Email message.
    $emailMessage = $messageHandler->changeSender($container->get(EmailSender::class));
    echo $emailMessage->send();

    //Config request.
    echo $container->get('shortener.b.c') . PHP_EOL;

    var_dump($container->has(MessageHandler::class));
} catch (Throwable $e) {
    echo $e->getMessage() . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
}
