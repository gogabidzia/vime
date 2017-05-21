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

Route::get('/', 'HomeController@index');

Route::get('login', 'AuthController@login')->middleware('guest');
Route::post('login', 'AuthController@postLogin')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('register', 'AuthController@register')->name('register')->middleware('guest');
Route::post('register', 'AuthController@postRegister');

Route::get('subscribe', 'HomeController@subscribe')->middleware('auth');

Route::get('/home', function(){
	return redirect('/');
});

Route::get('/profile', 'ProfileController@profile')->middleware('auth');
Route::get('/profile/settings', 'ProfileController@settings')->middleware('auth');
Route::get('/profile/vacancies', 'ProfileController@allvacancies')->middleware('ifCompany');


Route::post('/vacancies/add', 'VacancyController@add')->middleware('ifCompany');
