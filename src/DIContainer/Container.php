<?php

declare(strict_types=1);

namespace App\DIContainer;

use App\Core\Exceptions\ParameterNotFoundException;
use App\Core\Exceptions\ServiceNotFoundException;
use App\DIContainer\Interfaces\IContainer;
use Psr\Container\ContainerInterface;

class Container implements IContainer
{
    /**
     * @description All incoming services
     * @var array
     */
    protected array $allServices = [];

    public function __construct(protected ContainerInterface $configs, array ...$services)
    {
        $this->mergeConfigurations(...$services);
    }

    protected function mergeConfigurations(array ...$services): static
    {
        foreach ($services as $service) {
            $this->allServices = array_merge($this->allServices, $service);
        }

        return $this;
    }

    public function get(string $id): mixed
    {
        try {
            $result = $this->configs->get($id);
        } catch (ParameterNotFoundException) {
            if (false === $this->has($id)) {
                throw new ServiceNotFoundException("Service $id not found!");
            }
            $result = $this->allServices[$id]($this);
        }

        return $result;
    }

    public function has(string $id): bool
    {
        return isset($this->allServices[$id]);
    }
}