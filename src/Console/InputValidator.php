<?php

declare(strict_types=1);

namespace Src\Console;

final class InputValidator
{
    public function __construct(
        private array $args = []
    ) {
        global $argv;

        array_shift($argv);

        $this->args = $argv;
    }

    public function validate(): InputValidator
    {
        if (empty($this->args)) {
            echo 'No command provided';
            exit;
        }

        return $this;
    }

    public function parse(): InputValidator
    {
        $command = explode(':', $this->args[0]);

        array_shift($this->args);

        $this->args = array_merge($command, $this->args);

        return $this;
    }

    public function getArgs(): array
    {
        return $this->args;
    }
}
