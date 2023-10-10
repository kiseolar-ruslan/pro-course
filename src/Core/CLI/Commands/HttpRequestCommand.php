<?php

declare(strict_types=1);

namespace App\Core\CLI\Commands;

use App\DzDi\Interfaces\IRequestLogger;
use Psr\Http\Client\ClientExceptionInterface;

class HttpRequestCommand extends AbstractCommand
{
    public const NAME = 'http_request';

    public function __construct(protected IRequestLogger $request)
    {
    }

    public static function getCommandDesc(): string
    {
        return 'Http request, http code log and response size in kb';
    }

    /**
     * @throws ClientExceptionInterface
     */
    protected function runAction(): string
    {
        $response = $this->request->request($this->params[0], $this->params[1]);
        return 'Successfully saved!' . PHP_EOL .
            'Status code: ' . $response->getStatusCode();
    }
}