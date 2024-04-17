<?php

namespace Src\Foundation\Routing;

class Route
{
    private static function createRoute(string $method, string $uri, string|array|callable $action, array $params): RouteRegister
    {
        // $route = new RouteRegister($method, $uri, $action, $params);
        // $route->register();
        return new RouteRegister($method, $uri, $action, $params);
    }

    public static function get(string $uri, string|array|callable $action, array $params = []): RouteRegister
    {
        return self::createRoute("GET", $uri, $action, $params);
    }

    public static function post(
        string $uri,
        string $action,
        array $params = [],
    ): RouteRegister
    {
        return self::createRoute("POST", $uri, $action, $params);
    }
}