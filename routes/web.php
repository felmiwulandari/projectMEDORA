<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PatientController;
use App\Models\Schedule;

// AKSES PASIEN
Route::get('/', function () {
    $specialists = \App\Models\Specialist::where('status', 'aktif')->get();

    return view('welcome', compact('specialists'));
});

//Route for Registration page
    Route::post('/registration', [RegistrationController::class, 'store'])
    ->name('registration.store');

//Route for Doctor page
    Route::get('/get-doctors/{specialist_id}', [ScheduleController::class, 'getDoctorsBySpecialist'])
    ->name('get.doctors');

//Route for Schedule page
    Route::get('/get-schedules/{doctor_id}', [ScheduleController::class, 'getSchedulesByDoctor'])
    ->name('get.schedules');

// Route untuk Status Pendaftaran
    Route::get('/registration/status/{id}', [RegistrationController::class, 'status'])
    ->name('registration.status');

// Route untuk Status Pendaftaran
    Route::get('/registration/status/{id}/check', [RegistrationController::class, 'checkStatus'])
    ->name('registration.status.check');


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

    // Route for Specialist page
    Route::resource('/specialist', App\Http\Controllers\SpecialistController::class);

    // Route for Profile page
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'save'])->name('profile.save');

    // Route for Doctor page
    Route::resource('/doctor', App\Http\Controllers\DoctorController::class);

    // Route for Patient page
    Route::resource('/patient', PatientController::class)->only([
        'index',
        'show'
    ]);

    // Route for schedule page
    Route::resource('/schedule', App\Http\Controllers\ScheduleController::class);

    // Route for registration page
    Route::resource('/registration', App\Http\Controllers\RegistrationController::class);

    // Route untuk konfirmasi dan penolakan pendaftaran
    Route::post('/registration/{id}/approve', [App\Http\Controllers\RegistrationController::class, 'approve'])
        ->name('registration.approve');

    Route::post('/registration/{id}/reject', [App\Http\Controllers\RegistrationController::class, 'reject'])
        ->name('registration.reject');
});
