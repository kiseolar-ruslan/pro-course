<?php

namespace App\Core\CLI\Commands;


class TestCommand extends AbstractCommand
{
    protected function runAction(): string
    {
        return 'Result for test command';
    }

    public static function getCommandDesc(): string
    {
        return 'This command demonstrates a simple use of the CLI';
    }
}
