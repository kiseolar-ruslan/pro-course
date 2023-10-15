<?php

declare(strict_types=1);

use App\DIContainer\Services\EmailSender;
use App\DIContainer\Services\InstagramSender;
use App\DIContainer\Services\MessageHandler;
use App\DIContainer\Services\TelegramSender;
use App\ORM\ActiveRecord\Models\UrlCode;
use App\UrlConverter\Actions\SavingDataToTheDB;
use App\UrlConverter\Actions\SavingUrlToTheFile;
use App\UrlConverter\Repository\DataBaseRepository;
use App\UrlConverter\Repository\FileRepository;
use App\UrlConverter\UrlConverter;
use App\UrlConverter\Validate\ValidateUrl;

require_once __DIR__ . '/../vendor/autoload.php';

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

    FileRepository::class => function () {
        return new FileRepository();
    },

    DataBaseRepository::class => function () {
        return new DataBaseRepository();
    },

    SavingUrlToTheFile::class => function () {
        return new SavingUrlToTheFile();
    },

    SavingDataToTheDB::class => function () {
        return new SavingDataToTheDB(new UrlCode());
    },

    ValidateUrl::class => function () {
        return new ValidateUrl();
    },

    UrlConverter::class => function ($container) {
        return new UrlConverter(
            $container->get(DataBaseRepository::class),
//            $container->get(FileRepository::class),
//            $container->get(SavingUrlToTheFile::class),
            $container->get(SavingDataToTheDB::class),
            $container->get(ValidateUrl::class),
            $container->get('urlConverter.codeLength'),
        );
    }
];
