<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
});




Route::prefix('category')->group(function(){
    Route::get('create-categories-json', [CategoryController::class, 'store']); // запись категорий из json файла
    Route::get('/', [CategoryController::class, 'index'])->name('categories.list');
    Route::get('create',[CategoryController::class, 'create'])->name('create.category');
    Route::post('create',[CategoryController::class, 'storeForm'])->name('store-form.category');
    Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('edit.category');
    Route::put('edit/{id}',[CategoryController::class, 'update'])->name('update.category');
    Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('delete/image-category/{id}',[CategoryController::class, 'removeImage'])->name('remove-image.category');
});


Route::prefix('product')->group(function(){
    Route::get('create-products-json', [ProductController::class, 'store']); // запись в таблицу products из json файла
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::put('edit/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::get('delete/image-product/{id}', [ProductController::class, 'removeImage'])->name('remove-image.product');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');  
    
});

