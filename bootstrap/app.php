<?php

use Src\Middleware\Auth;
use Src\Middleware\Test;
use Src\Foundation\Application;
use Src\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
    )
    ->withMiddleware(middleware: function (Middleware $middleware) {
        $middleware->append([
            Auth::class,
            Test::class,
        ]);
    })
    ->create();
