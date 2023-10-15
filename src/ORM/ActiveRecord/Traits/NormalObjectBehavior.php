<?php

namespace App\ORM\ActiveRecord\Traits;

use ReflectionClass;
use ReflectionException;

trait NormalObjectBehavior
{
    /**
     * @var ReflectionClass[]
     */
    protected static array|null $refClass = [];

    /**
     * @throws ReflectionException
     */
    protected static function getRefClass($class = null)
    {
        if (is_null($class)) {
            $class = static::class;
        }
        if (!isset(static::$refClass[$class])) {
            static::$refClass[$class] = new ReflectionClass($class);
        }
        return static::$refClass[$class];
    }

    public function save(array $options = [])
    {
        $properties = static::getRefClass($this::class)->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($properties as $property) {
            $this->attributes[$property->getName()] = $property->getValue($this);
        }
        parent::save($options);
    }

    protected function newRelatedInstance($class)
    {
        return tap(static::getRefClass($class)->newInstanceWithoutConstructor(), function ($instance) {
            if (!$instance->getConnectionName()) {
                $instance->setConnection($this->connection);
            }
        });
    }

    public static function __callStatic($method, $parameters)
    {
        $obj = static::getRefClass()->newInstanceWithoutConstructor();
        return $obj->$method(...$parameters);
    }

    public function newInstance($attributes = [], $exists = false)
    {
        $model         = static::getRefClass()->newInstanceWithoutConstructor();
        $model->exists = $exists;
        $model->setConnection(
            $this->getConnectionName()
        );
        $model->setTable($this->getTable());
        $model->mergeCasts($this->casts);
        $model->fill((array)$attributes);
        return $model;
    }

    public function newFromBuilder($attributes = [], $connection = null)
    {
        $model = static::getRefClass()->newInstanceWithoutConstructor();
        foreach (static::getRefClass()->getProperties(\ReflectionProperty::IS_PRIVATE) as $property) {
            $property->setValue($model, $attributes->{$property->getName()});
        }
        $model->exists = true;
        $model->setRawAttributes((array)$attributes, true);
        $model->setConnection($connection ?: $this->getConnectionName());
        $model->fireModelEvent('retrieved', false);

        return $model;
    }
}