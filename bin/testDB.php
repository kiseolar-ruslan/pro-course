#!/usr/bin/env php
<?php

use App\TestUser;

$container = require_once __DIR__ . '/../src/bootstrap.php';

try {
    $dbh = new PDO("mysql:host=db_mysql;dbname=base", "ukrlan", "pass4ukrlan");

    $allUsers = $dbh->query("select * from users")->fetchAll(PDO::FETCH_CLASS, TestUser::class);

    /**
     * @var TestUser[] $allUsers
     */
    foreach ($allUsers as $user) {
        echo $user->getId() . ' - ' . $user->getEmail() . PHP_EOL;
    }

    $newUser = $allUsers[0];
    $newUser->setStatus(2);

    $dbh->prepare("update users set status=:status where id=:id")->execute(
        [':status' => $newUser->getStatus(), ':id' => $newUser->getId()]
    );
} catch (PDOException $e) {
    echo $e->getCode() . ': ' . $e->getMessage() . ' (' . $e->getLine() . ')' . PHP_EOL;
}
exit;