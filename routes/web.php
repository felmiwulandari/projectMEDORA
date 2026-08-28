<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
],  function () {
      
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/admin', App\Http\Controllers\AdminController::class);

    Route::resource('/specialist', App\Http\Controllers\DoctorController::class);

    Route::resource('/doctor', App\Http\Controllers\DoctorController::class);
});
