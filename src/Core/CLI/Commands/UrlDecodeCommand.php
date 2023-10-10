<?php

namespace App\Core\CLI\Commands;

use App\Shortener\Interfaces\IUrlDecoder;
use App\Shortener\UrlConverter;

class UrlDecodeCommand extends AbstractCommand
{
    const NAME = 'decode';

    public function __construct(protected IUrlDecoder $convertor)
    {
    }

    protected function runAction(): string
    {
        return 'Shortcode: ' . $this->convertor->decode($this->params[0]);
    }

    public static function getCommandDesc(): string
    {
        return 'Decode shortcode to url';
    }
}
