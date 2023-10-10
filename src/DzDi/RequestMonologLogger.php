<?php

declare(strict_types=1);

namespace App\DzDi;

use App\DzDi\Interfaces\IRequestLogger;
use App\Shortener\Interfaces\IUrlValidator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;


class RequestMonologLogger implements IRequestLogger
{
    public function __construct(
        protected Logger          $monologLogger,
        protected ClientInterface $guzzle,
        protected IUrlValidator   $urlValidator
    ) {
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $this->validateUrl($url);

        try {
            $response        = $this->guzzle->request($method, $url, $options);
            $statusCode      = $response->getStatusCode();
            $responseBody    = $response->getBody();
            $sizeInBytes     = $responseBody->getSize();
            $sizeInKilobytes = intdiv($sizeInBytes, 1024) . 'kB';

            $this->monologLogger->info('Status code: ' . $statusCode . ' | Response size: ' . $sizeInKilobytes);
        } catch (GuzzleException $e) {
            $this->monologLogger->error('Connect to GuzzleHttp error: ' . $e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }

        return $response->withStatus($statusCode);
    }

    protected function validateUrl(string $url): void
    {
        try {
            $this->urlValidator->validateUrl($url);
            $this->urlValidator->checkRealUrl($url);
        } catch (InvalidArgumentException $e) {
            $this->monologLogger->error('Invalid URL: ' . $e->getMessage());
            throw $e;
        }
    }

    public function __destruct()
    {
        foreach ($this->monologLogger->getHandlers() as $item) {
            $item->close();
        }
    }
}