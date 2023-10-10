<?php

declare(strict_types=1);

namespace App\UrlConverter\Actions;

use App\UrlConverter\Interfaces\ISaveData;

class SavingDataToTheDB implements ISaveData
{

    public function saveData(array|string $data, string $fileName): bool|int
    {
        return false;
    }
}