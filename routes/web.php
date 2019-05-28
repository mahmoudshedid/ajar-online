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


Route::get('/logout', 'Auth\LoginController@logout');


Route::auth();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'Administrator\DashboardController@getDashboard');

    Route::get('/units', 'Administrator\UnitController@getUnits');
    Route::post('/units/json', 'Administrator\UnitController@postUnitsAjax');

    Route::get('/tickets', 'Administrator\TicketController@getTickets');
    Route::post('/tickets/json', 'Administrator\TicketController@postTicketsAjax');
    Route::get('/ticket/create', 'Administrator\TicketController@getCreateTicket');
    Route::post('/ticket/create', 'Administrator\TicketController@postCreateTicket');
    Route::get('/ticket/{id}', 'Administrator\TicketController@getEditTicket');
    Route::get('/ticket/show/{id}', 'Administrator\TicketController@getShowTicket');
    Route::post('/ticket/edit/{id}', 'Administrator\TicketController@postEditTicket');
});
