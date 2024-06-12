<?php

declare(strict_types=1);

namespace Src\Foundation\Routing;

use Src\Container\ServiceContainer;
use Src\Http\Request;

class Kernel
{
    public static array $middleware = [];

    public static function handleRoute(Request $request): void
    {
        $routes = Route::$routes[$request::method()] ?? [];

        if (array_key_exists($request::uri(), $routes)) {
            $route = $routes[$request::uri()];
            self::handleMiddleware($route->getMiddleware());
            self::callMethod($route, $request);
            return;
        }

        echo "404";
    }

    protected static function callMethod(RouteRegister $route, Request $request): void
    {
        switch (gettype($route->action)) {
            case "string":
                $action = explode('@', $route->action);
                (new $action[0])->{$action[1]}(...(new Kernel)
                    ->validateParameters($action, $route->parameters));
                break;
            case 'array':
                $action = $route->action;
                (new $action[0])->{$action[1]}(...(new Kernel)
                    ->validateParameters($action, $route->parameters));
                break;
            case 'object':
                $action = $route->action;
                $route->action((new Kernel)
                    ->validateParameters($action, $route->parameters));
                break;
            default:
                echo "Invalid route action type.";
                break;
        }
    }

    protected static function handleMiddleware(string | array $middleware): void
    {
        $middlewares = is_array($middleware) ? $middleware : [$middleware];

        $pipe = array_reduce(
            array_reverse($middlewares),
            function ($stack, $middleware) {
                return function (Request $request) use ($stack, $middleware) {
                    return (new Kernel::$middleware[$middleware])->handle($request, $stack);
                };
            },
            (fn ($request) => $request)
        );

        $pipe(new Request());
    }

    protected function validateParameters(array $action, array $methodParameters): array
    {
        return array_merge(
            ServiceContainer::resolve($action[0], $action[1]),
            $methodParameters
        );
    }
}
