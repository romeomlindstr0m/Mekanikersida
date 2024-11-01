<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function() {
    return view('index');
});

Route::get('/login', function() {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');