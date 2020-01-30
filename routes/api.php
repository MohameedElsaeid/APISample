<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function () {
    Route::resource('clubs', 'ClubController');
    Route::get('sports/{club_id}', 'SportController@index');
    Route::get('sessions/{sport_id}', 'SessionController@getSessionBySportId');
    Route::get('sessions', 'SessionController@getAllSession');
    Route::get('available-sessions', 'SessionController@getAvailableSession');
    Route::get('max-sport-attendee', 'SportController@getMaxSportAttendees');

    Route::post('new-user', 'UserController@createUser');
    Route::middleware(['auth:api'])->group(function () {
        Route::post('book-session', 'SessionController@bookSession');
        Route::get('user-sessions', 'SessionController@getUserSessions');
    });
});
