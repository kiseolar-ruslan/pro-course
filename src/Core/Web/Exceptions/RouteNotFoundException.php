<?php

declare(strict_types=1);

namespace App\Core\Web\Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    protected $message = 'Route is not found!';
}