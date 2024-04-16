<?php

namespace src\Console\Maker;

use src\Console\Maker;
use src\Console\MakerInterface;

final class MakeController extends Maker implements MakerInterface
{
    public static function getCommandName(): string
    {
        return 'make:controller';
    }

    public function generate(array $args): void
    {
        $args[2] = array_map('ucfirst', explode('/', $args[2]));
        $className = ucfirst(array_pop($args[2]));
        $namespace = 'app\\Http\\Controllers\\' . implode('\\', $args[2]);
        $namespace = rtrim($namespace, '\\');

        // check if the directory exists and create it if it doesn't
        if (! is_dir($dir = 'app/Http/Controllers/' . implode('/', $args[2]))) {
            mkdir($dir);
        }

        $content = $this->generateFileContent('controller', compact('namespace', 'className'));

        $this->createFile(
            "$dir/$className.php",
            $content
        );
    }
}