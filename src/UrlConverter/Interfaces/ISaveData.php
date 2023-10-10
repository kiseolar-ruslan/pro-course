<?php

declare(strict_types=1);

namespace App\UrlConverter\Interfaces;

use InvalidArgumentException;

interface ISaveData
{
    /**
     * @param array|string $data
     * @return bool|int
     * @throws InvalidArgumentException
     */
    public function saveData(array|string $data): bool|int;
}