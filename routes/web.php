<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\SubscriptionPackageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['IsGuest'])->group(function () {
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('login', [UserController::class, 'index'])->name('login');
    Route::post('login', [UserController::class, 'authentication'])->name('login.auth');
});

Route::middleware(['IsLoggedIn'])->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('book-categories', BookCategoryController::class);
    Route::resource('subscription-plans', SubscriptionPackageController::class);
    Route::resource('books', BookController::class);
});
// Untuk route yang hanya ingin menampikan view (tanpa logic)
// Route::get('path', function () { return view('nama_file');})-> name('nama_path');

// Untuk route yang jika ada logic/butuh data dari database :
// Route::get('path',[NamaController::class, 'namaFunc])-> name('nama_path');

// http method : get, post, put, patch, delete
// put : semua data digantikk
// patch : hanya 1 data digantikks

// Method nama() : berfungsi untuk meberikan route nama unik
// Aturan pemberian nama route :
// 1. Tanda (/) diganti menjadi (.) contoh pat =(/school/grades) nama_path=(school.grade)
// 2, Tanda (-) diganti menjadi (_) contoh pat =(/school/subject-teachers) nama_path=(school.subject_teachers)