<?php

use App\Core\DI\Container;
use App\Core\DI\Enums\ServiceConfigArrayKeys as S;
use App\Core\DI\ValueObjects\ServiceObject;
use App\DzDi\RequestMonologLogger;
use App\Shortener\FileRepository;
use App\Shortener\Helpers\UrlValidator;
use App\Shortener\UrlConverter;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

return [
    RequestMonologLogger::class => [
        S::CLASSNAME => RequestMonologLogger::class,
        S::ARGUMENTS => [
            '@monolog.logger',
            '@guzzle.client',
            '@shortener.urlValidator',
        ],
    ],

    "shortener.converter" => [
        S::CLASSNAME => UrlConverter::class,
        S::ARGUMENTS => [
            '@shortener.codeRepository',
            '@shortener.urlValidator',
            '%urlConverter.codeLength',
        ],
    ],

    "shortener.codeRepository"     => [
        S::CLASSNAME => FileRepository::class,
        S::ARGUMENTS => [
            '%dbFile',
        ],
    ],
    "shortener.urlValidator"       => [
        S::CLASSNAME => UrlValidator::class,
        S::ARGUMENTS => [
            '@guzzle.client',
        ],
    ],
    "guzzle.client"                => [
        S::CLASSNAME => Client::class,
    ],
    "monolog.logger"               => [
        S::CLASSNAME => Logger::class,
        S::ARGUMENTS => [
            '%monolog.channel',
        ],
        S::COMPILER  => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var Logger $object
             */
            foreach ($container->getByTag('monolog.stream') as $item) {
                $object->pushHandler($item);
            }
        },
    ],
    "monolog.logger.default"       => [
        S::CLASSNAME => Logger::class,
        S::ARGUMENTS => [
            '%monolog.channel',
        ],
    ],
    "monolog.streamHandler.info"   => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.info',
            Level::Info,
        ],
        S::TAGS      => ['monolog.stream'],
    ],
    "monolog.streamHandler.error"  => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.error',
            Level::Error,
        ],
        S::TAGS      => ['monolog.stream'],
    ],
    "monolog.streamHandler.debug"  => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.debug',
            Level::Debug,
        ],
        S::TAGS      => ['monolog.stream'],
    ],
    "monolog.streamHandler.notice" => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.notice',
            Level::Notice,
        ],
        S::TAGS      => ['monolog.stream'],
    ],
];