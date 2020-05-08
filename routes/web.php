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
Route::get('/seat', function () {
    return view('web.seat_template.index');
});

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group([
    'namespace' => 'Web'
], function () {
    Route::group([
        'prefix' => '{locale}',
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'locale'
    ], function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/dat-ve', 'BookingController@index')->name('booking');
        Route::get('/send-mail', 'BookingController@sendMail')->name('sendmail');
        Route::get('/bang-gia', 'HomeController@index')->name('price-table');
        Route::get('/huong-dan-dat-ve', 'HomeController@index')->name('ticket-purchase-guide');
        Route::post('/book-route', 'BookingController@bookRoute')->name('booking-route');
    });
    Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('social-redirect');
    Route::get('/callback/{social}', 'SocialAuthController@callback')->name('social-callback');
    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('change-language');
    Route::post('/search-route', 'BookingController@search')->name('search-route');
    Route::post('/get-pickup-places', 'TripController@getPickupPlaces')->name('get-pickup-places');
    Route::post('/get-seat-map', 'TripController@getSeatMap')->name('get-seat-map');
    Route::get('/get-seat-map', 'TripController@getSeatMap')->name('get-seat-map');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    
    // Route::get('/book-route', 'BookingController@bookRoute')->name('booking-route');
    Route::get('/test', 'BookingController@bookRoute');
});
