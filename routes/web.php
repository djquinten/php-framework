<?php

declare(strict_types=1);

//use App\Http\Classes\Router;
//use App\Http\Controllers\HomeController;
//
//Router::get('/', [HomeController::class, 'show']);
//
//Router::group(['middleware' => 'auth'], function () {
//    Router::get('/home', [HomeController::class, 'show']);
//});

use App\Http\Controllers\HomeController;
use Src\Foundation\Routing\Route;

Route::get('/', 'App\\Http\\Controllers\\HomeController@show');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth');

Route::get('/about', function() {
    echo 'about';
});

Route::get('/login', function() {
    echo 'login';
});