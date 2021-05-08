<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Public\SignInController;
use App\Http\Controllers\LoginController;

Route::get('roles', [
    RoleController::class, 'index'
]);

/**
 * ================================
 * Categories
 * ================================
 */
Route::resource('categories', CategoryController::class);

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

Route::get('/greeting', function () {
    return 'Hello World';
});

// Route::get('/users/{id}', function ($id) {
//     return 'User : ' . $id;
// });

// Route::get('/users/profile', function () {
//     return 'Banyak User';
// });

Route::prefix('users')->group(function() {
    Route::get('/{id}', function($id) {
        return 'User : ' . $id;
    });

    Route::get('profile', function() {
        return 'Banyak User';
    });
});