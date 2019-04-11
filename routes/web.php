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


Route::group([],  function () {

    Route::group(['prefix' => 'cart', 'as' => 'cart.', 'namespace' => 'Shop'], function () {
        Route::get('/', 'CartController@show')->name('index');
        Route::post('/{id}/add', 'CartController@add')->name('add');
        Route::post('/{id}/remove', 'CartController@remove')->name('remove');
        Route::post('/{id}/update/quantity', 'CartController@updateQuantity')->name('update.quantity');
        Route::get('/clear', 'CartController@clear')->name('clear');
    });

});

Route::group(['prefix' => 'search', 'as' => 'search.', 'namespace' => 'Product'], function () {
    Route::get('/product', 'SearchController@index')->name('index');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'can:admin-panel'] ], function () {


    // Панель Администратора
    Route::get('/', 'DashboardController@index')->name('home');


    // Пользователи
    Route::resource('/users', 'UsersController');
    Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');
    Route::group(['prefix' => 'carts', 'as' => 'carts.'], function () {
        Route::get('/', 'CartsController@index')->name('index');
        Route::get('/user/{user}/show', 'CartsController@show')->name('show');
    });


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

    // Виджеты
    Route::resource('widgets', 'WidgetController');
    Route::get('/widgets-autocomplete-ajax', 'WidgetController@dataAjax');
    Route::get('/widget/{widget}/item/add', 'WidgetController@add')->name('widgets.item.add');
    Route::post('/widget/{widget}/item/add', 'WidgetController@add')->name('widgets.item.add');
    Route::delete('/widget/{widget}/{itemId}/delete', 'WidgetController@deleteWidgetItem')->name('widgets.item.delete');


    // Статусы
    Route::group(['prefix' => 'order-statuses-list', 'as' => 'order-statuses-list.', 'namespace' => 'Shop'], function () {
        Route::get('/', 'OrderStatusesListController@index')->name('index');
        Route::post('/store', 'OrderStatusesListController@store')->name('store');
        Route::get('/{status}/edit', 'OrderStatusesListController@edit')->name('edit');
        Route::put('/{status}/update', 'OrderStatusesListController@update')->name('update');
        Route::delete('/{id}/destroy', 'OrderStatusesListController@destroy')->name('destroy');
    });

    Route::group(['namespace' => 'Shop\Attribute'], function () {
        // Группы Атрибутов
        Route::resource('/attribute-groups', 'AttributeGroupController');
        // Атрибуты
        Route::resource('/attributes', 'AttributeController');
    });

    // Способы доставки
    Route::group(['namespace' => 'Shop'], function () {
        Route::resource('/deliveries', 'DeliveriesController');
        Route::resource('/orders', 'OrdersController');
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
