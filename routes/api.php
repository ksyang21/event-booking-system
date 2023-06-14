<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

// Mark event as completed
Route::put('events/{event}/complete-event', [EventController::class, 'completeEvent']);

// Seed events(for demonstration purpose)
Route::get('seed-events', function() {
    Artisan::call('db:seed --class EventSeeder');
});

// Get all upcoming events
Route::get('get-upcoming-events', [EventController::class, 'getUpcomingEvents']);
