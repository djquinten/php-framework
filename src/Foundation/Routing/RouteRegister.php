<?php

namespace Src\Foundation\Routing;

class RouteRegister
{
    public null | string | array $middleware;

    public function __construct(
        private string $method,
        private string $uri,
        public $action,
        public array $parameters = [],
    ) {
    }

    public function middleware(string | array $middleware): RouteRegister
    {
        $this->middleware = $middleware;
        return $this;
    }

    public function getMiddleware(): array | string
    {
        return $this->middleware ?? [];
    }
}