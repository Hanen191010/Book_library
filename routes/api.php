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

// **مسارات تسجيل الدخول والتسجيل:**
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login'); // مسار تسجيل الدخول
    Route::post('logout', 'logout'); // مسار تسجيل الخروج
});

// **مسارات المسؤول (admin):**
Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')
->group(function() {
    // **مسارات إدارة الكتب:**
    Route::apiResource('books', BookController::class); 
    // **مسارات إدارة المستخدمين:**
    Route::apiResource('users', UserController::class); 
});

// **مسارات المقترض (borrower):**
Route::middleware(['auth', 'role:borrower'])->name('borrower.')->prefix('borrower')
->group(function() {
    // **مسارات سجلات الاستعارة:**
    Route::apiResource('borrow', BorrowRecordsController::class); 
    // **مسارات التقييم:**
    Route::apiResource('rating', RatingController::class); 
    // **مسار قائمة الكتب المتاحة:**
    Route::get('book_list', [BorrowRecordsController::class, 'filter'])->name('book_list');
});





