<?php

namespace App\Payments\PS\LiqPay;

use App\Payments\Exceptions\RejectPaymentException;
use App\Payments\Interfaces\IPaymentSystem;

class LiqPayPayment implements IPaymentSystem
{
    public function __construct(protected LiqpaySDK $liqpaySDK)
    {
    }

    /**
     * @inheritDoc
     */
    public function pay(int $amount, array $context = []): bool
    {
        if (!$this->liqpaySDK->api($amount, $context['card'])) {
            throw new RejectPaymentException('LiqPay reject payment');
        }
        return true;
    }
}