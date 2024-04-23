<?php

namespace Src\Console\Maker;

use Src\Console\Maker;
use Src\Console\MakerInterface;

final class MakeMiddleware extends Maker implements MakerInterface
{
    public static function getCommandName(): string
    {
        return 'make:middleware';
    }

    public function generate(array $args): void
    {
        $location = array_map('ucfirst', explode('/', $args[2]));
        $className = ucfirst(array_pop($location));
        $namespace = rtrim('App\\Http\\Middleware\\' . implode('\\', $location), '\\');

        if (! is_dir($dir = 'App/Http/Middleware/' . implode('/', $location))) {
            mkdir($dir);
        }

        $this->createFile(
            "$dir/$className.php",
            $this->generateFileContent('middleware', compact('namespace', 'className'))
        );
    }
}