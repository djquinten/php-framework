<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function show(): void
    {
        view('welcome');
    }
}