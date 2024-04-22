<?php

namespace Src\Foundation\Routing;

use Src\Http\Request;

class Route
{
    public static array $routes;

    private static function createRoute(string $method, string $uri, string | array | callable $action, array $params): RouteRegister
    {
        return self::$routes[Request::method()][$uri] = new RouteRegister($method, $uri, $action, $params);
    }

    public static function get(string $uri, string | array | callable $action, array $params = []): RouteRegister
    {
        return self::createRoute("GET", $uri, $action, $params);
    }

    public static function post(string $uri, string | array | callable $action, array $params = []): RouteRegister
    {
        return self::createRoute("POST", $uri, $action, $params);
    }
}