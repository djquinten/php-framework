<?php

namespace src\Foundation\Routing;

class Kernel
{
    public static array $routes = [];

    public static function addRoute($method, $uri, $action): void
    {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action
        ];
    }

    public static function handleRoute(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $action = explode('@', $route['action']);

                (new $action[0])->{$action[1]}();
                return;
            }
        }

        echo 'Route not found';
    }
}