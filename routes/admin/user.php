<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('admin/user', [UserController::class, 'index'])->name('user');
Route::post('/admin/user/create', [UserController::class, 'create'])->name('create_user');
Route::post('admin/user/delete/{id}', [UserController::class, 'delete'])->name('delete_user');
Route::post('admin/user/update/{id}', [UserController::class, 'update'])->name('update_user');
