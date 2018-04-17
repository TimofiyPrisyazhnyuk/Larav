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

Route::get('/{id?}', ['uses' => 'Shop\IndexController@Index', 'as' => 'index']);
/**
 *
 */
Route::match(['get', 'post'], '/contact', ['uses' => 'Shop\ContactController@Contact', 'as' => 'contact']);
/**
 *
 */

Route::get('/product/{id}', ['uses' => 'Shop\IndexController@product', 'as' => 'product']);
Route::post('/product/comments/{id}', ['uses' => 'Shop\IndexController@comments', 'as' => 'comments']);


/**
 *
 */
Route::group(['prefix' => 'cart', 'middleware' => 'web'], function () {

    Route::get('/', ['uses' => 'Shop\CartController@Cart', 'as' => 'cart', 'middleware' => 'web']);
    /**
     *
     */
    Route::get('/add/{id}', ['uses' => 'Shop\CartController@cartAdd', 'as' => 'cartAdd']);
    Route::get('/delete/{id}', ['uses' => 'Shop\CartController@cartDelete', 'as' => 'deleteCart']);

    /**
     *
     */
    Route::get('/plusItem/{id}', ['uses' => 'Shop\CartController@plusItemCart', 'as' => 'plusItemCart']);
    Route::get('/minusItem/{id}', ['uses' => 'Shop\CartController@minusItemCart', 'as' => 'minusItemCart']);

    Route::post('/saveOrder', ['uses' => 'Shop\CartController@saveOrderProducts', 'as' => 'saveOrderProducts']);

});
/**
 * Auth Group routes
 */

Route::group(['middleware' => 'web'], function () {

    Auth::routes();

});

/**
 * Group Routes home
 */

Route::group(['prefix' => 'home', 'middleware' => ['web', 'auth']], function () {
    /**
     *
     */
    Route::get('/', ['uses' => 'Home\HomeController@show', 'as' => 'admin_index']);
    Route::get('/products', ['uses' => 'Home\HomeProductController@index', 'as' => 'home_products']);
    /**
     *
     */
    Route::get('/create', ['uses' => 'Home\HomeProductController@createProducts', 'as' => 'create_show']);
    Route::post('/create', ['uses' => 'Home\HomeProductController@create', 'as' => 'create_create']);
    /**
     *
     */
    Route::get('/present/{id}', ['uses' => 'Home\HomeProductController@present', 'as' => 'present']);
    Route::post('/present/upload/{id}', ['uses' => 'Home\UploadImageController@upload', 'as' => 'upload']);

    /**
     *
     */
    Route::get('/update/{id}', ['uses' => 'Home\HomeProductController@updateShow', 'as' => 'update']);
    Route::post('/update/upload/{id}', ['uses' => 'Home\HomeProductController@saveUpdate', 'as' => 'saveUpdate']);

    /**
     *
     */
    Route::post('/delete/{id}', ['uses' => 'Home\HomeProductController@delete', 'as' => 'delete']);

    /**
     *
     */
    Route::get('/category', ['uses' => 'Home\HomeCategoryController@index', 'as' => 'category']);
    Route::post('/category/create', ['uses' => 'Home\HomeCategoryController@create', 'as' => 'category_create']);

    /**
     *
     */
    Route::post('/category/update/{id}', ['uses' => 'Home\HomeCategoryController@update', 'as' => 'category_update']);

    Route::post('/category/delete/{id}', ['uses' => 'Home\HomeCategoryController@delete', 'as' => 'category_delete']);


    /**
     *
     */
    Route::get('/cart', ['uses' => 'Home\HomeCartController@cart', 'as' => 'home_cart']);
    Route::post('/cart/delete/{id}', ['uses' => 'Home\HomeCartController@deleteOrder', 'as' => 'deleteOrder']);

});