<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AppController::class, 'index'])->name('admin.main');

Route::prefix('user')->group(function(){
    Route::get('registration', [UserController::class, 'registrationPage'])->name('user.registr');
    Route::post('registration', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'loginPage'])->name('user.login');
    Route::post('login', [UserController::class, 'authUser'])->name('user.auth');
});

