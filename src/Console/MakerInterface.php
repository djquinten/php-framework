<?php

namespace src\Console;

interface MakerInterface
{
    public static function getCommandName(): string;

    public function generate(array $args): void;
}