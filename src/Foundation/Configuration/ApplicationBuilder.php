<?php

namespace Src\Foundation\Configuration;

use Src\Foundation\Application;
use Src\Foundation\Routing\Route;

class ApplicationBuilder
{
    public function __construct(
        protected Application $app,
    ) { }

    public function withRouting(
        string $web,
    ): static {
        require_once $web;

        return $this;
    }

    public function withMiddleware(
        ?callable $middleware = null,
    ): static {
        if ($middleware) {
            $middleware(new Middleware());
        }
        return $this;
    }

    public function create(): Application
    {
        return $this->app;
    }
}