<?php

declare(strict_types=1);

namespace App\UrlConverter\Actions;

use App\UrlConverter\Interfaces\ISaveData;
use InvalidArgumentException;

class SavingUrlToTheFile implements ISaveData
{
    protected const FILE_NAME = 'url.json';

    public function saveData(array|string $data, string $fileName = self::FILE_NAME): bool
    {
        if (file_exists($fileName) === false) {
            $steam = fopen($fileName, 'w');
            fclose($steam);
        }

        $currentData = file_get_contents($fileName);

        if ($currentData === false) {
            throw new InvalidArgumentException("Failed to read data from file $fileName");
        }

        $mergedData = array_merge(json_decode($currentData, true) ?? [], $data);

        $steam = fopen($fileName, 'w+');

        if ($steam === false) {
            throw new InvalidArgumentException("Failed to open file $fileName");
        }

        $jsonFormat = json_encode($mergedData, JSON_PRETTY_PRINT);

        if ($jsonFormat === false) {
            throw new InvalidArgumentException("Failed to encode data to JSON");
        }

        fwrite($steam, $jsonFormat);
        fclose($steam);

        return true;
    }
}