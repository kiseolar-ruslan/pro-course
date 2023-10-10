<?php

namespace App\Payments\Models;

use App\Payments\Interfaces\IOrder;

class Order implements IOrder
{

    public function getId(): int
    {
        return rand(1, 10);
    }

    public function getAmount(): int
    {
        return rand(1000, 2000);
    }

    public function getUserInfo(): array
    {
        return [
            'id'    => rand(1, 10),
            'login' => 'Petro',
            'email' => 'qwerty@gmail.com',
            'card'  => '1111 2222 3333 4444',
        ];
    }

    public function setStatusOk(): void
    {
        // TODO: Implement setStatusOk() method.
    }

    public function setStatusReject(): void
    {
        // TODO: Implement setStatusReject() method.
    }
}