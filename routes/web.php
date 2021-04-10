<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Public\SignInController;

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
Route::prefix('signin')->group(function() {
    Route::get('/', [SignInController::class, 'index']);
    Route::post('/', [SignInController::class, 'authProcess']);
});