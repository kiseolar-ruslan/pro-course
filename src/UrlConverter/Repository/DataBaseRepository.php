<?php

declare(strict_types=1);

namespace App\UrlConverter\Repository;

use App\UrlConverter\Interfaces\ICodeRepository;
use App\UrlConverter\ValueObjects\UrlCodePair;

class DataBaseRepository implements ICodeRepository
{
    //todo when we connect the database

    public function saveEntity(UrlCodePair $urlCodePair): bool
    {
    }

    public function codeIsset(string $code): bool
    {
    }

    public function getUrlByCode(string $code): string
    {
    }

    public function getCodeByUrl(string $url): string
    {
    }
}