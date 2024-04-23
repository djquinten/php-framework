<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Closure;
use Src\Http\Request;
use Src\Middleware\MiddlewareInterface;

class <?= $className; ?> implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        // Your middleware handle here

        return $next($request);
    }
}