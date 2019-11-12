<?php

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


Route::get('/', 'HomeController@index')->name('index');

Route::get('shows', 'ShowController@index')->name('shows');
Route::get('show/{id}/items', 'ShowItemController@index')->name('show.items');
Route::get('show/create', 'ShowController@pageCreate')->name('create.show.page')->middleware('auth');
Route::post('show/create', 'ShowController@creating')->name('create.show')->middleware('auth');
Route::get('show/{id}/items/create', 'ShowItemController@pageCreateItem')->name('show.create.item.page')->middleware('auth');
Route::post('show/{id}/items/create', 'ShowItemController@creatingItem')->name('show.create.item')->middleware('auth');
Route::get('show/{id}/edit', 'ShowController@pageEdit')->name('edit.show.page')->middleware('auth');
Route::post('show/{id}/edit','ShowController@update')->name('edit.show')->middleware('auth');
Route::post('show/{id}/delete', 'ShowController@delete')->name('delete.show')->middleware('auth');
Route::post('show/{show_id}/item/{itdem_id}/delete', 'ShowItemController@delete')->name('delete.show.item')->middleware('auth');



Route::get('auctions', 'AuctionController@index')->name('auctions');
Route::get('auction/{id}/items', 'AuctionItemController@index')->name('auction.items');
Route::get('auction/create', 'AuctionController@pageCreate')->name('create.auction.page')->middleware('auth');
Route::post('auction/create', 'AuctionController@creating')->name('create.auction')->middleware('auth');
Route::get('auction/{id}/items/create', 'AuctionItemController@pageCreateItem')->name('auction.create.item.page')->middleware('auth');
Route::post('auction/{id}/items/create', 'AuctionItemController@creatingItem')->name('auction.create.item')->middleware('auth');
Route::get('auction/{id}/edit', 'AuctionController@pageEdit')->name('edit.auction.page')->middleware('auth');
Route::post('auction/{id}/edit','AuctionController@update')->name('edit.auction')->middleware('auth');
Route::post('auction/{id}/delete', 'AuctionController@delete')->name('delete.auction')->middleware('auth');
Route::post('auction/{auction_id}/item/{itdem_id}/delete', 'AuctionItemController@delete')->name('delete.auction.item')->middleware('auth');


Route::get('admin', 'AdminController@index')->name('admin.panel');
Route::post('admin/user/{id}/activate', 'AdminController@activate')->name('user.activate');
Route::get('admin/shows', 'AdminController@showAll')->name('admin.panel.shows');
Route::post('admin/show/{id}/activate', 'AdminController@activateShowByID')->name('show.activate');
Route::get('admin/auctions', 'AdminController@auctionAll')->name('admin.panel.auctions');
Route::post('admin/auctions/{id}/activate', 'AdminController@activateAuctionByID')->name('auction.activate');
Route::get('admin/tickets', 'AdminController@ticketAll')->name('admin.panel.tickets');
Route::post('admin/tickets/{id}/activate', 'AdminController@activateTicketByID')->name('ticket.activate');

Route::get('lk', 'UserController@index')->name('lk')->middleware('auth');



Route::get('buyticket/{name_event}/{id_event}', 'TicketController@index')->name('ticket.page')->middleware('auth');
Route::post('buyticket/{name_event}/{id_event}', 'TicketController@buying')->name('buy.ticket')->middleware('auth');


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'UserController@createUser');

Route::get('/home', 'HomeController@index')->name('home');
