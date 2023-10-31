<?php

declare(strict_types=1);

use App\Core\Web\Controllers\ErrorController;
use App\Core\Web\Controllers\UrlConverterController;
use App\Core\Web\Controllers\UserController;
use App\Core\Web\Services\UrlConverterService;
use Doctrine\ORM\EntityManager;

return [
    UserController::class => function ($container) {
        return new UserController(
            $container->get(EntityManager::class)
        );
    },

    ErrorController::class => function () {
        return new ErrorController();
    },

    UrlConverterController::class => function ($container) {
        return new UrlConverterController(
            $container->get(UrlConverterService::class)
        );
    },

    UrlConverterService::class => function ($container) {
        return new UrlConverterService(
            $container->get('databaseUrlConverter')
        );
    },
];