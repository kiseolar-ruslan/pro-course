<?php

namespace App\Core\CLI\Commands;

use App\Shortener\Interfaces\IUrlEncoder;
use App\Shortener\UrlConverter;

class UrlEncodeCommand extends AbstractCommand
{
    const NAME = 'encode';

    /**
     * @param IUrlEncoder $convertor
     */
    public function __construct(protected IUrlEncoder $convertor)
    {
    }

    /**
     * @inheritDoc
     */
    protected function runAction(): string
    {
        return 'Shortcode: ' . $this->convertor->encode($this->params[0] ?? '');
    }

    /**
     * @inheritDoc
     */
    public static function getCommandDesc(): string
    {
        return 'Encode the url to short code';
    }

}
