<?php

use App\Core\CLI\CLIWriter;
use App\Core\CLI\CommandHandler;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Log\LoggerInterface;
use UfoCms\ColoredCli\CliColor;


$container = require_once __DIR__ . '/../src/bootstrap.php';

$monologFilePath = $container->get('monolog.level.error');

/**
 * @var LoggerInterface $monolog
 * @var CommandHandler $commandHandler
 */

$monolog        = $container->get('monolog.logger');
$commandHandler = $container->get(CommandHandler::class);

try {
    $commandHandler->handle($argv, function ($params, Throwable $e) use ($monolog) {
        $monolog->error($e->getMessage());
        CLIWriter::getInstance()->setColor(CliColor::RED)
                 ->writeLn($e->getMessage());

        CLIWriter::getInstance()->write($e->getFile() . ': ')
                 ->writeLn($e->getLine());
    });
} catch (Throwable $e) {
    echo $e->getMessage();
}

exit;