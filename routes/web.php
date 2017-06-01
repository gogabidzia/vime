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
Route::get('/profile/incoming', 'ProfileController@allincoming')->middleware('ifCompany');
Route::get('/profile/videos', 'ProfileController@videos');
Route::post('/profile/updatepassword', 'ProfileController@changePass')->middleware('auth');
Route::post('/profile/uploadlogo' , 'ProfileController@uploadlogo')->middleware('auth');
Route::post('/profile/uploadvideo' , 'ProfileController@uploadVideo')->middleware('auth');

Route::get('/profile/events', 'ProfileController@allevents')->middleware('ifCompany');
Route::get('/profile/allincomingfc', 'ProfileController@allincomingfc')->middleware('ifCompany');
Route::get('/profile/allsaved', 'ProfileController@allsaved')->middleware('ifUser');
Route::get('/profile/allbids', 'ProfileController@allbids')->middleware('ifUser');
Route::get('/profile/allfc', 'ProfileController@allfc')->middleware('ifUser');

Route::post('/vacancies/add', 'VacancyController@add')->middleware('ifCompany');
Route::get('/vacancies/remove/{id}', 'VacancyController@remove')->middleware('ifCompany');

Route::get('/vacancies/all/{id}' , 'VacancyController@view');
Route::post('/vacancies/bid', 'VacancyController@bid');

Route::get('/logos/{image}', 'ProfileController@getImage');
Route::get('/videos/{name}', 'ProfileController@getVideo');
Route::get('/videos/remove/{id}', 'ProfileController@removeVideo')->middleware('ifUser');
Route::get('/readnotifications', 'ProfileController@readNotifications');
Route::get('/vacancies/save/{id}', 'ProfileController@saveVacancy')->middleware('ifUser');

Route::get('/acceptbid/{id}', 'VacancyController@acceptbid')->middleware('ifCompany');
Route::get('/declinebid/{id}', 'VacancyController@declinebid')->middleware('ifCompany');

Route::get('/search/' , 'SearchController@search');

Route::group(['prefix'=>'facecontrol'], function(){
	Route::get('/', 'FaceController@index');
	Route::post('/bid', 'VacancyController@bidOnFaceControl');
});

Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function(){
	Route::get('/', 'AdminController@index');
	Route::get('/removeuser/{id}', 'AdminController@removeuser');
	Route::get('/removevacancy/{id}', 'AdminController@removevacancy');
});