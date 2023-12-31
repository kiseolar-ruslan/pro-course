<?php

declare(strict_types=1);

namespace App\Core\Web\Controllers;

use App\Core\Web\Services\UrlConverterService;

class UrlConverterController
{
    //Problem – duplicate code
    public function __construct(protected UrlConverterService $urlConverter)
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