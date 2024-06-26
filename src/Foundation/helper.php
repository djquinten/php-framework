<?php

declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Src\Foundation\Session\SessionHandler;

if (! function_exists('view')) {
    function view(string $view, array $params = []): void
    {
        $view = str_replace('.', '/', $view);

        $loader = new FilesystemLoader("../resources/views");
        $twig   = new Environment($loader);

        try {
            $twig->display($view . '.twig', $params);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('session')) {
    function session(): SessionHandler
    {
        return new SessionHandler();
    }
}
