<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StandingController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\LiveScoreController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\OddsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('v1.')->group(function () {

    Route::middleware(['whitelist'])->group(function () {
        Route::prefix('standings')->as('standings.')->group(function () {
            Route::get('/', [StandingController::class, 'index']);
            Route::get('league/{league}', [StandingController::class, 'getByLeague']);
            Route::get('league/{league}/season/{season}', [StandingController::class, 'getByLeagueAndSeason']);
        });

        Route::prefix('schedules')->as('schedules.')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('getAll');
            Route::get('date/{date}', [ScheduleController::class, 'getByDate'])->name('getByDate');
            Route::get('league/{league}', [ScheduleController::class, 'getByLeague'])->name('getByLeague');
            // Route::get('league/{league}/date/{date}', [ScheduleController::class, 'getByLeagueAndDate']);
            Route::get('league/{league}/round/{roundId}', [ScheduleController::class, 'getByLeagueAndRound'])->name('getByLeagueAndRound');
        });

        Route::prefix('results')->as('results.')->group(function () {
            Route::get('/', [ResultController::class, 'index']);
            Route::get('league/{league}', [ResultController::class, 'getByLeague']);
            Route::get('date/{date}', [ResultController::class, 'getByDate']);
            Route::get('league/{league}/season/{season}', [ResultController::class, 'getByLeagueAndSeason']);
            Route::get('league/{league}/round/{roundId}', [ResultController::class, 'getByLeagueAndRound']);
        });

        Route::prefix('livescores')->as('livescores.')->group(function () {
            Route::get('/', [LiveScoreController::class, 'index']);
            Route::get('date/{date}', [LiveScoreController::class, 'getByDate']);
            Route::get('league/{league}', [LiveScoreController::class, 'getByLeague']);
            Route::get('league/{league}/date/{date}', [LiveScoreController::class, 'getByLeagueAndDate']);
        });

        Route::prefix('odds')->as('odds.')->group(function () {
            Route::get('/', [OddsController::class, 'index']);
            Route::get('date/{date}', [OddsController::class, 'getByDate']);
        });

        Route::get('/leagues', [CommonController::class, 'leagues']);
        Route::get('/matches/{fixtureId}/{teamSlug1}/{teamSlug2}', [CommonController::class, 'getMatchDetail']);
    });
});
