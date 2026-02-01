<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;

Route::get('/', [ShopController::class, 'index']);
Route::post('/checkout', [ShopController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/edit/{id}', [AdminController::class, 'edit']);
Route::post('/admin/update/{id}', [AdminController::class, 'update']);
Route::post('/admin/delete/{id}', [AdminController::class, 'delete']);
Route::post('/admin/done/{id}', [AdminController::class, 'done']);

