<?php

use App\Http\Controllers\Api\Category_controllerApi;
use App\Http\Controllers\Api\Report_controllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Category/createCategory', [Category_controllerApi::class, 'createCategory']);

Route::get('/Category/listCategory/{code}', [Category_controllerApi::class, 'getListCategory']);

Route::post('/Category/deleteCategory', [Category_controllerApi::class, 'deleteCategory']);

Route::post('/Report/showListTransaction', [Report_controllerApi::class, 'getByUsernameAndPriod']);
// Route::post('/Report/show', [Report_controllerApi::class, 'show']);
