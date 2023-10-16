<?php

declare(strict_types=1);


use App\ORM\ActiveRecord\DataBaseConnectionAR;
use App\ORM\ActiveRecord\Models\UrlCode;

$container = require_once __DIR__ . '/src/DIContainer/bootstrap.php';
$container->get(DataBaseConnectionAR::class);



//Delete all identifier data
//$urlCodeModel = new UrlCode();
//$id = UrlCode::pluck("id")->toArray();
//UrlCode::whereIn('id', $id)->delete();
//exit;