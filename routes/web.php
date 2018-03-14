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

Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/createph', 'PhonebookController@showCreateForm');

Route::get('/viewph','PhonebookController@view');

Route::get('/sendsms', 'SmsController@showSendForm');

Route::get('/achieved' , 'SmsController@showAchieved');

Route::post('/phonebook/create', 'PhonebookController@create');

Route::get('/phonebook/delete/{phonebook_id}', 'PhonebookController@deletePhonebook');

Route::get('/contact/view/{phonebook_id}', 'ContactController@view');

Route::get('/contact/delete/{id}', 'ContactController@delete');

Route::post('/sms/send', 'SmsController@send');

Route::get('/achieved/resend/{id}', 'SmsController@resendSMS');

Route::get('/achieved/delete/{id}', 'SmsController@deleteSMS');

Route::get('/sendsms/fasttrack/{phonebook_id}', 'SmsController@fasttrackShowSendForm');


