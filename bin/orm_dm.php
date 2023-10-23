<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManager;

/**
 * @var EntityManager $entityManager
 */
$config = include_once __DIR__ . '/../src/DIContainer/bootstrap.php';

$entityManager = $config->get(EntityManager::class);
exit;