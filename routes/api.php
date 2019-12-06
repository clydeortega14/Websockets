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

Route::group(['middleware' => 'auth:api'], function(){
	
	Route::post('post/{post}/comment', 'CommentsController@store');

	Route::get('get-message', 'ChatsController@getMessage');
	
	Route::post('send-message', 'ChatsController@sendMessage');
	
});
