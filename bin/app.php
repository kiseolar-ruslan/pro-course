<?php

use App\Calculator\Actions\Div;
use App\Calculator\Actions\Expo;
use App\Calculator\Actions\Multi;
use App\Calculator\Actions\Qwe2;
use App\Calculator\Actions\Sum;
use App\Calculator\Calculator;
use App\Calculator\SmartCalculator;
use App\Core\CLI\CLIWriter;
use App\Core\CLI\CommandHandler;
use App\Core\CLI\Commands\CalculatorCommand;
use App\Core\CLI\Commands\HelloCommand;
use App\Core\CLI\Commands\HelloUserCommand;
use App\Core\CLI\Commands\HelpCommand;
use App\Core\CLI\Commands\HttpRequestCommand;
use App\Core\CLI\Commands\TestCommand;
use App\Core\CLI\Commands\UrlDecodeCommand;
use App\Core\CLI\Commands\UrlEncodeCommand;
use App\Core\ConfigHandler;
use App\Shortener\{FileRepository,
    Helpers\UrlValidator,
    UrlConverter
};
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use UfoCms\ColoredCli\CliColor;

require_once __DIR__ . '/../vendor/autoload.php';

$configs       = require_once __DIR__ . '/../config/params.php';
$configHandler = ConfigHandler::getInstance()->addConfigs($configs);

$app = new CommandHandler(new HelpCommand());

$monolog = new Logger($configHandler->get('monolog.channel'));
$monolog
    ->pushHandler(new StreamHandler($configHandler->get('monolog.level.error'), Level::Error))
    ->pushHandler(new StreamHandler($configHandler->get('monolog.level.info'), Level::Info));


$fileRepository = new FileRepository($configHandler->get('dbFile'));
$urlValidator   = new UrlValidator(new Client());
$converter      = new UrlConverter(
    $fileRepository,
    $urlValidator,
    $configHandler->get('urlConverter.codeLength')
);

$calculator = new SmartCalculator();
$calculator
    ->actionRegistration(new Sum())
    ->actionRegistration(new Div())
    ->actionRegistration(new Qwe2());

$app->addCommand(new CalculatorCommand($calculator));


$app->addCommand(new UrlEncodeCommand($converter));
$app->addCommand(new UrlDecodeCommand($converter));
$app->addCommand(new TestCommand());
$app->addCommand(new HelpCommand());
$app->addCommand(new HelloCommand());
$app->addCommand(new HelloUserCommand());
$app->addCommand(
    new HttpRequestCommand(
        new \App\DzDi\RequestMonologLogger(
            new Logger('test'),
            new Client(),
            new UrlValidator(new Client())
        )
    )
);

try {
    $app->handle($argv, function (array $params, \Throwable $e) use ($monolog) {
        $monolog->error($e->getMessage());

        CLIWriter::getInstance()->setColor(CliColor::RED)
                 ->writeLn($e->getMessage());

        CLIWriter::getInstance()->write($e->getFile() . ': ')
                 ->writeLn($e->getLine());
    });
} catch (\Throwable $e) {
    echo $e->getMessage();
}



