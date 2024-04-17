<?php

namespace Src\Foundation\Routing;

class RouteRegister
{
    private ?string $name;
    private null|string|array $middleware;

    public function __construct(
        private string $method,
        private string $uri,
        private $action,
        private array $parameters = [],
    ) { }

    public function name(string $name): RouteRegister
    {
        $this->name = $name;
        return $this;
    }

    public function middleware (string $middleware): RouteRegister
    {
        $this->middleware = $middleware;
        return $this;
    }

    public function register(): void
    {
        Kernel::addRoute(
            method:     $this->method,
            uri:        $this->uri,
            action:     $this->action,
            parameters: $this->parameters,
            name:       $this->name,
        );
    }
}