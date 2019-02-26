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

    // Фикс Категории Мир Инструмента
    Route::get('/fix', 'CategoriesController@fixCategory')->name('categories.fix');
    //--------------------------------------------------------------------------------------------------------------------------------

    // Товары
    Route::resource('products', 'ProductsController');

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/{product}/photos', 'ProductsController@photosForm')->name('photos');
        Route::post('/{product}/photos', 'ProductsController@photos')->name('photos.add');
        Route::post('/{product}/photo/{id}/delete', 'ProductsController@destroyPhoto')->name('photos.delete');
        Route::post('/{product}/photos/deletes', 'ProductsController@destroyPhotos')->name('photos.deletes');
        Route::post('/{product}/photo/{id}', 'ProductsController@updatePhotoMain')->name('photos.main');
    });

    // Бренды
    Route::resource('brands', 'BrandController');

    // Поставщики
    Route::resource('/vendors', 'VendorsController');

    Route::group(['namespace' => 'Shop\Attribute'], function () {
        // Группы Атрибутов
        Route::resource('/attribute-groups', 'AttributeGroupController');
        // Атрибуты
        Route::resource('/attributes', 'AttributeController');
    });

    // IMPORT
    Route::group(['prefix' => 'import', 'as' => 'import.', 'namespace' => 'ImportExport'], function () {

        Route::get('/product', 'HomeController@product')->name('product');
        Route::get('/category', 'HomeController@category')->name('category');
        Route::get('/user', 'HomeController@user')->name('user');


        // ===== API IMPORT =====

        // Функция Импорта КАТЕГОРИИ из МИР ИНСТРУММЕНТ: XML
        Route::group(['namespace' => 'Category'], function () {
            Route::get('/mir-instrument-category', 'XmlController@instrumentImportCategoryXml')->name('category.mir.instrument.xml');
        });

        // Функция Импорта ТОВАРА из МИР ИНСТРУММЕНТ: XML
        Route::group(['namespace' => 'Product'], function () {
            Route::get('/mir-instrument-product', 'XmlController@instrumentImportProductXml')->name('product.mir.instrument.xml');
        });
        //--------------------------------------------------------------------------------------------------------------------------------------------


    });

});