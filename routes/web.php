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

Route::get('/{id?}', ['uses' => 'Shop\IndexController@index', 'middleware' => ['web']])->name('index');
/**
 *
 */
Route::post('/search', ['uses' => 'Shop\IndexController@search'])->name('search');;
/**
 *
 */
Route::get('/contact', ['uses' => 'Shop\ContactController@Contact'])->name('contact');
Route::post('/contact', ['uses' => 'Shop\ContactController@xxxxxx'])->name('xxxxxxx');
/**
 *
 */

Route::get('/product/{id}', ['uses' => 'Shop\IndexController@product'])->name('product');
Route::post('/product/comments/{id}', ['uses' => 'Shop\IndexController@comments'])->name('comments');


/**
 *
 */
Route::group(['prefix' => 'cart', 'middleware' => 'web'], function () {

    Route::get('/', ['uses' => 'Shop\CartController@Cart'])->name('cart');
    /**
     *
     */
    Route::get('/add/{id}', ['uses' => 'Shop\CartController@cartAdd'])->name('cartAdd');
    Route::get('/delete/{id}', ['uses' => 'Shop\CartController@cartDelete'])->name('deleteCart');

    /**
     *
     */
    Route::get('/plusItem/{id}', ['uses' => 'Shop\CartController@plusItemCart'])->name('plusItemCart');
    Route::get('/minusItem/{id}', ['uses' => 'Shop\CartController@minusItemCart'])->name('minusItemCart');

    Route::post('/saveOrder', ['uses' => 'Shop\CartController@saveOrderProducts'])->name('saveOrderProducts');

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
    Route::get('/checkAuth', ['uses' => 'Home\HomeController@checkAuth'])->name('checkAuth');;
    Route::get('/', ['uses' => 'Home\HomeController@show'])->name('show-index');;

    /**
     * Group permission
     */
    Route::group(['middleware' => ['permission:create-product|edit-user']], function () {

        Route::get('/products', ['uses' => 'Home\HomeProductController@index'])->name('home_products');
        /**
         *
         */
        Route::get('/create', ['uses' => 'Home\HomeProductController@createProducts'])->name('create_show');
        Route::post('/create', ['uses' => 'Home\HomeProductController@create'])->name('create_create');
        /**
         *
         */
        Route::get('/present/{id}', ['uses' => 'Home\HomeProductController@present'])->name('present');
        Route::post('/present/upload/{id}', ['uses' => 'Home\UploadImageController@upload'])->name('upload');

        /**
         *
         */
        Route::get('/update/{id}', ['uses' => 'Home\HomeProductController@updateShow'])->name('update');
        Route::post('/update/upload/{id}', ['uses' => 'Home\HomeProductController@saveUpdate'])->name('saveUpdate');

        /**
         *
         */
        Route::post('/delete/{id}', ['uses' => 'Home\HomeProductController@delete'])->name('delete');

        /**
         *
         */
        Route::get('/category', ['uses' => 'Home\HomeCategoryController@index'])->name('category');
        Route::post('/category/create', ['uses' => 'Home\HomeCategoryController@create'])->name('category_create');

        /**
         *
         */
        Route::post('/category/update/{id}', ['uses' => 'Home\HomeCategoryController@update'])->name('category_update');
        Route::post('/category/delete/{id}', ['uses' => 'Home\HomeCategoryController@delete'])->name('category_delete');

        /**
         *
         */
        Route::get('/cart', ['uses' => 'Home\HomeCartController@cart'])->name('home_cart');
        Route::post('/cart/delete/{id}', ['uses' => 'Home\HomeCartController@deleteOrder'])->name('deleteOrder');
        /*
         *
         */
        Route::group(['middleware' => ['role:admin']], function () {
            /**
             *
             */
            Route::get('/comment', ['uses' => 'Home\HomeCommentController@comment'])->name('home_comment');
            Route::post('/comment/change/{id}', ['uses' => 'Home\HomeCommentController@changeComment'])->name('home_changeComment');
            Route::post('/comment/delete/{id}', ['uses' => 'Home\HomeCommentController@deleteComment'])->name('home_addComment');
            /**
             *
             */
            Route::get('/users', ['uses' => 'Home\HomeUsersController@users'])->name('home_users');
            Route::get('/users/update/{id}', ['uses' => 'Home\HomeUsersController@update'])->name('home_users_update');
            Route::get('/users/delete/{id}', ['uses' => 'Home\HomeUsersController@deleteUser'])->name('home_users_delete');
            /**
             *
             */
            Route::post('/users/addRole/{id}', ['uses' => 'Home\HomeUsersController@addRole'])->name('home_add_role');
            Route::post('/users/deleteRole/{id}', ['uses' => 'Home\HomeUsersController@deleteRole'])->name('home_delete_role');

        });
    });

});

