<?php

declare(strict_types=1);

namespace App\Core\Web\Controllers;

use App\Shortener\Interfaces\IUrlEncoder;
use App\UrlConverter\UrlConverter;

class UrlConverterController
{
    //Problem – hard binding on the 'UrlConverter' class
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