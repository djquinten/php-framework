<?php

namespace src\Foundation\Configuration;

use src\Foundation\Application;

class ApplicationBuilder
{
    public function __construct(
        protected Application $app,
    ) {
    }

    public function withRouting(
        string $web,
    ): static {
        require_once $web;

        return $this;
    }

    public function withMiddleware(
        ?callable $middleware = null,
    ): static {
        return $this;
    }

    public function create(): Application
    {
        return $this->app;
    }
}