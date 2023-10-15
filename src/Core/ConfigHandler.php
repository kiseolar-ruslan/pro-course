<?php

namespace App\Core;

use App\Core\Exceptions\ParameterNotFoundException;
use App\Core\Interfaces\IConfigHandler;
use App\Core\Interfaces\ISingleton;
use App\Core\Traits\Singletonable;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @property-read $dbFile
 */
class ConfigHandler implements IConfigHandler, ISingleton
{
    use Singletonable;

    /**
     * @var array Parameters from file
     */
    protected array $parameters = [];

    /**
     * @description Parameter array loading method
     * @param array $configs
     * @return $this
     */
    public function addConfigs(array $configs): self
    {
        $this->parameters = array_merge($this->parameters, $configs);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        try {
            $result = true;
            $this->getRealPath($id);
        } catch (ParameterNotFoundException $e) {
            $result = false;
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
    {
        return $this->getRealPath($id);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __get(string $name)
    {
        return $this->get(str_replace('_', '.', $name));
    }

    protected function getRealPath(string $id): mixed
    {
        $tokens  = explode('.', $id);
        $context = $this->parameters;

        while (null !== ($token = array_shift($tokens))) {
            if (!isset($context[$token])) {
                throw new ParameterNotFoundException('Parameter not found: ' . $id);
            }

            $context = $context[$token];
        }
        return $context;
    }
}