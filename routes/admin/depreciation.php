<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DepreciationController;
use \App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/depreciation', [DepreciationController::class, 'index'])->name('depreciation');
Route::get('/admin/report', [DepreciationController::class, 'report'])->name('money_report');
Route::get('/admin/customer_havenot_paid', [DepreciationController::class, 'dont'])->name('customer_havenot_paid');
Route::get('/admin/customer_unpaid', [DepreciationController::class, 'un'])->name('customer_unpaid');
Route::get('/admin/customer_paid', [DepreciationController::class, 'paid'])->name('customer_paid');
Route::post('/admin/depreciation/clear/{depreid}/{cusid}', [DepreciationController::class, 'clear'])->name('clear_depre');
