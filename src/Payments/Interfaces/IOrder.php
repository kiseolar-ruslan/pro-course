<?php

namespace App\Payments\Interfaces;

interface IOrder
{
    public function getId(): int;

    public function getAmount(): int;

    public function getUserInfo(): array;

    public function setStatusOk(): void;

    public function setStatusReject(): void;
}