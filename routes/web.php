<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ScheduleController;
use App\Models\Schedule;

Route::get('/', [PatientController::class, 'create'])->name('home');

// AKSES PASIEN
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
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Dashboard page
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Patient page
    Route::resource('patient', PatientController::class)->only(['index', 'show']);

    // Doctor page
    Route::resource('doctor', DoctorController::class);

    // Spesialist page
    Route::resource('specialist', SpecialistController::class);

    // Schedule page
    Route::resource('schedule', ScheduleController::class);
});
