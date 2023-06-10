<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/getNonConnectedUsers', 'App\Http\Controllers\UserController@index');
Route::get('/getConnections', 'App\Http\Controllers\UserController@getConnections');
Route::post('/connectedUser', 'App\Http\Controllers\UserController@create');
Route::get('/getSentRequests', 'App\Http\Controllers\UserController@getSentRequests');
Route::get('/getReceivedRequests', 'App\Http\Controllers\UserController@getReceivedRequests');
Route::post('/deleteRequest', 'App\Http\Controllers\UserController@deleteRequest');
Route::post('/removeConnection', 'App\Http\Controllers\UserController@removeConnection');
Route::post('/acceptRequest', 'App\Http\Controllers\UserController@acceptRequest');

