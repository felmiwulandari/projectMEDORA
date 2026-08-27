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
],  function () {
      
    // Route for Dashboard page
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Route for Specialist page
    Route::resource('/specialist', App\Http\Controllers\SpecialistController::class);
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

     // Route for Doctor page
    Route::resource('/doctor', App\Http\Controllers\DoctorsController::class);
});


;

// ROUTE UNTUK SCHEDULE
Route::prefix('pages')->group(function () {
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('pages.Schedule.index');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('pages.Schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('pages.Schedule.store');
    Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('pages.Schedule.show');
    Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('pages.Schedule.edit');
    Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('pages.Schedule.update');
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('pages.Schedule.destroy');
});