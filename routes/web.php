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
Route::get('show/create', 'ShowController@pageCreate')->name('create.show.page');
Route::post('show/create', 'ShowController@creating')->name('create.show');
Route::get('show/{id}/items/create', 'ShowItemController@pageCreateItem')->name('show.create.item.page');
Route::post('show/{id}/items/create', 'ShowItemController@creatingItem')->name('show.create.item');
Route::get('show/{id}/edit', 'ShowController@pageEdit')->name('edit.show.page');
Route::post('show/{id}/edit','ShowController@update')->name('edit.show');
Route::post('show/{id}/delete', 'ShowController@delete')->name('delete.show');
Route::post('show/{show_id}/item/{itdem_id}/delete', 'ShowItemController@delete')->name('delete.show.item');



Route::get('auctions', 'AuctionController@index')->name('auctions');
Route::get('auction/{id}/items', 'AuctionItemController@index')->name('auction.items');
Route::get('auction/create', 'AuctionController@pageCreate')->name('create.auction.page');
Route::post('auction/create', 'AuctionController@creating')->name('create.auction');
Route::get('auction/{id}/items/create', 'AuctionItemController@pageCreateItem')->name('auction.create.item.page');
Route::post('auction/{id}/items/create', 'AuctionItemController@creatingItem')->name('auction.create.item');
Route::get('auction/{id}/edit', 'AuctionController@pageEdit')->name('edit.auction.page');
Route::post('auction/{id}/edit','AuctionController@update')->name('edit.auction');
Route::post('auction/{id}/delete', 'AuctionController@delete')->name('delete.auction');
Route::post('auction/{auction_id}/item/{itdem_id}/delete', 'AuctionItemController@delete')->name('delete.auction.item');


Route::get('admin', 'AdminController@index')->name('admin.panel');
Route::post('admin/user/{id}/activate', 'AdminController@activate')->name('user.activate');
Route::get('admin/shows', 'AdminController@showAll')->name('admin.panel.shows');
Route::post('admin/show/{id}/activate', 'AdminController@activateShowByID')->name('show.activate');
Route::get('admin/auctions', 'AdminController@auctionAll')->name('admin.panel.auctions');
Route::post('admin/auctions/{id}/activate', 'AdminController@activateAuctionByID')->name('auction.activate');
Route::get('admin/tickets', 'AdminController@ticketAll')->name('admin.panel.tickets');
Route::post('admin/tickets/{id}/activate', 'AdminController@activateTicketByID')->name('ticket.activate');



Route::get('buyticket/{name_event}/{id_event}', 'TicketController@index')->name('ticket.page');
Route::post('buyticket/{name_event}/{id_event}', 'TicketController@buying')->name('buy.ticket');

