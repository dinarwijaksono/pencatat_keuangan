<?php

use App\Http\Controllers\Auth_controller;
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

Route::get('/', function () {
    return "Halaman kosong";
});



/* Auth_controller */
Route::get('/Auth/login', [Auth_controller::class, 'login'])->name('login');

Route::get('/Auth/register', [Auth_controller::class, 'register']);
/* end Auth_controller */