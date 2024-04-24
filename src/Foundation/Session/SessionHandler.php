<?php

declare(strict_types=1);

namespace Src\Foundation\Session;

class SessionHandler
{
    public function get(string $key): mixed
    {
        return $_SESSION[$key];
    }
}
