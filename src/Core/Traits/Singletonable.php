<?php

namespace App\Core\Traits;

trait Singletonable
{
    protected static ?self $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function closeMethod(): void
    {
        throw new \Exception('This class is singleton');
    }

    public function __clone(): void
    {
        $this->closeMethod();
    }

    public function __wakeup(): void
    {
        $this->closeMethod();
    }

    public function __unserialize(array $data): void
    {
        $this->closeMethod();
    }

}