<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Src\Http\Request;

class HomeController extends Controller
{
    public function show(Request $request): void
    {
        // echo $request->uri();
        view('welcome');
    }

    public function index(Request $request): void
    {
        // echo $request->uri();
        view('dashboard');
    }
}