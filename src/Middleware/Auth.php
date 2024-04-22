<?php

namespace Src\Middleware;

use Closure;
use Src\Http\Request;
use Src\Middleware\MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}