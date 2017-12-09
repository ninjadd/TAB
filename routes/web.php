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

/* Organizations Routes */
Route::get('organizations/create', 'OrganizationController@create');

Route::post('organizations', 'OrganizationController@store');

/* OrganizationUsers Routes */
Route::get('organizations/users/create', 'OrganizationUserController@create')->name('organizations.users.create');

Route::post('organizations/users/', 'OrganizationUserController@store');

/* Divisions Routes */
Route::get('divisions/create', 'DivisionController@create');

Route::post('divisions', 'DivisionController@store');

Route::get('divisions/{division}/edit', 'DivisionController@edit');

Route::put('divisions/{division}', 'DivisionController@update');

Route::delete('divisions/{division}', 'DivisionController@destroy');

/* Departments Routes */
Route::get('divisions/{division}/departments/create', 'DepartmentController@create')->name('divisions.departments.create');

Route::post('divisions/{division}/departments', 'DepartmentController@store');

Route::get('departments/{department}/edit', 'DepartmentController@edit');

Route::put('departments/{department}', 'DepartmentController@update');

Route::delete('departments/{department}', 'DepartmentController@destroy');

/* Sections Routes */
Route::get('departments/{department}/sections/create', 'SectionController@create')->name('departments.sections.create');

Route::post('departments/{department}/sections', 'SectionController@store');

Route::get('sections/{section}/edit', 'SectionController@edit');

Route::put('sections/{section}', 'SectionController@update');

Route::delete('sections/{section}', 'SectionController@destroy');