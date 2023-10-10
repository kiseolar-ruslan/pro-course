<?php

declare(strict_types=1);


use GuzzleHttp\Exception\GuzzleException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once __DIR__ . '/vendor/autoload.php';
$container     = require_once __DIR__ . '/src/bootstrap.php';
$streamHandler = new StreamHandler(__DIR__ . '/storage/http_log');

$requestLogger = new \App\DzDi\RequestMonologLogger(
    new Logger('httpRequests', [$streamHandler]),
    new \GuzzleHttp\Client(),
    new \App\Shortener\Helpers\UrlValidator(new \GuzzleHttp\Client())
);

try {
    $response = $requestLogger->request('GET', 'https://google.com');
    echo 'Status code: ' . $response->getStatusCode();
} catch (\Psr\Http\Client\ClientExceptionInterface|InvalidArgumentException $e) {
//    echo $e->getMessage();
}

exit;

$logger = new Logger('httpRequest');
$client = new \GuzzleHttp\Client();
$logger->pushHandler(new StreamHandler(__DIR__ . '/storage/http_log'));

try {
    $response        = $client->get('https://google.com');
    $statusCode      = $response->getStatusCode();
    $body            = $response->getBody();
    $sizeInBytes     = $body->getSize();
    $sizeInKilobytes = intdiv($sizeInBytes, 1024) . 'kb';
    $logger->info('Status code: ' . $statusCode . '. size: ' . $sizeInKilobytes);
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

exit;