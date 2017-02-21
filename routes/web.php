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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
	Route::post('comment', 'HomeController@comment');
	Route::get('notification/{id}', 'HomeController@notification');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/', 'ArticleController@index');
        Route::get('article/create', 'ArticleController@create');
        Route::post('article/store', 'ArticleController@store');
        Route::get('article/edit/{id}', 'ArticleController@edit');
        Route::post('article/update/{id}', 'ArticleController@update');
        Route::post('article/destroy/{id}', 'ArticleController@destroy');

        Route::get('comment', 'CommentController@index');
        Route::get('comment/edit/{id}', 'CommentController@edit');
        Route::post('comment/update/{id}', 'CommentController@update');
        Route::post('comment/destroy/{id}', 'CommentController@destroy');

        Route::get('category', 'CategoryController@index');
        Route::post('category/store', 'CategoryController@store');
        Route::post('category/destroy/{id}', 'CategoryController@destroy');

        Route::get('user', 'UserController@index');
        Route::post('user/update', 'UserController@update');
    });
});

Route::get('/article/{id}', 'HomeController@article');

Auth::routes();
