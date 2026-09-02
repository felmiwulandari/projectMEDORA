<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $specialists = \App\Models\Specialist::where('status', 'aktif')->get();

    return view('welcome', compact('specialists'));
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

     // Route for Dashboard page
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //  // Route for Doctor page
    // Route::resource('/doctor', App\Http\Controllers\DoctorsController::class);

    // Route for Patient page
    Route::resource('patient', PatientController::class)->only(['index', 'show']);

    // // Route for Spesialist page
    // Route::resource('/spesialist', App\Http\Controllers\SpesialistController::class);
});
