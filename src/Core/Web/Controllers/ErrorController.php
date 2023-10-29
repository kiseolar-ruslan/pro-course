<?php

declare(strict_types=1);

namespace App\Core\Web\Controllers;

class ErrorController
{
    public function error404Action(): string
    {
        return 'Route not found!';
    }

    public function errorUrlConverterAction(): string
    {
        return 'Invalid URL!';
    }
}