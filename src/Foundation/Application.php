<?php

namespace src\Foundation;

use src\Foundation\Configuration\ApplicationBuilder;
use src\Foundation\Routing\Kernel;

class Application
{
    public static function configure(string $basePath = null): ApplicationBuilder
    {
        return new ApplicationBuilder(new static($basePath));
    }

    public function handleRequest(): void
    {
        Kernel::handleRoute();
    }
}