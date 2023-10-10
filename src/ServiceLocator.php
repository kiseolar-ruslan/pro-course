<?php

namespace App;

use App\Core\Interfaces\ISingleton;
use App\Core\Traits\Singletonable;
use App\Shortener\Exceptions\DataNotFoundException;

class ServiceLocator implements ISingleton
{
    use Singletonable;

    protected array $services = [];

    /**
     * @param string $name
     * @return object
     * @throws DataNotFoundException
     */
    public function getService(string $name): object
    {
        if (!$service = $this->services[$name]) {
            throw new DataNotFoundException();
        }
        return $service;
    }

    /**
     * @param string $name
     * @param object $service
     * @return self
     */
    public function addService(string $name, object $service): static
    {
        $this->services[$name] = $service;
        return $this;
    }

}