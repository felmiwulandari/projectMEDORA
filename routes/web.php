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
    'as' => 'admin',
    'middleware' => 'auth',
],  function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
