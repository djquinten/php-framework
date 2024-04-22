<?php

namespace Src\Foundation;

use Src\Foundation\Configuration\ApplicationBuilder;
use Src\Foundation\Routing\Kernel;
use Src\Foundation\Routing\Route;

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