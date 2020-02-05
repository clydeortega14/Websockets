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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('post/{post}/comments', 'CommentsController@index');

Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function(){

	Route::post('post/{post}/comment', 'CommentsController@store');

	Route::get('get-message', 'ChatsController@getMessage');
	
	Route::post('send-message', 'ChatsController@sendMessage');
	
});


Route::get('/users', 'Api\UsersApiController@index');

Route::post('/user', 'Api\UsersApiController@store');

Route::get('/user/{id}', 'Api\UsersApiController@edit');

Route::put('/user/{id}', 'Api\UsersApiController@update');

Route::delete('/user/{id}', 'Api\UsersApiController@destroy');
