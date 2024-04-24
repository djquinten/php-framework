<?php

declare(strict_types=1);

namespace Src\Middleware;

use Closure;
use Src\Http\Request;
use Src\Middleware\MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if ($_SESSION['user'] == null) {
            header('Location: /login');
            return false;
        }

        return $next($request);
    }
}
