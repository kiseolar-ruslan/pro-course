<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class Calc
{
    public function sum(int $a, int $b): int
    {
        return $a + $b;
    }
}

class SmartCalc extends Calc
{
    public function sum(int $a, int $b): int
    {
        return ($a + $b) * 2;
    }
}

interface IUserQuery
{
    public function get(string $key): mixed;
}

class PostRequest implements IUserQuery
{
    public function get(string $key): mixed
    {
        return $_POST[$key] ?? null;
    }
}

class GetRequest implements IUserQuery
{
    public function get(string $key): mixed
    {
        return $_GET[$key] ?? null;
    }
}

class CliRequest implements IUserQuery
{

    public function get(string $key): mixed
    {
        $i = (int)$key;
        return $_SERVER['argv'][$i] ?? null;
    }
}

interface IAppHandler
{
    public function handle(): mixed;
}

class HelloHandler implements IAppHandler
{

    public function handle(): mixed
    {
        return 'Hello World';
    }
}

class CalcHandler implements IAppHandler
{
    protected const MAP = [
        'a' => 1,
        'b' => 2
    ];

    public function __construct(
        protected IUserQuery $userQueryHandler,
        protected Calc       $calc
    ) {
    }

    public function handle(): mixed
    {
        $a = $this->userQueryHandler->get($this->getKey('a'));
        $b = $this->userQueryHandler->get($this->getKey('b'));

        return $this->calc->sum($a, $b);
    }

    protected function getKey(string $key): string
    {
        if ($_SERVER['argc'] > 0) {
            $key = static::MAP[$key];
        }
        return $key;
    }

}

class App
{
    static int $a = 1;

    public function __construct(
        protected ClientInterface $client,
        protected IAppHandler     $appHandler
    ) {
    }

    public function handle($webhook): void
    {
        $result = $this->appHandler->handle();
//        $this->client->request('GET', $webhook . $result);
        echo '...' . $result . PHP_EOL;
    }
}

$handler = new CalcHandler(new CliRequest(), new Calc());

$app = new App(new Client(), new HelloHandler());

$app->handle('https://mysite.com/webhook?res=');


