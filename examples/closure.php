<?php

use GuzzleHttp\Client;

$request = [
    'pass' => 'sgnfgkjdfngkjndf'
];

$logger = [];

class User
{
    protected int      $id;
    protected DateTime $lastActivity;
    protected int      $status = 1;

    public function __construct(protected string $login, protected string $pass)
    {
        $this->id           = rand();
        $this->lastActivity = new DateTime();
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getLastActivity(): DateTime
    {
        return $this->lastActivity;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

}

function app(array $req, ?callable $userProcessor = null): void
{
    // auth logic
    $user = new User($req['login'], $req['pass']);
    if (!is_null($userProcessor)) {
        $userProcessor($user);
    }
}

function app2(array $req, ?callable $errorHandler = null): void
{
    // auth logic
    try {
        $user = new User($req['login'], $req['pass']);
    } catch (\Throwable $e) {
        if (!is_null($errorHandler)) {
            $errorHandler($e);
        }
    }
}


$logFunction = function (User $user) use (&$logger) {
    $logger[] = [
        'id'     => $user->getId(),
        'login'  => $user->getLogin(),
        'status' => $user->getStatus(),
        'date'   => $user->getLastActivity(),
    ];
};

$httpClient = new Client();

$errorHandler = function (\Throwable $e) use ($httpClient, &$logger) {
    $httpClient->request('POST', 'telegram.bot.api', [
        'script' => __METHOD__,
        'error'  => [
            'message' => $e->getMessage(),
            'code'    => $e->getCode()
        ]
    ]);
};

//app2($request, $errorHandler);


$a = 1;
$f = function (int $b) use ($a) {
    echo $a;
    echo $b;
    echo PHP_EOL;
};

$a = 2;
$f($a);

$a = 3;
$f($a);


exit;