<?php

namespace Src\Foundation\Routing;

use Src\Http\Request;

class Kernel
{
    public static array $routes = [];

    public static array $middleware = [];

    public static function addRoute(
        string $method,
        string $uri,
        string|array|callable $action,
        array $parameters,
        // ?string $name,
        string|array|null $middleware = null
    ): void
    {
        self::$routes[$method][$uri] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
            'parameters'=> $parameters,
            'middleware' => $middleware,
        ];
    }

    public static function handleRoute(): void
    {
        $routes = Route::$routes[Request::method()] ?? [];

        if (array_key_exists(Request::uri(), $routes)) {
            $route = $routes[Request::uri()];

            var_dump($route['middleware']);

            self::callMethod($route);
        }
    }

    protected static function callMethod(array $route)
    {
        switch (gettype($route["action"])) {
            case "string":
                $action = explode('@', $route['action']);
                (new $action[0])->{$action[1]}(
                    new Request,
                    $route['parameters']
                );
                break;
            case 'array':
                $action = $route['action'];
                (new $action[0])->{$action[1]}(
                    new Request,
                    $route['parameters']
                );
                break;
            case 'object':
                $route['action'](
                    new Request,
                    $route['parameters']
                );
                break;
            default:
                echo "Invalid route action type.";
                break;
        }
    }

    protected static function handleMiddleware()
    {
        $pipe = array_reduce(
            array_reverse(self::$middleware),
            function ($stack, $middleware) {
                return function (Request $request) use ($stack, $middleware) {
                    return (new $middleware)->handle($request, $stack);
                };
            },
            function () {}
        );

        $pipe(new Request());
    }
}