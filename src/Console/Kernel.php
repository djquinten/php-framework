<?php

namespace Src\Console;

class Kernel
{
    public function handleCommand(): void
    {
        $args = (new InputValidator())
            ->validate()
            ->parse()
            ->getArgs();

        $this->call($args);
    }

    private function call(array $args): void
    {
        switch ($args[0]) {
            case 'make':
                (new Maker)->handleCommand($args);
                break;
            default:
                echo 'Command not found';
        }
    }
}