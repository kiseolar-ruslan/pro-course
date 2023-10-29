<?php

declare(strict_types=1);

namespace App\ORM\ActiveRecord;

use Illuminate\Database\Capsule\Manager;

class DataBaseConnectionAR
{
    public const DRIVER    = 'mysql';
    public const HOST      = 'localhost';
    public const PREFIX    = '';
    public const CHARSET   = 'utf8';
    public const COLLATION = 'utf8_unicode_ci';

    public function __construct(
        string $database,
        string $user,
        string $pass,
        string $host = self::HOST,
        string $dbDriver = self::DRIVER,
        string $prefix = self::PREFIX,
        string $charset = self::CHARSET,
        string $collation = self::COLLATION
    ) {
        $dBManager = new Manager();
        $dBManager->addConnection([
            "driver"    => $dbDriver,
            "host"      => $host,
            "database"  => $database,
            "username"  => $user,
            "password"  => $pass,
            "charset"   => $charset,
            "collation" => $collation,
            "prefix"    => $prefix
        ]);

        $dBManager->bootEloquent();
    }
}