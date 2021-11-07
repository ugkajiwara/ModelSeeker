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


// menus
Route::group(['prefix' => 'menu', 'middleware' => 'auth'],function(){
    Route::get('index', 'MenuController@index')->name('menu.index');
    Route::get('create', 'MenuController@create')->name('menu.create');
    Route::post('store', 'MenuController@store')->name('menu.store');
    Route::get('show/{id}', 'MenuController@show')->name('menu.show');
    Route::get('edit/{id}', 'MenuController@edit')->name('menu.edit');
    Route::post('update/{id}', 'MenuController@update')->name('menu.update');
    Route::post('destroy/{id}', 'MenuController@destroy')->name('menu.destroy');
});


// calendars
Route::group(['prefix' => 'calendar', 'middleware' => 'auth'],function(){
    Route::get('index', 'CalendarController@index')->name('calendar.index');
    Route::get('create', 'CalendarController@create')->name('calendar.crate');
    Route::post('store', 'CalendarController@store')->name('calendar.store');
    Route::get('show/{id}', 'CalendarController@show')->name('calendar.show');
    Route::post('destroy/{id}', 'CalendarController@destroy')->name('calendar.destroy');
});

// reservations
Route::get('/reservation/index', 'ReservationController@index')->name('reservation.index');
Route::get('/reservation/create', 'ReservationController@create')->name('reservation.create');
Route::post('/reservation/confirm', 'ReservationController@confirm')->name('reservation.confirm');
Route::post('/reservation/store', 'ReservationController@store')->name('reservation.store');
Route::get('/reservation/thanks', 'ReservationController@thanks')->name('reservation.thanks');

Route::group(['prefix' => 'notification', 'middleware' => 'auth'],function(){
    Route::get('index', 'notificationController@index')->name('notification.index');
});

// settings
Route::group(['prefix' => 'setting', 'middleware' => 'auth'],function(){
    Route::get('index', 'SettingController@index')->name('setting.index');
    Route::get('edit', 'SettingController@edit')->name('setting.edit');
    Route::post('update', 'SettingController@update')->name('setting.update');
});
Route::get('/setting/how_to_use', 'SettingController@how_to_use')->name('setting.how_to_use');
Route::get('/setting/faq', 'SettingController@faq')->name('setting.faq');
Route::get('/setting/contact', 'SettingController@contact')->name('setting.contact');
Route::get('/setting/terms', 'SettingController@terms')->name('setting.terms');
Route::get('/setting/privacy_policy', 'SettingController@privacy_policy')->name('setting.privacy_policy');


//mail送信に関して
Route::get('sample/mailable/preview', function () {
    return new App\Mail\RegisterNotification();
  });

//   Route::get('sample/mailable/send', 'Auth\RegisterController@create');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
