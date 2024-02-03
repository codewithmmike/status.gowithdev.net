<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

Route::prefix('standings')->group(function () {
    Route::get('/', function() {
        return view('standings.index');
    });
});

Route::prefix('schedules')->group(function () {
    Route::get('/', function() {
        return view('schedules.all-leagues');
    });
    Route::get('/single', function() {
        return view('schedules.single-league');
    });
});

Route::prefix('odds')->group(function () {
    Route::get('/', function() {
        return view('odds.index');
    });
});

Route::prefix('truc-tiep')->group(function () {
    Route::get('/', function() {
        return view('truc-tiep.index');
    });
});

Route::get('send-email', [App\Http\Controllers\EmailNotificationController::class, 'sendEmail'])->name('email.send-email');
Route::get('check-status', [App\Http\Controllers\DomainController::class, 'checkStatus'])->name('domain.check-status');
