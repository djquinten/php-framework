<?php

declare(strict_types=1);

namespace Src\Foundation\Configuration;

use Src\Foundation\Routing\Kernel;
use Src\Middleware\MiddlewareInterface;

class Middleware
{
    public static array $middleware = [];

    public function append(
        array | string $middleware,
    ): void {
        $middlewares = is_array($middleware) ? $middleware : [$middleware];

        foreach ($middlewares as $middleware) {
            if (! (new \ReflectionClass($middleware))->implementsInterface(MiddlewareInterface::class)) {
                echo "Middleware must implement MiddlewareInterface<br>";
                die;
            }

            $className                         = (new \ReflectionClass(new $middleware))->getShortName();
            $middlewareName                    = (new $middleware)->name ?? strtolower($className);
            self::$middleware[$middlewareName] = $middleware;
        }

        Kernel::$middleware = array_merge(Kernel::$middleware, self::$middleware);
    }
}
