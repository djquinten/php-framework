<?php

declare(strict_types=1);

namespace Src\Foundation;

use Src\Foundation\Configuration\ApplicationBuilder;
use Src\Foundation\Routing\Kernel;
use Src\Http\Request;

class Application
{
    public static function configure(): ApplicationBuilder
    {
        return new ApplicationBuilder(new self());
    }
    
    public function handleRequest(): void
    {
        Kernel::handleRoute(new Request());
    }
}
