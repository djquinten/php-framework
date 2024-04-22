<?php
declare(strict_types=1);

namespace Src\Middleware;

use Closure;
use Src\Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, Closure $next);
}