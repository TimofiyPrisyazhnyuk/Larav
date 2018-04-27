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

Route::get('/{id?}', ['uses' => 'Shop\IndexController@index', 'as' => 'index', 'middleware' => ['web']]);
Route::post('/', ['uses' => 'Shop\IndexController@index', 'as' => 'index', 'middleware' => ['web']]);
/**
 *
 */
Route::post('/search', ['uses' => 'Shop\IndexController@search', 'as' => 'search']);
/**
 *
 */
Route::get('/contact', ['uses' => 'Shop\ContactController@Contact', 'as' => 'contact']);
//TODO:Timofiy  ~ Need to change -
Route::post('/contact', ['uses' => 'Shop\ContactController@Contact', 'as' => 'contact']);
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
    Route::get('/checkAuth', ['uses' => 'Home\HomeController@checkAuth', 'as' => 'checkAuth']);
    Route::get('/', ['uses' => 'Home\HomeController@show', 'as' => 'show-index']);

    /**
     * Group permission
     */
    Route::group(['middleware' => ['permission:create-product|edit-user']], function () {

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
        /*
         *
         */
        Route::group(['middleware' => ['role:admin']], function () {
            /**
             *
             */
            Route::get('/comment', ['uses' => 'Home\HomeCommentController@comment', 'as' => 'home_comment']);
            Route::post('/comment/change/{id}', ['uses' => 'Home\HomeCommentController@changeComment', 'as' => 'home_changeComment']);
            Route::post('/comment/delete/{id}', ['uses' => 'Home\HomeCommentController@deleteComment', 'as' => 'home_addComment']);
            /**
             *
             */
            Route::get('/users', ['uses' => 'Home\HomeUsersController@users', 'as' => 'home_users']);
            Route::get('/users/update/{id}', ['uses' => 'Home\HomeUsersController@update', 'as' => 'home_users_update']);
            Route::get('/users/delete/{id}', ['uses' => 'Home\HomeUsersController@deleteUser', 'as' => 'home_users_delete']);
            /**
             *
             */
            Route::post('/users/addRole/{id}', ['uses' => 'Home\HomeUsersController@addRole', 'as' => 'home_add_role']);
            Route::post('/users/deleteRole/{id}', ['uses' => 'Home\HomeUsersController@deleteRole', 'as' => 'home_delete_role']);

        });
    });

});

//Route::get('/role', ['uses' => 'Shop\IndexController@role']);
