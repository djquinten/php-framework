<?php

namespace Src\Console;

interface MakerInterface
{
    public static function getCommandName(): string;

    public function generate(array $args): void;
}