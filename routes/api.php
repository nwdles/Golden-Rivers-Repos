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
Route::post('/register', 'UserController@register');
Route::middleware('auth:api')->group(function(){

    Route::group(['prefix' => 'admin'], function () {

        Route::get('getAllUsers', 'AdminController@getAllUsers');
        Route::get('getOneUser/{user_id}', 'AdminController@getOneUser');

        Route::post('updateUser', 'AdminController@updateUser');

        Route::delete('deleteUser/{user_id}', 'AdminController@deleteUser');
    });

    Route::group(['prefix' => 'lk'], function () {

        Route::get('personalData', 'UserController@getPersonalData');
    });

    Route::post('createShow', 'ShowController@createShow');
    Route::get('getAllShows', 'ShowController@getAllShows');
    Route::get('show/{show_id}', 'ShowItemController@getShowItemsById');

    Route::post('createShowItem', 'ShowItemController@createShowItem');

    Route::post('buyTicket', 'TicketController@buyTicket');
});


Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

