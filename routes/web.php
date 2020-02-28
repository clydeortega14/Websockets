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

// Route::get('/', function () {

//     return view('auth/login');
    
// });



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('posts', 'PostsController');

// Route::resource('users', 'UserController');

// Route::get('chats', 'ChatsController@index')->name('chats.index');

// Route::get('read-notifications/{id}', 'NotificationsController@markRead')->name('read.notifications');

// Route::get('post-data', 'PostsController@postData');

// Route::post('send-message', 'ChatsController@sendMessage')->name('send.message');

Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

