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

Route::post('/contact', 'HomeController@sendContact');

Route::get('/home', function(){
	return redirect('/');
});

Route::get('/facebook/login', 'FacebookController@redirectToProvider');
Route::get('/facebook/callback', 'FacebookController@handleProviderCallback');

Route::get('/profile', 'ProfileController@profile')->middleware('auth');
Route::get('/profile/settings', 'ProfileController@settings')->middleware('auth');
Route::get('/profile/vacancies', 'ProfileController@allvacancies')->middleware('ifCompany');
Route::get('/profile/incoming', 'ProfileController@allincoming')->middleware('ifCompany');
Route::get('/profile/videos', 'ProfileController@videos');
Route::post('/profile/updatepassword', 'ProfileController@changePass')->middleware('auth');
Route::post('/profile/uploadlogo' , 'ProfileController@uploadlogo')->middleware('auth');
Route::get('/profile/removelogo', 'ProfileController@deletelogo')->middleware('auth');
Route::post('/profile/uploadvideo' , 'ProfileController@uploadVideo')->middleware('auth');

Route::get('/profile/events', 'ProfileController@allevents')->middleware('ifCompany');
Route::get('/profile/allincomingfc', 'ProfileController@allincomingfc')->middleware('ifCompany');
// Route::get('/profile/allincomingfc/search', 'ProfileController@allincomingfcSearch')->middleware('ifCompany');

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
Route::get('/readnotifications', 'ProfileController@readNotifications')->middleware('ifCompany');
Route::get('/vacancies/save/{id}', 'ProfileController@saveVacancy')->middleware('ifUser');
Route::get('/vacancies/removesaved/{id}', 'ProfileController@removeSavedVacancy')->middleware('ifUser');

Route::get('/acceptbid/{id}', 'VacancyController@acceptbid')->middleware('ifCompany');
Route::get('/declinebid/{id}', 'VacancyController@declinebid')->middleware('ifCompany');

Route::get('/search/' , 'SearchController@search');

// Route::group(['prefix'=>'facecontrol'], function(){
// 	Route::get('/', 'FaceController@index');
// 	Route::post('/bid', 'VacancyController@bidOnFaceControl');
// });
Route::get('/news/{id}', 'HomeController@news');
Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function(){
	Route::get('/', 'AdminController@index');
	Route::get('/removeuser/{id}', 'AdminController@removeuser');
	Route::get('/removevacancy/{id}', 'AdminController@removevacancy');
	Route::get('/removecontact/{id}', 'AdminController@removecontact');
	Route::get('/users', 'AdminController@users');
	Route::get('/companies', 'AdminController@companies');
	Route::get('/events', 'AdminController@events');
	Route::get('/vacancies', 'AdminController@vacancies');
	Route::post('/users', 'AdminController@searchusers');
	Route::post('/companies', 'AdminController@searchcompanies');
	Route::post('/events', 'AdminController@searchevents');
	Route::post('/vacancies', 'AdminController@searchvacancies');
	Route::get('/contact', 'AdminController@contact');
	Route::get('/news', 'AdminController@news');
	Route::post('/news', 'AdminController@postNews');
	Route::get('/news/remove/{id}', 'AdminController@removeNews');
	Route::get('/news/makebubble/{id}', 'AdminController@makeNewsForBubble');
});