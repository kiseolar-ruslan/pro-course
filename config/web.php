<?php

declare(strict_types=1);

use App\Core\Web\Controllers\ErrorController;
use App\Core\Web\Controllers\UrlConverterController;
use App\Core\Web\Controllers\UserController;
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
            $container->get('databaseUrlConverter')
        );
    }
];