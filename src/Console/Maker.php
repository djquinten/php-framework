<?php

declare(strict_types=1);

namespace Src\Console;

class Maker
{
    public function handleCommand(array $args): void
    {
        $makerFile = (new (__NAMESPACE__ . '\Maker\\Make' . ucfirst($args[1])));
        $makerFile->generate($args);
    }

    public function generateFileContent(string $category, array $parameters = []): string
    {
        ob_start();

        extract($parameters, \EXTR_SKIP);
        include __DIR__ . '/Skeletons/' . $category . '.php';

        return ob_get_clean();
    }

    public function createFile(string $path, string $content): void
    {
        file_put_contents($path, $content);

        echo 'File created successfully';
    }
}
