<?php

namespace Src\Foundation\Configuration;

use Src\Middleware\MiddlewareInterface;

class Middleware
{
    protected $middleware = [];

    public function append(
        MiddlewareInterface $middleware
    ): void
    {
        $this->middleware[] = $middleware;
    }
}