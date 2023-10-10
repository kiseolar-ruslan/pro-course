<?php

use App\Calculator\Actions\Div;
use App\Calculator\Actions\Expo;
use App\Calculator\Actions\Multi;
use App\Calculator\Actions\Qwe;
use App\Calculator\Actions\Qwe2;
use App\Calculator\Actions\Sub;
use App\Calculator\Actions\Sum;
use App\Calculator\Calculator;
use App\Calculator\SmartCalculator;
use App\Core\DI\Container;
use App\Core\DI\Enums\ServiceConfigArrayKeys as S;
use App\Core\DI\ValueObjects\ServiceObject;

return [
    Calculator::class      => [
        S::CLASSNAME => Calculator::class,
        S::COMPILER  => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var Calculator $object
             */
            foreach ($container->getByTag('calculator.action') as $item) {
                $object->actionRegistration($item);
            }
        },
    ],
    SmartCalculator::class => [
        S::CLASSNAME => SmartCalculator::class,
        S::CALLS     => [
            [
                S::METHOD    => 'actionsRegistration',
                S::ARGUMENTS => [
                    '$calculator.action',
                ]
            ]
        ]
    ],

    'calculator.action.sum'   => [
        S::CLASSNAME => Sum::class,
        S::TAGS      => ['calculator.action']
    ],
    'calculator.action.sub'   => [
        S::CLASSNAME => Sub::class,
        S::TAGS      => ['calculator.action']
    ],
    'calculator.action.div'   => [
        S::CLASSNAME => Div::class,
        S::TAGS      => ['calculator.action']
    ],
    'calculator.action.multi' => [
        S::CLASSNAME => Multi::class,
        S::TAGS      => ['calculator.action']
    ],
    'calculator.action.expo'  => [
        S::CLASSNAME => Expo::class,
        S::TAGS      => ['calculator.action']
    ],
    'calculator.action.qwe'   => [
        S::CLASSNAME => Qwe::class,
        S::TAGS      => ['calculator.action']
    ],
    //    'calculator.action.qwe2' => [
    //        S::CLASSNAME => Qwe2::class,
    //        S::TAGS => ['calculator.action']
    //    ],

];