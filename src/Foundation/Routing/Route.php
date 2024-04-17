<?php

namespace Src\Foundation\Routing;

class Route
{
    private static function createRoute(
        string $method,
        string $uri,
        string $action
    ): void
    {
        $route = new RouteRegister($method, $uri, $action);
        $route->register();
    }

    public static function get(
        string $uri,
        string $action
    ): void
    {
        self::createRoute("GET", $uri, $action);
    }

    public static function post(
        string $uri,
        string $action
    ): void
    {
        self::createRoute("POST", $uri, $action);
    }
}