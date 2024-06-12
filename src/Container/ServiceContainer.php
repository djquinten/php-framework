<?php

declare(strict_types=1);

namespace Src\Container;

final class ServiceContainer
{
    /**
     * Resolve the dependencies from the given class and method and return an array of objects.
     *
     * @param $class
     * @param $method
     * @return array<object>
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function resolve($class, $method): array
    {
        return self::resolveDependencies((new \ReflectionMethod(new $class, $method))->getParameters());
    }

    /**
     * Loops through the dependencies and triggers the build method to create new instances.
     *
     * @param array $dependencies
     * @return array<object>
     * @throws \Exception
     */
    protected static function resolveDependencies(array $dependencies): array
    {
        $result = [];

        foreach ($dependencies as $dependency) {
            $dependencyClass = $dependency->getType();

            if ($dependencyClass !== null) {
                $result[] = self::build($dependencyClass->getName());
                continue;
            }
            $result[] = null;
        }

        return $result;
    }

    /**
     * Creates a new instance of the given class.
     *
     * @param string $class
     * @return object
     * @throws \Exception
     */
    protected static function build(string $class): object
    {
        $reflector = new \ReflectionClass($class);

        if (! $reflector->isInstantiable()) {
            throw new \Exception("{$class} is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        if ($constructor === null) {
            return new $class;
        }

        $dependencies = $constructor->getParameters();
        $instances = self::resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);       
    }
}