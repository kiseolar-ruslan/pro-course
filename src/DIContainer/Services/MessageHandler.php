<?php

declare(strict_types=1);

namespace App\DIContainer\Services;

use App\DIContainer\Interfaces\ISender;

class MessageHandler implements ISender
{
    public function __construct(protected ISender $sender)
    {
    }

    public function changeSender(ISender $newSender): static
    {
        $this->sender = $newSender;
        return $this;
    }

    public function send(): string
    {
        return $this->sender->send();
    }
}