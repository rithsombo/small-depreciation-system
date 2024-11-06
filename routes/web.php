<?php

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
Route::get('/main', function () {
    return view('layouts.main');
});

Route::get('admin/user', function () {
    $data = [];
    return view('user', ['data'=>$data]);
});
Route::get('admin/customer', function () {
    $data = [];
    return view('customer', ['data'=>$data]);
});
Route::get('admin/depreciation', function () {
    $data = [];
    return view('depreciation', ['data'=>$data]);
});
include 'admin/user.php';
include 'admin/customer.php';
include 'admin/depreciation.php';
