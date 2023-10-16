<?php

declare(strict_types=1);

use App\ORM\ActiveRecord\DataBaseConnectionAR;
use App\ORM\ActiveRecord\Models\UrlCode;
use App\ORM\ActiveRecord\Models\User;

$container = include_once __DIR__ . '/../src/DIContainer/bootstrap.php';

$container->get(DataBaseConnectionAR::class);


//$users = User::all();
//foreach ($users as $user) {
//    echo $user->name . ' - ' . $user->id . PHP_EOL;
//}
//echo User::find(3) . PHP_EOL;
//$a    = UrlCode::query()->where("code", "96FC8")->value("url");
//$code = UrlCode::query()->where("url",)->value("code");

//$b = $a->value('url');
//exit;


//$user->save();
//$users = User::all();
//
///**
// * @var User[] $users
// */
//foreach ($users as $user) {
//    echo $user->name . ' - ' . count($user->phones) . ': ' . $user->phones->pluck('phone')->implode(', ') . PHP_EOL;
//}

