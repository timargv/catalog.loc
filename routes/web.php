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

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel'] ], function () {

    // Панель Администратора
    Route::get('/', 'DashboardController@index')->name('home');

    // Пользователи
    Route::resource('/users', 'UsersController');
    Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');


    // Категории
    Route::resource('categories', 'CategoriesController');
    Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
        Route::post('/first', 'CategoriesController@first')->name('first');
        Route::post('/up', 'CategoriesController@up')->name('up');
        Route::post('/down', 'CategoriesController@down')->name('down');
        Route::post('/last', 'CategoriesController@last')->name('last');
    });
    Route::post('/categories/toggle-status', 'CategoriesController@toggleStatus')->name('categories.toggle.status');

    // Поставщики
    Route::resource('/shippers', 'ShippersController');

});