<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

Route::get('/', function() {
    return view('index');
})->middleware('auth');

Route::get('/login', function() {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/customers/create', function() {
    return view('create_customer');
})->middleware('auth');
Route::post('customers/store', [CustomerController::class, 'store'])->name('customer.store')->middleware('auth');