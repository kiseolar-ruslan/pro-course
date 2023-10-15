<?php

declare(strict_types=1);

namespace App\UrlConverter\Actions;

use App\ORM\ActiveRecord\Models\UrlCode;
use App\UrlConverter\Interfaces\ISaveData;
use InvalidArgumentException;

class SavingDataToTheDB implements ISaveData
{
    public function __construct(protected UrlCode $urlCode)
    {
    }

    public function saveData(array $data): bool|int
    {
        if (true === empty($data)) {
            throw new InvalidArgumentException();
        }

        $code = array_key_first($data);
        $url  = current($data);

        $this->urlCode->code = $code;
        $this->urlCode->url  = $url;

        return $this->urlCode->save();
    }
}