<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::middleware(['auth'])->prefix('admin')->group(function () 
{
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
});

