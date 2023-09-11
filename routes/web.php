<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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
Route::get('user/registration', [UserController::class, 'registrationPage'])->name('user.registr');
Route::post('user/registration', [UserController::class, 'store'])->name('user.store');
Route::get('user/login', [UserController::class, 'loginPage'])->name('user.login');
Route::post('user/login', [UserController::class, 'authUser'])->name('user.auth');
Route::post('logout', [UserController::class, 'logout'])->name('user.logout');

Route::middleware('auth')->group(function(){

    Route::prefix('products')->middleware('role:Администратор|Менеджер')->group(function(){
        Route::get('products', [ProductController::class, 'index'])->name('list.products');
    });   
    

    Route::prefix('user')->middleware('role:Администратор')->group(function(){
        
        Route::get('/', [UserController::class, 'listUsers'])->name('list.user');
        Route::get('edit/{id}', [UserController::class, 'editUser'])->name('edit.user');
        Route::put('edit/{id}', [UserController::class, 'updateUser'])->name('update.user');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete.user');
    });
    
    Route::prefix('role')->middleware('role:Администратор')->group(function(){
        Route::get('/', [RoleController::class, 'index'])->name('list.roles');
        Route::get('create', [RoleController::class, 'create'])->name('create.role');
        Route::post('create', [RoleController::class, 'store'])->name('store.role');
        Route::delete('delete/{id}', [RoleController::class, 'delete'])->name('delete.role');
    });
    
    
    
    
    Route::prefix('category')->middleware('role:Администратор')->group(function(){
        Route::get('create-categories-json', [CategoryController::class, 'store']); // запись категорий из json файла
        Route::get('/', [CategoryController::class, 'index'])->name('categories.list');
        Route::get('create',[CategoryController::class, 'create'])->name('create.category');
        Route::post('create',[CategoryController::class, 'storeForm'])->name('store-form.category');
        Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('edit.category');
        Route::put('edit/{id}',[CategoryController::class, 'update'])->name('update.category');
        Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('delete/image-category/{id}',[CategoryController::class, 'removeImage'])->name('remove-image.category');
    });
    
    
    Route::prefix('product')->middleware('role:Администратор')->group(function(){
        Route::get('create-products-json', [ProductController::class, 'store']); // запись в таблицу products из json файла
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit.product');
        Route::put('edit/{id}', [ProductController::class, 'update'])->name('update.product');
        Route::get('delete/image-product/{id}', [ProductController::class, 'removeImage'])->name('remove-image.product');
        Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        
        
    });

});



