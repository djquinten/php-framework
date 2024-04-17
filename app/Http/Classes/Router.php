<?php

declare(strict_types=1);

namespace App\Http\Classes;

class Router
{
    private static array $routes;

    public static function get(string $path, array $pointingController, array $params = []): array
    {
        self::$routes['GET'][$path] = [
            'method'             => 'GET',
            'pointingController' => $pointingController,
            'params'             => $params,
        ];
        return self::$routes['GET'][$path];
    }

    public static function post(string $path, array $pointingController, array $params = []): array
    {
        self::$routes['POST'][$path] = [
            'method'             => 'POST',
            'pointingController' => $pointingController,
            'params'             => $params,
        ];
        return self::$routes['POST'][$path];
    }

    public static function run(): void
    {
        self::$routes = self::$routes[$_SERVER['REQUEST_METHOD']] ?? [];

        if (array_key_exists($_SERVER['REQUEST_URI'], self::$routes) && self::$routes[$_SERVER['REQUEST_URI']]['method'] === $_SERVER['REQUEST_METHOD']) {
            $route = self::$routes[$_SERVER['REQUEST_URI']];
            [$controller, $method] = $route['pointingController'];
            (new $controller())->{$method}(...array_values($route['params']));
            return;
        }

        foreach (self::$routes as $path => $route) {
            $pattern = '/^' . preg_replace(['~/\{(\w+)}~', '~/~'], ['/(?P<$1>[^/]+)', '\/'], $path) . '$/';
            $matches = [];
            if (preg_match($pattern, $_SERVER['REQUEST_URI'], $matches) && $route['method'] === $_SERVER['REQUEST_METHOD']) {
                $controller = new $route['pointingController'][0]();
                $params     = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $controller->{$route['pointingController'][1]}(...array_values($params) + array_values($route['params']));
                return;
            }
        }

        (new Error)->notFound();
    }

    public static function group(array $params, callable $callback): void
    {
        if ($params['middleware'] == 'auth' && isset($_SESSION['auth']) && $_SESSION['auth']) {
            $callback();
        }
    }
}