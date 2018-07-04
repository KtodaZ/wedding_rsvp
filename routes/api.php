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

\Illuminate\Support\Facades\Route::prefix('rsvp')->group(function () {
    // Everything for the RSVP form
    Route::get('code/{code}', '\App\Http\Controllers\Api\AttendeeController@code');
    Route::put('code/{code}', '\App\Http\Controllers\Api\AttendeeController@edit');
});


Route::resource('attendee', '\App\Http\Controllers\Api\AttendeeController', ['only' => ['show', 'store']])
    ->middleware('auth');
