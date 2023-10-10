<?php


use App\Calculator\Actions\Div;
use App\Calculator\Actions\Expo;
use App\Calculator\Actions\Multi;
use App\Calculator\Actions\Qwe;
use App\Calculator\Actions\Sub;
use App\Calculator\Actions\Sum;
use App\Calculator\Calculator;
use App\Calculator\SmartCalculator;
use App\ServiceLocator;

require_once __DIR__ . '/../examples/autoload.php';

function separator()
{
    return str_repeat('*', 70) . PHP_EOL;
}

$sl = ServiceLocator::getInstance();

$sl->addService('calc', new SmartCalculator())
   ->addService('calc.sum', new Sum())
   ->addService('calc.div', new Div())
   ->addService('calc.sub', new Sub())
   ->addService(Expo::class, new Expo())
   ->addService(Multi::class, new Multi());


try {
    $calculator = $sl->getService('calc');

    $calculator
        ->actionRegistration($sl->getService('calc.sum'))
        ->actionRegistration($sl->getService('calc.div'))
        ->actionRegistration($sl->getService('calc.sub'))
        ->actionRegistration($sl->getService(Multi::class))
        ->actionRegistration($sl->getService(Expo::class));
} catch (Exception $e) {
    echo $e->getMessage();
    echo separator();
    exit;
} catch (\Error $err) {
    echo $err->getMessage();
    echo separator();
    exit;
}

echo separator();
echo 'Консольний калькулятор' . PHP_EOL;
echo 'Введіть простий вираз для обчислення двох чисел' . PHP_EOL;
echo 'Наприклад: 5 * 2' . PHP_EOL;
echo 'Доступні дії: ' . implode(', ', $calculator->getCalculatePossibilities()) . PHP_EOL;
echo separator();


//$inputData1 = readline('Введіть перше число: ');
//$inputData2 = readline('Введіть дію (' . implode(', ', $calculator->getCalculatePossibilities()) . '): ');
//$inputData3 = readline('Введіть друге число: ');

//try {
//
//    $result = $calculator->calculate($inputData1, $inputData3, $inputData2);
//    echo 'Результат: ' . $result . PHP_EOL;
//} catch (Exception $e) {
//    echo $e->getMessage();
//} catch (\Error $err) {
//    echo $err->getMessage();
//}
//echo PHP_EOL;
//echo separator();

$inputData = readline('Введіть вираз: ');
try {
    $result = $calculator->calculateExpression($inputData);
    echo 'Результат: ' . $inputData . ' = ' . $result . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
} catch (\Error $err) {
    echo $err->getMessage();
}
echo PHP_EOL;
echo separator();
