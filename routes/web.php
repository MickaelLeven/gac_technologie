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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tickets', 'TicketController@list')->name('list-tickets');
Route::get('/ticket/{id}', 'TicketController@read')->name('read-ticket')->where('id', '[0-9]*');
Route::get('/ticket/creation','TicketController@createForm')->name('create-ticket');
Route::post('/ticket/creation','TicketController@create')->name('post-create-ticket');
Route::get('/ticket/{id}/edition','TicketController@updateForm')->name('update-ticket');
Route::post('/ticket/{id}/edition','TicketController@update')->name('post-update-ticket');
Route::get('/ticket/{id}/suppression', 'TicketController@delete')->name('delete-ticket');
Route::get('/tickets/import', 'TicketController@importForm')->name('import-tickets');
Route::post('/tickets/import', 'TicketController@import')->name('post-import-tickets');
Route::get('/tickets/statistique', 'TicketController@statistique')->name('stat-tickets');