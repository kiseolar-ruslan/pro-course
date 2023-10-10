<?php

namespace App\Shortener\Interfaces;

use InvalidArgumentException;

interface IUrlValidator
{
    /**
     * @param string $url
     * @return bool
     * @throws InvalidArgumentException
     */
    public function validateUrl(string $url): bool;

    /**
     * @param string $url
     * @return bool
     * @throws InvalidArgumentException
     */
    public function checkRealUrl(string $url): bool;
}