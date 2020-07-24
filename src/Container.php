<?php


namespace lwmay\DependencyInjection;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;

/**
 * Class Container
 * @package lwmay\DependencyInjection
 */
class Container implements ContainerInterface
{
    /**
     * @var array
     */
    private array $instances = [];

    public function get($id)
    {
        if (!$this->has($id)) {
            $reflectionClass = new ReflectionClass($id);

            $contructor = $reflectionClass->getConstructor();

            if (null === $contructor){
                $this->instances[$id] = $reflectionClass->newInstance();
            } else {
                $parameters = $contructor->getParameters();
                $this->instances[$id] = $reflectionClass->newInstanceArgs(
                  array_map(
                      fn (\ReflectionParameter $parameter) => $this->get($parameter->getClass()->getName()),
                      $parameters
                  )
                );
            }
        }
        return $this->instances[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return isset($this->instances[$id]);
    }

    public function addAlias(string $id, string $class): self
    {
        $this->aliases[$id] = $class;
        return $this;
    }
}