<?php

namespace Src\Middleware;

use Closure;
use Src\Http\Request;
use Src\Middleware\MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if ($_SESSION['user'] == null) {
            return header('Location: /login');
        }

        return $next($request);
    }
}