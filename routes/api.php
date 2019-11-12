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
        Route::post('user/{user_id}/activate', 'AdminController@activateUser');
        Route::post('show/{show_id}/activate', 'AdminController@activateShow');
        Route::post('auction/{auction_id}/activate', 'AdminController@activateAuction');
        Route::post('ticket/{ticket_id}/activate', 'AdminController@activateTicket');
    });

    Route::group(['prefix' => 'lk'], function () {

        Route::get('personalData', 'UserController@getPersonalData');
        Route::get('my_events', 'UserController@getAllEvents');
    });

    Route::group(['prefix' => 'show'], function () {

        Route::post('create', 'ShowController@createShow');
        Route::get('all', 'ShowController@getAllShows');

        Route::get('{show_id}/items', 'ShowItemController@getShowItemsById');
        Route::post('createShowItem', 'ShowItemController@createShowItem');

        Route::post('edit', 'ShowController@editShow');
        Route::delete('{id}/delete', 'ShowController@deleteShow');

        Route::delete('{show_id}/item/{item_id}/delete', 'ShowItemController@deleteShowItem');
    });

    Route::group(['prefix' => 'auction'], function () {

        Route::post('create', 'AuctionController@createAuction');
        Route::get('all', 'AuctionController@getAllAuctions');

        Route::get('{auction_id}/items', 'AuctionItemController@getAuctionItemsById');
        Route::post('createAuctionItem', 'AuctionItemController@createAuctionItem');

        Route::post('edit', 'AuctionController@editAuction');
        Route::delete('{id}/delete', 'AuctionController@deleteAuction');

        Route::delete('{auction_id}/item/{item_id}/delete', 'AuctionItemController@deleteAuctionItem');
    });



    Route::post('buyTicket', 'TicketController@buyTicket');
});


Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

