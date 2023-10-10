<?php


use App\Core\ConfigHandler;
use App\Core\DI\Container;

require_once __DIR__ . '/../vendor/autoload.php';


return new Container(
    array_merge(
        require_once __DIR__ . '/../config/services.php',
        require_once __DIR__ . '/../config/calculator_configs.php',
        require_once __DIR__ . '/../config/commands.php',
    ),
    ConfigHandler::getInstance()->addConfigs(
        require_once __DIR__ . '/../config/params.php'
    )
);