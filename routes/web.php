<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Models\Schedule;

Route::get('/', function () {
    return view('welcome');
});

// Schedule
    Route::resource('schedule', ScheduleController::class);

