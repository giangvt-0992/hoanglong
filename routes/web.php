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
        Route::get('/dat-ve', 'RouteController@index')->name('booking');
        Route::get('/bang-gia', 'HomeController@index')->name('price-table');
        Route::get('/huong-dan-dat-ve', 'HomeController@index')->name('ticket-purchase-guide');
    });
    Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('social-redirect');
    Route::get('/callback/{social}', 'SocialAuthController@callback')->name('social-callback');
    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('change-language');
    Route::post('/search-route', 'RouteController@search')->name('search-route');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
