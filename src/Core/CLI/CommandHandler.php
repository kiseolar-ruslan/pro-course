<?php

namespace App\Core\CLI;


use App\Core\CLI\Helpers\CliParamAnalyzer;
use App\Core\CLI\Interfaces\ICliCommand;
use App\Core\Interfaces\ICommandHandler;

class CommandHandler implements ICommandHandler
{
    /**
     * @var ICliCommand[]
     */
    protected array $commands = [];

    /**
     * @param ICliCommand $defaultCommand
     */
    public function __construct(protected ICliCommand $defaultCommand)
    {
        $this->addCommand($defaultCommand);
    }

    /**
     * @param ICliCommand $command
     * @return $this
     */
    public function addCommand(ICliCommand $command): self
    {
        $this->commands[$command::getCommandName()] = $command;
        return $this;
    }

    /**
     * @param array $params
     * @param callable|null $callback
     * @return void
     * @throws Exceptions\CliCommandException
     */
    public function handle(array $params = [], ?callable $callback = null): void
    {
        $defaultCommandName = $this->defaultCommand::getCommandName();
        $commandName        = CliParamAnalyzer::getCommand() ?? $defaultCommandName;

        try {
            $service = $this->commands[$commandName] ?? $this->commands[$defaultCommandName];
            $service->run(CliParamAnalyzer::getArguments());
        } catch (\Exception $e) {
            if ($callback) {
                $callback(CliParamAnalyzer::getArguments(), $e);
            } else {
                throw $e;
            }
        }
    }
}
