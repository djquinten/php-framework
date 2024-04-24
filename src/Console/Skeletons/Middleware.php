<?= "<?php\n" ?>

declare(strict_types=1);

namespace <?= $namespace; // @phpstan-ignore-line ?>;

use Closure;
use Src\Http\Request;
use Src\Middleware\MiddlewareInterface;

class <?= $className; // @phpstan-ignore-line ?> implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        // Your middleware handle here

        return $next($request);
    }
}