<?php

namespace App\Payments;

use App\Calculator\Actions\Expo;
use App\Calculator\Calculator;
use App\Payments\Exceptions\PayException;
use App\Payments\Exceptions\RejectPaymentException;
use App\Payments\Interfaces\IOrder;
use App\Payments\Interfaces\IPaymentSystem;
use App\Payments\Interfaces\IPayService;
use App\ServiceLocator;

class PayService implements IPayService
{

    public function __construct(protected IPaymentSystem $paymentSystem)
    {
    }

    public function pay(IOrder $order, ?callable $success = null, ?callable $error = null): bool
    {
        try {
            $res = true;
            $this->paymentSystem->pay($order->getAmount(), $order->getUserInfo());
            if (!is_null($success)) {
                $success($order);
            }
        } catch (RejectPaymentException $e) {
            if (!is_null($error)) {
                $error($order, $e);
            }
            $res = false;
//            throw new PayException($e->getMessage(), $e->getCode());
        }

        /**
         * @var Calculator $calculator
         */
        $calculator = ServiceLocator::getInstance()->getService('calc');
        $calculator->actionRegistration(ServiceLocator::getInstance()->getService(Expo::class));


        return $res;
    }
}