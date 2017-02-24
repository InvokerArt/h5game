<?php
Route::group(['namespace' => 'News', 'as' => 'news.', 'prefix' => 'news'], function () {
    //新闻分类
    Route::resource('categories', 'CategoryController', ['except' => 'show']);
    Route::get('categories/children', 'CategoryController@children')->name('categories.children');
    Route::post('categories/move', 'CategoryController@move')->name('categories.move');
    Route::post('categories/copy', 'CategoryController@copy')->name('categories.copy');
    Route::post('categories/rename', 'CategoryController@rename')->name('categories.rename');
    //评论
    Route::group(['as' => 'comments.', 'prefix' => 'comments'], function () {
        Route::get('/get', 'CommentController@get')->name('get');
        Route::post('/', 'CommentController@store')->name('store');
        Route::get('/', 'CommentController@index')->name('index');
        Route::get('/create', 'CommentController@create')->name('create');
        Route::match(['put', 'patch'], '/{comment}', 'CommentController@update')->name('update');
        Route::delete('/{comment}', 'CommentController@destroy')->name('destroy');
        Route::get('/{comment}', 'CommentController@show')->name('show');
        Route::get('/{comment}/edit', 'CommentController@edit')->name('edit');
        Route::get('/{comment}/commentto', 'CommentController@commentto')->name('commentto');
        Route::get('/{comment}/delete', 'CommentController@delete')->name('delete');
        Route::get('/{comment}/restore', 'CommentController@restore')->name('restore');
    });
    //新闻
    Route::get('/get', 'NewsController@get')->name('get');
    Route::get('/ajax', 'NewsController@info')->name('ajax.info');
    Route::post('/', 'NewsController@store')->name('store');
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('/create', 'NewsController@create')->name('create');
    Route::match(['put', 'patch'], '/{news}', 'NewsController@update')->name('update');
    Route::delete('/{news}', 'NewsController@destroy')->name('destroy');
    Route::get('/{news}', 'NewsController@show')->name('show');
    Route::get('/{news}/edit', 'NewsController@edit')->name('edit');
    Route::get('/{news}/delete', 'NewsController@delete')->name('delete');
    Route::get('/{news}/restore', 'NewsController@restore')->name('restore');
});
