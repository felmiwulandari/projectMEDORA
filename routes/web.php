<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController; 

Route::get('/', [PatientController::class, 'create'])->name('home');

Route::post('/patient/store', [PatientController::class, 'store'])->name('patient.store');

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
], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::resource('patient', PatientController::class)->only(['index', 'show']);
});