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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['jwt.auth'])->group(function(){
	
	Route::post('add', 'LocationController@create');

	Route::get('delete/{id}', 'LocationController@destroy');


});

Route::post('login', 'AuthenticateController@authenticate');

Route::get('locations', 'LocationController@index');

Route::get('search/{slug}', 'LocationController@search');

Route::get('childs/{id}', 'LocationController@getChilds');
