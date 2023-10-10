<?php

use App\Core\ConfigHandler;
use App\Shortener\FileRepository;
use App\Shortener\Helpers\UrlValidator;
use App\Shortener\UrlAnywayConverter;
use App\Shortener\UrlConverter;
use GuzzleHttp\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config/params.php';

ConfigHandler::getInstance()->addConfigs($config);
ConfigHandler::getInstance()->addConfigs($_ENV);


$fileRepository = new FileRepository(ConfigHandler::getInstance()->get('dbFile'));

$urlValidator = new UrlValidator(new Client());

$converter = new UrlConverter(
    $fileRepository,
    $urlValidator,
    ConfigHandler::getInstance()->get('urlConverter.codeLength')
);


$url = 'https://facebook.com';
try {
    echo $converter->decode('zITtNyfB');
    echo PHP_EOL;
    echo $converter->decode('5jP9V1L1');
    echo PHP_EOL;
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

echo PHP_EOL;