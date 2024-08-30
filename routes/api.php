<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowRecordsController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});
Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')
->group(function(){

    Route::apiResource('books', BookController::class);
    Route::apiResource('users', UserController::class);


});
Route::middleware(['auth','role:borrower'])->name('borrower.')->prefix('borrower')
->group(function(){

    Route::apiResource('borrow', BorrowRecordsController::class);
    Route::apiResource('rating', RatingController::class);


});

