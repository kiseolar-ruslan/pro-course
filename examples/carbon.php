<?php

use Carbon\Carbon;

require_once __DIR__ . '/../vendor/autoload.php';


$dateTime = new DateTime();
$interval = new DateInterval('P1Y');
$dateTime->add($interval);
echo $dateTime->format('Y-m-d');


echo PHP_EOL;

$carbon = new Carbon();
$carbon->addYear();
echo $carbon->toDateString();
echo PHP_EOL;

exit();