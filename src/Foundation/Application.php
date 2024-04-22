<?php

namespace Src\Foundation;

use Src\Foundation\Configuration\ApplicationBuilder;
use Src\Foundation\Routing\Kernel;

class Application
{
    public static function configure(): ApplicationBuilder
    {
        return new ApplicationBuilder(new static());
    }

    public function handleRequest(): void
    {
        Kernel::handleRoute();
    }
}