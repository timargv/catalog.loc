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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel'] ], function () {

    Route::get('/', 'DashboardController@index')->name('home');

    Route::resource('categories', 'CategoriesController');

    Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
        Route::post('/first', 'CategoriesController@first')->name('first');
        Route::post('/up', 'CategoriesController@up')->name('up');
        Route::post('/down', 'CategoriesController@down')->name('down');
        Route::post('/last', 'CategoriesController@last')->name('last');
    });

});