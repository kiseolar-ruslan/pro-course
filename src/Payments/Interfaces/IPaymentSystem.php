<?php

namespace App\Payments\Interfaces;

use App\Payments\Exceptions\RejectPaymentException;

interface IPaymentSystem
{
    /**
     * @param int $amount
     * @param array $context
     * @return bool
     * @throws RejectPaymentException
     */
    public function pay(int $amount, array $context = []): bool;
}