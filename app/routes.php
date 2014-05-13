<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
    'as' => 'core.home',
    'uses' => 'HomeController@index',
    'before' => 'core.auth'
));

Route::get('login', array(
    'as' => 'core.login',
    'uses' => 'HomeController@showLogin'
));

Route::get('import', array(
    'as' => 'core.import',
    'uses' => 'HomeController@import',
    'before' => 'core.auth'
));


Route::get('logout', array(
    'as' => 'core.logout',
    'uses' => 'HomeController@doLogout'
));


Route::get('invite', array(
    'as' => 'core.invite.index',
    'uses' => 'HomeController@showInvite'
));

Route::post('invite', array(
    'as' => 'core.invite.create',
    'uses' => 'HomeController@storeInvite'
));


Route::get('attend/{type}', array(
    'as' => 'core.user.attend',
    'uses' => 'HomeController@doAttend',
    'before' => 'core.auth'
));


Route::put('/', array(
    'as' => 'core.user.update',
    'uses' => 'HomeController@update',
    'before' => 'core.auth'
));



Route::get('admin', array(
    'as' => 'core.admin',
    'uses' => 'HomeController@admin',
    'before' => 'core.auth'
));


Route::post('login','HomeController@doLogin');



Route::filter('core.auth', function($route, $request, $userRule = null)
{

    if(!Auth::check()) {
        Session::put('url.intended', URL::full());
        return Redirect::route('core.login');
    }


});
