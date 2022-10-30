<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Category_controller;
use App\Http\Controllers\Home_controller;
use App\Http\Controllers\Setting_controller;
use App\Http\Controllers\Transaction_controller;
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

// Home_controller
Route::get('/', [Home_controller::class, 'index'])->middleware('auth');

Route::get('/Home', [Home_controller::class, 'index'])->middleware('auth');
/* end Home_controller */


/* Auth_controller */
Route::get('/Auth/login', [Auth_controller::class, 'login'])->name('login')->middleware('guest');
Route::post('/Auth/login', [Auth_controller::class, 'doLogin'])->middleware('guest');

Route::get('/Auth/register', [Auth_controller::class, 'register'])->middleware('guest');
Route::post('/Auth/register', [Auth_controller::class, 'doRegister'])->middleware('guest');

Route::post('/Auth/logout', [Auth_controller::class, 'doLogout'])->middleware('auth');
/* end Auth_controller */



/* Category_controller */
Route::get('/Category/index', [Category_controller::class, 'index'])->middleware('auth');
/* end Category_controller */


/* Transaction_controller */
Route::get('/Transaction/addItem', [Transaction_controller::class, 'addItem'])->middleware('auth');

Route::get('/Transaction/transactionDetail', [Transaction_controller::class, 'transactionDetail'])->middleware('auth');
/* end Transaction_controller */


/* Setting_controller */
Route::get('/Setting', [Setting_controller::class, 'index'])->middleware('auth');
/* end Setting_controller */