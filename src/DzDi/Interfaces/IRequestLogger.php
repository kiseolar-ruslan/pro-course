<?php

namespace App\DzDi\Interfaces;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

interface IRequestLogger
{
    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface;
}
