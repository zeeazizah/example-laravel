<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route aplikasi didefinisikan di sini.
|
*/

// ==========================================
// Halaman Post Publik (tanpa login)
// ==========================================
Route::get('/', [PostController::class, 'publicPosts'])->name('posts.public');
Route::get('/post/{id}', [PostController::class, 'publicShow'])->name('posts.public.show');


// ==========================================
// Dashboard (setelah login)
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// Manajemen Profil (wajib login)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');

});


// ==========================================
// Admin & User (wajib login)
// ==========================================
Route::middleware('auth')->group(function () {

    // Hanya admin yang bisa kelola user
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Semua user login bisa kelola post
    Route::resource('posts', PostController::class);
});


// ==========================================
// Route Autentikasi (Breeze/Fortify/Jetstream)
// ==========================================
require __DIR__ . '/auth.php';
