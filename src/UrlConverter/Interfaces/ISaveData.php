<?php

declare(strict_types=1);

namespace App\UrlConverter\Interfaces;

use InvalidArgumentException;

interface ISaveData
{
    /**
     * @param array $data
     * @return bool|int
     * @throws InvalidArgumentException
     */
    public function saveData(array $data): bool|int;
}