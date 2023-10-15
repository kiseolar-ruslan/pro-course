<?php

declare(strict_types=1);

use App\Core\ConfigHandler;
use App\ORM\ActiveRecord\DataBaseConnectionAR;
use App\UrlConverter\Actions\SavingUrlToTheFile;
use App\UrlConverter\Repository\FileRepository;
use App\UrlConverter\UrlConverter;
use App\UrlConverter\Validate\ValidateUrl;

require_once __DIR__ . '/../vendor/autoload.php';
$container = require_once __DIR__ . '/../src/DIContainer/bootstrap.php';

$urlConverter = $container->get('databaseUrlConverter');
$container->get(DataBaseConnectionAR::class);


$url  = 'https://google.com';
$url2 = 'https://facebook.com';
$url3 = 'https://youtube.com';

$code = $urlConverter->encode($url2);
echo $code . PHP_EOL;
$decode = $urlConverter->decode($code) . PHP_EOL;
echo $decode;
exit;


