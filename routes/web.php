<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('users', App\Http\Controllers\UserController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::group([
	'middleware' => ['auth'],
], function () {
	Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::group([
		'middleware' => ['admin'],
	], function () {
		Route::resource('users', App\Http\Controllers\UserController::class);
	});
	Route::resource('/posts', App\Http\Controllers\PostController::class);
});

// Halaman Post yang dapat diakses di Publik
Route::get('/', [PostController::class, 'publicPosts'])->name('posts.public');

// Halaman Detail tiap post
Route::get('/blog/{id}', [PostController::class, 'publicShow'])->name('posts.public.show');
