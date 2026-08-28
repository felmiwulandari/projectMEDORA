<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Models\Schedule;

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
], function () {

    // Route for Admin page
    Route::resource('/admin', App\Http\Controllers\AdminController::class);

    // Route for Dashboard page
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Route for Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route for Specialist page
    Route::resource('/specialist', App\Http\Controllers\SpecialistController::class);

    // Route for Doctor page
    Route::resource('/doctor', App\Http\Controllers\DoctorController::class);

    // Route for Schedule page
    Route::resource('/schedule', App\Http\Controllers\ScheduleController::class);
});