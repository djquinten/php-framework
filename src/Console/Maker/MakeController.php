<?php

declare(strict_types=1);

namespace Src\Console\Maker;

use Src\Console\Maker;
use Src\Console\MakerInterface;

final class MakeController extends Maker implements MakerInterface
{
    public static function getCommandName(): string
    {
        return 'make:controller';
    }

    public function generate(array $args): void
    {
        $location = array_map('ucfirst', explode('/', $args[2]));
        $className = str_replace('controller', '', ucfirst(array_pop($location))) . 'Controller';
        $namespace = rtrim('App\\Http\\Controllers\\' . implode('\\', $location), '\\');

        if (! is_dir($dir = 'App/Http/Controllers/' . implode('/', $location))) {
            mkdir($dir);
        }

        $this->createFile(
            "$dir/$className.php",
            $this->generateFileContent('controller', compact('namespace', 'className'))
        );
    }
}
