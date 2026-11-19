<?php

use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\SubscriptionPackageController;
use App\Http\Controllers\SubscriptionPackageBookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Models\SubscriptionPackage;
use App\Models\Cart;

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/search', [UserController::class, 'search'])->name('search');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/category/{bookCategory}', [BookCategoryController::class, 'show'])->name('category.books');
Route::get('/subscriptions/{packageId}', [SubscriptionPackageBookController::class, 'show'])->name('subscriptions.show');
Route::get('/subscription/{packageId}', [SubscriptionPackageBookController::class, 'show'])->name('subscription.show');

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
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('profil', [UserController::class, 'profile'])->name('profil');
    Route::get('/subscription-packages/{id}/payment', [SubscriptionPackageController::class, 'payment'])->name('subscription-packages.payment');
    Route::post('/subscription-packages/{id}/payment', [SubscriptionPackageController::class, 'paymentSend'])->name('subscription-packages.payment.send');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/book-categories/export', [BookCategoryController::class, 'export'])->name('book-categories.export');
    Route::get('/books/export', [BookController::class, 'export'])->name('books.export');
    Route::get('/subscription-plans/export', [SubscriptionPackageController::class, 'export'])->name('subscription-plans.export');
    Route::resource('book-categories', BookCategoryController::class);
    Route::get('subscription-package-books/{packageId}', [SubscriptionPackageBookController::class, 'index'])->name('subscription-package-books');
    Route::post('subscription-package-books/{packageId}', [SubscriptionPackageBookController::class, 'store'])->name('subscription-package-books.store');
    Route::resource('subscription-plans', SubscriptionPackageController::class);
    Route::resource('books', BookController::class)->except(['show']);
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