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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* User Routes */

Route::resource('users', 'UserController');


/* Organization Routes */

Route::get('organizations/create', 'OrganizationController@create');

Route::post('organizations', 'OrganizationController@store');

Route::get('organizations/{organization}/edit', 'OrganizationController@edit');

Route::put('organizations/{organization}', 'OrganizationController@update');
