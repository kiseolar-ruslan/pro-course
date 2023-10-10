<?php

use App\Payments\Exceptions\PayException;
use App\Payments\Interfaces\IOrder;
use App\Payments\PayService;
use App\Payments\PS\LiqPay\LiqPayPayment;
use App\Payments\PS\LiqPay\LiqpaySDK;
use App\Payments\PS\Paypal\PaypalPaymentSystem;
use App\qqq\Order;
use App\qqq\User;

require_once __DIR__ . '/../vendor/autoload.php';

$user = new User('petro', 'sdsfsdf');

$order = new Order($user);

$liqpay = new LiqPayPayment(new LiqpaySDK());
$paypal = new PaypalPaymentSystem();

$payService = new PayService($paypal);


try {
    $result = $payService->pay(
        $order,
        function (IOrder $order) {
            $order->setStatusOk();
            echo 'Order ' . $order->getId() . ' is paid';
        },
        function (IOrder $order, \Throwable $e) {
            $order->setStatusReject();
            echo 'Order ' . $order->getId() . ' is rejected. ' . $e->getMessage();
        }
    );
//    echo $result ? 'Payment is ok' : 'Some error';
} catch (PayException $e) {
//    echo 'Some Error: ' . $e->getMessage();
}
echo PHP_EOL;