<?php

use App\Calculator\Calculator;
use App\Calculator\SmartCalculator;
use App\Core\CLI\CommandHandler;
use App\Core\CLI\Commands\CalculatorCommand;
use App\Core\CLI\Commands\HelpCommand;
use App\Core\CLI\Commands\HttpRequestCommand;
use App\Core\CLI\Commands\TestCommand;
use App\Core\CLI\Commands\UrlDecodeCommand;
use App\Core\CLI\Commands\UrlEncodeCommand;
use App\Core\DI\Container;
use App\Core\DI\Enums\ServiceConfigArrayKeys as S;
use App\Core\DI\ValueObjects\ServiceObject;
use App\DzDi\RequestMonologLogger;

return [
    // ----------- COMMANDS -----------

    CommandHandler::class => [
        S::CLASSNAME => CommandHandler::class,
        S::ARGUMENTS => [
            '@cli.command.help',
        ],
        S::COMPILER  => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var CommandHandler $object
             */
            foreach ($container->getByTag('cli.command') as $item) {
                $object->addCommand($item);
            }
        },
    ],

    "cli.command.help" => [
        S::CLASSNAME => HelpCommand::class,
        S::ARGUMENTS => [
            '$allowed.command',
        ],

        S::TAGS => ['cli.command']
    ],

    "cli.command.test"         => [
        S::CLASSNAME => TestCommand::class,
        S::TAGS      => ['cli.command']
    ],
    "cli.command.urlEncode"    => [
        S::CLASSNAME => UrlEncodeCommand::class,
        S::ARGUMENTS => [
            '@shortener.converter'
        ],
        S::TAGS      => ['cli.command', 'allowed.command']
    ],
    "cli.command.urlDecode"    => [
        S::CLASSNAME => UrlDecodeCommand::class,
        S::ARGUMENTS => [
            '@shortener.converter'
        ],
        S::TAGS      => ['cli.command', 'allowed.command']
    ],
    "cli.command.calculator"   => [
        S::CLASSNAME => CalculatorCommand::class,
        S::ARGUMENTS => [
            '@' . Calculator::class
        ],
        S::TAGS      => ['cli.command', 'allowed.command']
    ],
    "cli.command.http.request" => [
        S::CLASSNAME => HttpRequestCommand::class,
        S::ARGUMENTS => [
            '@' . RequestMonologLogger::class
        ],
        S::TAGS      => ['cli.command', 'allowed.command']
    ],
];