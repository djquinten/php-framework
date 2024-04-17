<?php

namespace Src\Foundation\Routing;

class RouteRegister
{
    public function __construct(
        private string $method,
        private string $uri,
        private string $action
    ) {
    }

    public function register(): void
    {
        Kernel::addRoute($this->method, $this->uri, $this->action);
    }
}