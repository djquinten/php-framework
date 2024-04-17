<?php

declare(strict_types=1);

namespace App\Http\Classes;

class Error
{
    public function notFound(): void
    {
        echo '404';
    }
}