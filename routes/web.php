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
    'as' => 'admin',
    'middleware' => 'auth',
],  function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

     // Route for Doctor page
    Route::resource('/doctor', App\Http\Controllers\DoctorsController::class);
});
