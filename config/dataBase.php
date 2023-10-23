<?php

declare(strict_types=1);

use App\ORM\ActiveRecord\DataBaseConnectionAR;
use App\ORM\DataMapper\DataBaseConnectionDM;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../vendor/autoload.php';

return [
    DataBaseConnectionAR::class => function ($container) {
        return new DataBaseConnectionAR(
            $container->get('db.mysql.dbName'),
            $container->get('db.mysql.user'),
            $container->get('db.mysql.password'),
            $container->get('db.mysql.dockerHost'),
        );
    },
    DataBaseConnectionDM::class => function ($container) {
        return new DataBaseConnectionDM(
            $container->get('db.mysql.dbName'),
            $container->get('db.mysql.user'),
            $container->get('db.mysql.password'),
            $container->get('db.mysql.dockerHost'),
            $container->get('devMode'),
        );
    },
    EntityManager::class        => function ($container) {
        $dbConnectionDM = $container->get(DataBaseConnectionDM::class);
        return $dbConnectionDM->getEM();
    }
];