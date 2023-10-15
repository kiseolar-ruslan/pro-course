<?php

declare(strict_types=1);

use App\ORM\ActiveRecord\DataBaseConnectionAR;

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
];