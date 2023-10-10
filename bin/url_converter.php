<?php

declare(strict_types=1);

use App\Core\ConfigHandler;
use App\UrlConverter\Actions\SavingUrlToTheFile;
use App\UrlConverter\Repository\FileRepository;
use App\UrlConverter\UrlConverter;
use App\UrlConverter\Validate\ValidateUrl;

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/params.php';

$configHandler = ConfigHandler::getInstance()->addConfigs($config);


$url  = 'https://google.com';
$url2 = 'https://facebook.com';
$url3 = 'https://youtube.com';

$urlConverter = new UrlConverter(
    new FileRepository(),
    new SavingUrlToTheFile(),
    new ValidateUrl(),
    $configHandler->get('urlConverter.codeLength'),
);

//echo $urlConverter->encode($url2) . PHP_EOL;
echo $urlConverter->decode("8CC2D59D") . PHP_EOL;
