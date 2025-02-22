<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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

Route::post('/login', [AuthController::class, 'login'])->name('loginSubmit');

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'adminLogin'])->name('login');
    
    Route::post('/login', [AuthController::class, 'login'])->name('loginSubmit');
});

Route::middleware(['auth'])->prefix('app')->group(function () 
{
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

    Route::resource('users', UsersController::class);
    Route::resource('posts', PostController::class)->middleware('permission:view post|create post|edit post|delete post');
    Route::resource('category', CategoryController::class);
});

