<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('rsvp')->group(function () {
    // Everything for the RSVP form
    Route::resource('attendee', '\AppApp\Http\Controllers\Api\AttendeeController');
});