<?php

namespace App\Payments\PS\Paypal;

use App\Payments\Exceptions\RejectPaymentException;
use App\Payments\Interfaces\IPaymentSystem;
use App\Payments\PS\LiqPay\LiqpaySDK;

class PaypalPaymentSystem implements IPaymentSystem
{

    /**
     * @inheritDoc
     */
    public function pay(int $amount, array $context = []): bool
    {
        if (!$this->api($amount, $context['email'])) {
            throw new RejectPaymentException('LiqPay reject payment');
        }
        return true;
    }

    protected function api(int $amount, string $email): bool
    {
        return true;
    }

}