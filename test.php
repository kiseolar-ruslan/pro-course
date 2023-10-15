<?php

declare(strict_types=1);


use GuzzleHttp\Exception\GuzzleException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once __DIR__ . '/vendor/autoload.php';
$container     = require_once __DIR__ . '/src/bootstrap.php';

