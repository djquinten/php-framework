<?php

declare(strict_types=1);

namespace Src\Middleware;

use Closure;
use Src\Http\Request;
use Src\Middleware\Foundation\Middleware\MiddlewareInterface;

class Auth implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (! isset($_SESSION['user']) || $_SESSION['user'] == null) {
            header('Location: /login');
            return false;
        }

        return $next($request);
    }
}
