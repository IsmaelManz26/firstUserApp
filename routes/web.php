<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

// Ruta para la landing page
Route::get('/', [HomeController::class, 'index'])->name('index');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('admin', [App\Http\Controllers\AdministratorsController::class, 'index'])->name('admin.index');

Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');
Route::get('super', [App\Http\Controllers\AdministratorsController::class, 'indexSuper'])->name('super.index');

Route::get('guest', [App\Http\Controllers\HomeController::class, 'guest'])->name('guest');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/verificado', [App\Http\Controllers\HomeController::class, 'verificado'])->name('verificado');
Route::put('home/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('home.password');
Route::get('home/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('home.profile');
Route::put('home/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('home.update');
Route::get('home/verified', [App\Http\Controllers\ProfileController::class, 'verified'])->name('verified');

