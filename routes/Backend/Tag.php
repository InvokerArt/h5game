<?php
//标签
Route::group(['namespace' => 'Tags', 'as' => 'tag.', 'prefix' => 'tag'], function () {
    Route::get('/get', 'IndexController@get')->name('get');
    Route::get('/popular', 'IndexController@popular')->name('popular');
    Route::post('/', 'IndexController@store')->name('store');
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/create', 'IndexController@create')->name('create');
    Route::match(['put', 'patch'], '/{tag}', 'IndexController@update')->name('update');
    Route::delete('/{tag}', 'IndexController@destroy')->name('destroy');
    Route::get('/{tag}', 'IndexController@show')->name('show');
    Route::get('/{tag}/edit', 'IndexController@edit')->name('edit');
    Route::get('/{tag}/delete', 'IndexController@delete')->name('delete');
    Route::get('/{tag}/restore', 'IndexController@restore')->name('restore');
});
