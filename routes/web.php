<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category_controller;
use App\Http\Controllers\Home_controller;
use App\Http\Controllers\ImportExport_controller;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Setting_controller;
use App\Http\Controllers\Transaction_controller;
use App\Http\Controllers\TransactionHistory_controller;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
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
Route::get('/', [Home_controller::class, 'index'])->middleware(['auth']);

Route::get('/Home', [Home_controller::class, 'index'])->middleware(OnlyMember_middleware::class);

Route::get('/Home/index', [Home_controller::class, 'index'])->middleware(OnlyMember_middleware::class);
/* end Home_controller */


/* Auth_controller */
Route::get('/Auth/login', [Auth_controller::class, 'login'])->name('login')->middleware('guest');

Route::get('/Auth/register', [Auth_controller::class, 'register'])->middleware('guest');

Route::post('/Auth/logout', [AuthController::class, 'doLogout']);
/* end Auth_controller */

/* UserController */
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');
/* end UserController */

/* Category_controller */
Route::get('/Category', [Category_controller::class, 'index'])->middleware(Authenticate::class);

Route::get('/Category/detail/{code}', [Category_controller::class, 'detail'])->middleware(Authenticate::class);
/* end Category_controller */


/* Transaction_controller */
Route::get(
    "/Transaction/add-item/{time}",
    [Transaction_controller::class, 'addItem']
)->middleware([Authenticate::class]);

Route::get('/Transaction/detail/{time}', [Transaction_controller::class, 'detail'])->middleware(Authenticate::class);

Route::get('/Transaction/edit/{code}', [Transaction_controller::class, 'edit'])->middleware(Authenticate::class);
/* end Transaction_controller */


/* transactionHistory_controller */
Route::get('/Transaction-history/', [TransactionHistory_controller::class, 'index'])->middleware(Authenticate::class);
/* end transactionHistory_controller */


/* Setting_controller */
Route::get('/Setting', [Setting_controller::class, 'index'])->middleware('auth');
/* end Setting_controller */

/* ImportExport_controller */
Route::get('/Import-export-data', [ImportExport_controller::class, 'index'])->middleware(Authenticate::class);

Route::post(
    '/Import-export-data/downloadFormat',
    [ImportExport_controller::class, 'downloadFormat']
)->middleware(Authenticate::class);

Route::post(
    '/Import-export-data/doImport',
    [ImportExport_controller::class, 'doImport']
)->middleware(Authenticate::class);

Route::post(
    'ImportExport/doExport',
    [ImportExport_controller::class, 'doExport']
)->middleware(OnlyMember_middleware::class);
/* end ImportExport_controller */


/* Report_controller */
Route::get('/Report', [ReportController::class, 'index'])->middleware(Authenticate::class);
/* end Report_controller */
