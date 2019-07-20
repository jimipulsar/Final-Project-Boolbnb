<?php

use Illuminate\Http\Request;

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

Route::middleware('Api.Auth')->namespace('Api')->prefix('v1')->name('api.')->group(function() {
    Route::post('/rooms/{page}', 'RoomController@search')->name('rooms.search');
    Route::get('/room/{id}/visits/{year}', 'RoomController@visits')->name('room.visits');
    Route::get('/room/{id}/messages/{year}', 'RoomController@messages')->name('room.messages');
});
