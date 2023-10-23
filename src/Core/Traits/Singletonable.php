<?php

namespace App\Core\Traits;

use Exception;

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

    /**
     * @throws Exception
     */
    protected function closeMethod(): void
    {
        throw new Exception('This class is singleton');
    }

    /**
     * @throws Exception
     */
    public function __clone(): void
    {
        $this->closeMethod();
    }

    /**
     * @throws Exception
     */
    public function __wakeup(): void
    {
        $this->closeMethod();
    }

    /**
     * @throws Exception
     */
    public function __unserialize(array $data): void
    {
        $this->closeMethod();
    }

}