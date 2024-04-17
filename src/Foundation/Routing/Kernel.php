<?php

namespace Src\Foundation\Routing;

use Src\Http\Request;

class Kernel
{
    public static array $routes = [];

    public static function addRoute(
        string $method,
        string $uri,
        string|array|callable $action,
        array $parameters,
        ?string $name,
    ): void
    {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
            'parameters'=> $parameters
        ];
    }

    // public static function handleRoute(): void
    // {
    //     echo Request::uri();
    //     $uri = $_SERVER['REQUEST_URI'];
    //     $method = $_SERVER['REQUEST_METHOD'];

    //     foreach (self::$routes as $route) {
    //         if ($route['uri'] === $uri && $route['method'] === $method) {
    //             $action = explode('@', $route['action']);

    //             (new $action[0])->{$action[1]}();
    //             return;
    //         }
    //     }
    // }

    public static function handleRoute(): void
    {
        echo "<pre>";
        var_dump(self::$routes);
        echo "</pre>";

        foreach (self::$routes as $route) {
            self::callMethod($route);
        }
    }

    public static function callMethod(array $route)
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
                // trigger route with parameters
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
}