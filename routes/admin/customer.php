<?php

use App\Http\Controllers\UserController;
use \App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('admin/customer', [CustomerController::class, 'index'])->name('customer');
Route::get('admin/total_customer', [CustomerController::class, 'total'])->name('total_customer');
Route::post('/admin/customer/create', [CustomerController::class, 'store'])->name('create_customer');
Route::post('admin/customer/delete/{id}', [CustomerController::class, 'delete'])->name('delete_customer');
Route::post('admin/customer/update/{id}', [CustomerController::class, 'update'])->name('update_customer');
