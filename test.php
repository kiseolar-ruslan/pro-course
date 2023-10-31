<?php

declare(strict_types=1);


use App\ORM\ActiveRecord\DataBaseConnectionAR;
use App\ORM\ActiveRecord\Models\UrlCode;

$container = require_once __DIR__ . '/src/DIContainer/bootstrap.php';
$container->get(DataBaseConnectionAR::class);


function test(callable $callable): void
{
    $a = 10;
    $b = 20;

    echo $callable($a, $b) . PHP_EOL;
}

test(function ($z, $x) {
    $afterZ = $z + 1;
    $afterX = $x + 1;
    return "Before: " . $z . " After: " . $afterZ . PHP_EOL .
        "Before: " . $x . " After: " . $afterX;
});


//Delete all identifier data
//$urlCodeModel = new UrlCode();
//$id = UrlCode::pluck("id")->toArray();
//UrlCode::whereIn('id', $id)->delete();
//exit;