<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Public\SignInController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
/**
 * ================================
 * Roles
 * ================================
 */

Route::prefix('roles')->group(function() {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'create']);
    Route::put('/update/{id}', [RoleController::class, 'update']);
    Route::delete('/delete/{id}', [RoleController::class, 'delete']);
});


/**
 * ================================
 * Categories
 * ================================
 */
// Route::resource('categories', CategoryController::class);
Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
});

/**
 * ================================
 * Tags
 * ================================
 */
Route::get('tags', [TagController::class, 'index']);

/**
 * ================================
 * Sign In
 * ================================
 */
Route::middleware(['AuthCheck'])->get('signin', [LoginController::class, 'signIn']);

Route::post('signin/auth/process', [LoginController::class, 'authProcess']);
Route::get('signin/auth/signout', [LoginController::class, 'signout'])->name('signout');

/**
 * ================================
 * Dashboard
 * ================================
 */
Route::group(['middleware'=>'AuthCheck'], function() {
    Route::view('dashboard', 'dashboard.index');
});

/**
 * ================================
 * Dashboard
 * ================================
 */
Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::delete('delete/{id}', [UserController::class, 'delete']);
    Route::put('update/{id}', [UserController::class, 'update']);
});