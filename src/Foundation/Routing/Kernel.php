<?php

namespace Src\Foundation\Routing;

use Src\Http\Request;

class Kernel
{
    public static array $middleware = [];

    public static function handleRoute(): void
    {
        $routes = Route::$routes[Request::method()] ?? [];

        if (array_key_exists(Request::uri(), $routes)) {
            $route = $routes[Request::uri()];
            self::handleMiddleware($route->getMiddleware());
            self::callMethod($route);
        }
    }

    protected static function callMethod(RouteRegister $route)
    {
        switch (gettype($route->action)) {
            case "string":
                $action = explode('@', $route->action);
                (new $action[0])->{$action[1]}(
                    new Request,
                    $route->parameters,
                );
                break;
            case 'array':
                $action = $route->action;
                (new $action[0])->{$action[1]}(
                    new Request,
                    $route->parameters,
                );
                break;
            case 'object':
                ($route->action)(
                    new Request,
                    $route->parameters,
                );
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
            function () {
            },
        );

        $pipe(new Request());
    }
}