<?php

namespace App\Payments\PS\LiqPay;

class LiqpaySDK
{
    public function api(int $amount, string $cardNumber): bool
    {
        return true;
    }
}