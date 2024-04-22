<?php

namespace Src\Http;

class Request
{
    public static function uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}