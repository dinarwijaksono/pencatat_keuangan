<?php

use App\Http\Controllers\Auth_controller;
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
Route::get('/', [Home_controller::class, 'index']);

Route::get('/Home', [Home_controller::class, 'index']);
/* end Home_controller */


/* Auth_controller */
Route::get('/Auth/login', [Auth_controller::class, 'login'])->name('login');

Route::get('/Auth/register', [Auth_controller::class, 'register']);
/* end Auth_controller */


/* Transaction_controller */
Route::get('/Transaction/addItem', [Transaction_controller::class, 'addItem']);

Route::get('/Transaction/transactionDetail', [Transaction_controller::class, 'transactionDetail']);
/* end Transaction_controller */


/* Setting_controller */
Route::get('/Setting', [Setting_controller::class, 'index']);
/* end Setting_controller */