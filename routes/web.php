<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\AllCouponController;
use App\Http\Controllers\EditDeleteController;
use App\Http\Controllers\CreateCouponController;

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

// Authentication 
Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {

    Route::get('/home', [AuthController::class, 'home'])->name('home');

    Route::get('/emails', [EmailController::class, 'all'])->name('emails');

    Route::get('/create', [CreateCouponController::class, 'create_coupon_index'])->name('create');
    Route::post('/create', [CreateCouponController::class, 'store']);

    Route::get('/all', [AllCouponController::class, 'show_all'])->name('all');
    Route::get('/used', [AllcouponController::class, 'show_used'])->name('used');

    Route::get('/active', [AllCouponController::class, 'show_active'])->name('active');
    Route::get('/non_used', [AllCouponController::class, 'show_non_used'])->name('non_used');


    Route::delete('/active', [EditDeleteController::class, 'destroy'])->name('delete');
    Route::post('/edit', [EditDeleteController::class, 'edit'])->name('edit');
    Route::post('/store', [EditDeleteController::class, 'store'])->name('store');

    Route::post('/filter', [FilterController::class, 'filters'])->name('filters');
});
