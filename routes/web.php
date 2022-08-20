<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UrlShortenerController;
use App\Http\Controllers\RedirectorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    HomeController::class,
    'index'
]);

Route::post('/shortener', [
    UrlShortenerController::class,
    'makeShortUrl'
]);

Route::get('/{any}', [
    RedirectorController::class,
    'index']
);


