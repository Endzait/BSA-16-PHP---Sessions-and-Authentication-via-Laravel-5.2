<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('book','BookController');
    Route::resource('user','UserController');
    Route::get('/book/{id}/get','BookController@selectUser');



    Route::get('/book/{id}/get/user/{uid}','BookController@getBook');

    Route::get('/book/{id}/pass/user/{uid}', 'BookController@passBook');
    Route::get('/user/{id}/books','UserController@showBooks');
    Route::get('/user/{id}/edit','UserController@edit');
    Route::get('/new',function (){
        if (\Illuminate\Support\Facades\Auth::check())
        {
            $id = \Illuminate\Support\Facades\Auth::id();
            return redirect('/user/'.$id);
        }
    });




});




Route::get('/auth/github', 'SocialAuthController@redirectToProvider');
Route::get('/auth/github/callback', 'SocialAuthController@handleProviderCallback');
