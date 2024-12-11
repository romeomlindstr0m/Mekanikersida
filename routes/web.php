<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;

Route::get('/', function() {
    return redirect()->route('project.index');
});

Route::get('/login', function() {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/customers/create', function() {
    return view('create_customer');
})->middleware('auth')->name('customer.create');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customer.store')->middleware('auth');
Route::get('/customers/search', [CustomerController::class, 'index'])->name('customer.index')->middleware('auth');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit')->middleware('auth');
Route::post('/customers/{id}/update', [CustomerController::class, 'update'])->name('customer.update')->middleware('auth');
Route::post('/customers/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy')->middleware('auth');

Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create')->middleware('auth');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('project.store')->middleware('auth');
Route::get('/projects/search', [ProjectController::class, 'index'])->name('project.index')->middleware('auth');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit')->middleware('auth');
Route::post('/projects/{id}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy')->middleware('auth');
Route::get('/projects/{id}/show', [ProjectController::class, 'show'])->name('project.show')->middleware('auth');
Route::post('/projects/{id}/update', [ProjectController::class, 'update'])->name('project.update')->middleware('auth');