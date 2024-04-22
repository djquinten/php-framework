<?php

namespace Src\Foundation\Configuration;

use Src\Foundation\Routing\Kernel;
use Src\Middleware\MiddlewareInterface;

class Middleware
{
    public static $middleware = [];

    public function append(
        array|string $middleware
    ): void
    {
        is_array($middleware) or $middleware = [$middleware];

        Kernel::$middleware = array_merge(Kernel::$middleware, $middleware);
        // $this->middleware = array_merge($this->middleware, $middleware);
    }
}