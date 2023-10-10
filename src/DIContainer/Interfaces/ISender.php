<?php

declare(strict_types=1);

namespace App\DIContainer\Interfaces;

interface ISender
{
    public function send(): string;
}