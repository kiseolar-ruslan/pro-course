<?php

declare(strict_types=1);

namespace App\Core\Web\Services;

use App\UrlConverter\UrlConverter;

class UrlConverterService
{
    public function __construct(protected UrlConverter $urlConverter)
    {
    }

    public function encode(string $url): string
    {
        return $this->urlConverter->encode($url);
    }

    public function decode(string $code): string
    {
        return $this->urlConverter->decode($code);
    }
}