<?php

declare(strict_types=1);

namespace App\Core\Web\Controllers;

class UserController
{
    public function indexAction(int $id): string
    {
        return 'Result for: ' . $id;
    }
}