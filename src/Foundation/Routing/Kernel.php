<?php

declare(strict_types=1);

namespace Src\Foundation\Routing;

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
                    ->validateParameters($request, $action, $route->parameters));
                break;
            case 'array':
                $action = $route->action;
                (new $action[0])->{$action[1]}(...(new Kernel)
                    ->validateParameters($request, $action, $route->parameters));
                break;
            case 'object':
                $function = new \ReflectionFunction($route->action);

                if (isset($function->getParameters()[0]) ?? $function->getParameters()[0]->getType()->getName() === 'Src\Http\Request') {
                    ($route->action)($request, ...$route->parameters);
                    break;
                }
                ($route->action)(...$route->parameters);
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

    protected function validateParameters(Request $request, array $action, array $methodParameters): array
    {
        $method = new \ReflectionMethod(new $action[0], $action[1]);

        if ($method->getParameters()[0]->getType()->getName() === 'Src\Http\Request') {
            return array_merge([$request], $methodParameters);
        }
        return $methodParameters;
    }
}
