<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Category_controller;
use App\Http\Controllers\Home_controller;
use App\Http\Controllers\Setting_controller;
use App\Http\Controllers\Transaction_controller;
use App\Http\Middleware\OnlyGuest_middleware;
use App\Http\Middleware\OnlyMember_middleware;
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
Route::get('/', [Home_controller::class, 'index'])->middleware(OnlyMember_middleware::class);

Route::get('/Home', [Home_controller::class, 'index'])->middleware(OnlyMember_middleware::class);

Route::get('/Home/index', [Home_controller::class, 'index'])->middleware(OnlyMember_middleware::class);
/* end Home_controller */


/* Auth_controller */
Route::get('/Auth/login', [Auth_controller::class, 'login'])->middleware(OnlyGuest_middleware::class);

Route::get('/Auth/register', [Auth_controller::class, 'register'])->middleware(OnlyGuest_middleware::class);

Route::get('/Auth/logout', [Auth_controller::class, 'doLogout']);
/* end Auth_controller */



/* Category_controller */
Route::get('/Category', [Category_controller::class, 'index'])->middleware(OnlyMember_middleware::class);

Route::post('/Category/create', [Category_controller::class, 'create'])->middleware('auth');

Route::get('/Category/edit/{categoryId}', [Category_controller::class, 'edit'])->middleware('auth');
Route::delete('/Category/delete', [Category_controller::class, 'delete'])->middleware('auth');
/* end Category_controller */


/* Transaction_controller */
Route::get('/Transaction/addItem', [Transaction_controller::class, 'addTransaction'])->middleware('auth');
Route::get('/Transaction/transactionDetail/{date}', [Transaction_controller::class, 'transactionDetail'])->middleware('auth');
Route::get('/Transaction/edit/{id}', [Transaction_controller::class, 'editTransaction'])->middleware('auth');
/* end Transaction_controller */


/* Setting_controller */
Route::get('/Setting', [Setting_controller::class, 'index'])->middleware('auth');
/* end Setting_controller */