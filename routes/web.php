<?php
use App\Room;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','SearchController@index')->name('search.index');
Route::get('/search','SearchController@search')->name('search.search');

Route::get('/rooms/{$id}', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');

Route::auth();
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('profile');
    Route::any('/allrooms', 'HomeController@stanze')->name('rooms.stanze');
    Route::get('/message', 'MessageController@create')->name('message.create');
    Route::post('/message', 'MessageController@store')->name('message.store');
    Route::get('{user}/messages', 'MessageController@index')->name('messages.index');
    Route::get('/message/{id}', 'MessageController@show')->name('message.show');
    Route::delete('/message/{id}/delete', 'MessageController@destroy')->name('message.destroy');
    Route::get('/room/{id}/sponsorship', 'SponsorshipController@index')->name('sponsorships.index');
    Route::get('/room/{id}/sponsorship/{sponsorship_type_id}/pay', 'SponsorshipController@payment')->name('sponsorships.payment');
    Route::get('/room/{id}/statistics', 'RoomController@statistics')->name('rooms.statistics');
    Route::post('/room/{id}/sponsorship/process', 'SponsorshipController@process')->name('sponsorships.process');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('rooms','RoomController');
});

Route::middleware('auth:api')->group( function () {
	Route::resource('room', 'Api\RoomController');
});

Route::any('/search','SearchController@search');
Route::any('/rooms/search','RoomController@search');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');



