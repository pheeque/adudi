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
        Route::delete('/tasks/{id}', 'TasksController@destroy')->name('destroy');
        Route::patch('/tasks/{id}', 'TasksController@update')->name('update');

        Route::patch('/tasks/{id}/complete', 'CompleteTaskController')->name('complete');
        Route::patch('/tasks/{id}/uncomplete', 'UnCompleteTaskController')->name('uncomplete');
    });

    Route::get('/tasks/month/{month}', 'TasksOfMonthController')->name('tasks-of-month');
    Route::get('/tasks/day/{day}', 'TasksOfDayController')->name('tasks-of-day');

});

Route::namespace ('Api')->group(function () {
    Route::get('/users', 'UsersController@index');
    Route::get('/users/{user}', 'UsersController@show');
    Route::patch('/users/{user}', 'UsersController@update');
    Route::delete('/users/{user}', 'UsersController@destroy');
    Route::post('/users', 'UsersController@store');
});
