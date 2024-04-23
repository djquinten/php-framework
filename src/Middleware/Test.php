<?php

declare(strict_types=1);

namespace Src\Middleware;

use Closure;
use Src\Http\Request;
use Src\Middleware\MiddlewareInterface;

class Test implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        echo "handling Test middleware<br>";

        return $next($request);
    }
}
