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


        Route::group([
            'as' => 'user.',
            'prefix' => 'users'
        ], function () {
            Route::get('/', 'AdminController@index')->name('index');
            Route::get('/create', 'AdminController@create')->name('create');
            Route::post('/', 'AdminController@store')->name('store');
            // Route::get('/{admin}/edit', 'AdminController@edit')->name('update');
            // Route::post('/{admin}/edit', 'AdminController@update');
            Route::get('/{admin}/destroy', 'AdminController@destroy')->name('destroy');
            Route::get('/{admin}/active', 'AdminController@active')->name('active');
            Route::get('/{admin}/deactivate', 'AdminController@deactivate')->name('deactivate');
        });

        Route::group([
            'as' => 'role.',
            'prefix' => 'roles'
        ], function () {
            Route::get('/create', 'RoleController@create')->name('create');
            Route::post('/', 'RoleController@store')->name('store');
            Route::get('/{role}/edit', 'RoleController@edit')->name('update');
            Route::post('/{role}/edit', 'RoleController@update');
            Route::get('/{role}/destroy', 'RoleController@destroy')->name('destroy');
        });

        Route::group([
            'as' => 'place.',
            'prefix' => 'places'
        ], function () {
            Route::get('/', 'PlaceController@index')->name('index');
            Route::get('/create', 'PlaceController@create')->name('create');
            Route::post('/', 'PlaceController@store')->name('store');
            Route::get('/{place}/edit', 'PlaceController@edit')->name('update');
            Route::post('/{place}/edit', 'PlaceController@update');
            Route::get('/{place}/destroy', 'PlaceController@destroy')->name('destroy');
        });

        Route::group([
            'as' => 'route.',
            'prefix' => 'routes'
        ], function () {
            Route::get('/', 'RouteController@index')->name('index');
            Route::get('/create', 'RouteController@create')->name('create');
            Route::post('/', 'RouteController@store')->name('store');
            Route::get('/{route}/edit', 'RouteController@edit')->name('update');
            Route::post('/{route}/edit', 'RouteController@update');
            Route::get('/{route}/destroy', 'RouteController@destroy')->name('destroy');
        });
    });
});
