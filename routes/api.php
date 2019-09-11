<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
 */

Route::group([
    'middleware' => 'auth:api',
    'namespace'  => 'Api',
], function () {
    Route::group([
        'as' => 'tasks.',
    ], function () {
        Route::post('/tasks', 'TasksController@store')->name('store');
    });
});

Route::namespace ('Api')->group(function () {
    Route::get('/users', 'UsersController@index');
    Route::get('/users/{user}', 'UsersController@show');
    Route::patch('/users/{user}', 'UsersController@update');
    Route::delete('/users/{user}', 'UsersController@destroy');
    Route::post('/users', 'UsersController@store');
});
