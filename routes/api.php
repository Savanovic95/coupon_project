<?php

use App\Http\Controllers\Version_2\ApiController;
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


Route::group(['prefix' => 'v2', 'namespace' => 'App\Http\Controllers\Version_2'], function () {
    Route::post('use', [ApiController::class, 'use']);
    Route::post('create', [ApiController::class, 'store']);
});
