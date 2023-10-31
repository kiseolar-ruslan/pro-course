<?php

declare(strict_types=1);

use App\Core\Web\Controllers\ErrorController;
use App\Core\Web\Controllers\UrlConverterController;
use App\Core\Web\Controllers\UserController;
use App\DIContainer\Container;
use App\ORM\ActiveRecord\DataBaseConnectionAR;

/**
 * @var Container $container
 */
$container = require_once __DIR__ . '/../src/DIContainer/bootstrap.php';
$container->get(DataBaseConnectionAR::class);

$routs = [
    'user'     => [UserController::class => 'indexAction'],
    'user/all' => [UserController::class => 'allUsersAction'],
    'url'  => [UrlConverterController::class => 'encode'],
    'code' => [UrlConverterController::class => 'decode'],
];

try {
    $key        = array_key_first($_GET);
    $value      = current($_GET);
    $routsValue = $routs[$key];
    $execMethod = current($routsValue);
    $createObj  = $container->get(array_key_first($routsValue));

    echo call_user_func([$createObj, $execMethod], $value);
} catch (Throwable) {
    /**
     * @var ErrorController $error
     */
    $error = $container->get(ErrorController::class);
    echo $error->errorUrlConverterAction();
}

exit;


//$uri       = substr($_SERVER['REQUEST_URI'], 1);
//$pathParts = [];
//
//try {
//    if (true === isset($routs[$uri])) {
//        $routeData = $routs[$uri];
//    } else {
//        $pathParts = explode('/', $uri);
//        $domain    = array_shift($pathParts);
//
//        if (false === isset($routs[$domain])) {
//            throw new RouteNotFoundException();
//        }
//
//        $routeData = $routs[$domain];
//    }
//
//    $objController = $container->get(array_key_first($routeData));
//
//    echo call_user_func_array([$objController, current($routeData)], $pathParts);
//} catch (Throwable $e) {
//    $objController = new ErrorController();
//    echo $objController->error404Action();
//}

//exit;
