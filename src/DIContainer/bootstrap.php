<?php

declare(strict_types=1);


use App\Core\ConfigHandler;
use App\DIContainer\Container;

require_once __DIR__ . '/../../vendor/autoload.php';

return new Container(
    ConfigHandler::getInstance()->addConfigs(
        require_once __DIR__ . '/../../config/params.php'
    ),
    require_once __DIR__ . '/configure_parameters.php',
    require_once __DIR__ . '/configure_services.php',
    require_once __DIR__ . '/configure_services2.php',
);