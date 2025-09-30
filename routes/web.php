<?php

use App\Http\Controllers\ProfilController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', App\Http\Controllers\PostController::class);
Route::get('/ganjil/{number}', function ($number) {
	if($number % 2 != 0){
		return "ya, ini bilangan ganjil";
	} else {
		return "tidak, ini bukan bilangan ganjil";
	}
});

Route::resource('newposts', App\Http\Controllers\NewPostController::class);

Route::resource('users', App\Http\Controllers\UserController::class);

