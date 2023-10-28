<?php

declare(strict_types=1);

use App\Core\Web\Controllers\ErrorController;
use App\Core\Web\Controllers\UserController;
use App\Core\Web\Exceptions\RouteNotFoundException;

//$container = require_once __DIR__ . '/../src/DIContainer/bootstrap.php';

require_once __DIR__ . '/../vendor/autoload.php';

$pathParts = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));

$domain = array_shift($pathParts);

$routs = [
    'user' => UserController::class,
];

try {
    if (false === isset($routs[$domain])) {
        throw new RouteNotFoundException();
    }

    $controller    = $routs[$domain];
    $objController = new $controller();

    echo $objController->indexAction((int)$pathParts[0]);
} catch (Throwable $e) {
    $objController = new ErrorController();
    echo $objController->error404Action();
}

exit;
