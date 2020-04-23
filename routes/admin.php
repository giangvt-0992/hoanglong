<?php

Route::group([
    'prefix' => 'admin/',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function () {
    Route::get('login', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::post('/file/upload', 'ImageController@upload')->name('image.upload');
    Route::post('/file/delete', 'ImageController@delete')->name('image.delete');
    Route::group([
        'middleware' => ['admin', 'image.unuse', 'auth:admin']
    ], function () {
        Route::get('/', 'HomeController@index')->name('index');

        Route::group([
            'as' => 'brand.',
            'prefix' => 'brands'
        ], function () {
            Route::get('/', 'BrandController@index')->name('index');
            Route::get('/create', 'BrandController@create')->name('create');
            Route::post('/create', 'BrandController@store');
            Route::get('/{brand}/edit', 'BrandController@edit')->name('update');
            Route::put('/{brand}/edit', 'BrandController@update');
            Route::get('/{brand}/destroy', 'BrandController@destroy')->name('destroy');
            Route::get('/{brand}/active', 'BrandController@active')->name('active');
            Route::get('/{id}/images', 'BrandController@images')->name('images');
        });
    });
});
