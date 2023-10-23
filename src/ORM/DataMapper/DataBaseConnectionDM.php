<?php

declare(strict_types=1);

namespace App\ORM\DataMapper;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

class DataBaseConnectionDM
{
    public const DRIVER = 'pdo_mysql';
    public const HOST   = 'localhost';

    protected ?EntityManager $em = null;
    protected Configuration  $config;
    protected Connection     $connection;

    /**
     * @throws Exception
     */
    public function __construct(
        string $database,
        string $user,
        string $pass,
        string $host = self::HOST,
        bool   $isDevMode = false,
        string $dbDriver = self::DRIVER,
        array  $entityPaths = [],
    ) {
        if (true === empty($entityPaths)) {
            $entityPaths = [
                __DIR__ . '/Entity',
            ];
        }

        $dbParams = [
            'host'     => $host,
            'driver'   => $dbDriver,
            'user'     => $user,
            'password' => $pass,
            'dbname'   => $database,
        ];

        $this->config     = ORMSetup::createAttributeMetadataConfiguration($entityPaths, $isDevMode);
        $this->connection = DriverManager::getConnection($dbParams, $this->config);
    }

    /**
     * @throws MissingMappingDriverImplementation
     */
    public function getEM(): EntityManager
    {
        if (true === is_null($this->em)) {
            $this->em = new EntityManager($this->connection, $this->config);
        }

        return $this->em;
    }
}