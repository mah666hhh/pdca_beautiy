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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'StaticController');

    // /booksにgetリクエストされたら、Bookコントローラのindexアクションを呼び出す
    // Route::get('book', 'BookController@index');

    // /{id}でパラメータを渡せる
    // ルートパラメータ
    // Route::get('book/{id}', 'BookController@show');

    // resoursesと同じ
    // 基本のルーティングが定義される
    Route::resource('book', 'BookController');

    Route::get('/howto', 'HowtoController@index');

    Route::resource('post', 'PostController');
    Route::get('/search', 'SearchController');

    Route::get('/session/new', 'SessionController@create');
    Route::post('/session/login', 'SessionController@store');
    Route::delete('/session/logout', 'SessionController@destroy');

    Route::resource('user', 'UserController');
});

Auth::routes();
