<?php
//广告
Route::group(['namespace' => 'Banners', 'as' => 'banner.', 'prefix' => 'banner'], function () {
    //广告位
    Route::get('/get', 'BannerController@get')->name('get');
    Route::post('/', 'BannerController@store')->name('store');
    Route::get('/', 'BannerController@index')->name('index');
    Route::get('/create', 'BannerController@create')->name('create');
    Route::match(['put', 'patch'], '/{banner}', 'BannerController@update')->name('update');
    Route::delete('/{banner}', 'BannerController@destroy')->name('destroy');
    Route::get('/{banner}/edit', 'BannerController@edit')->name('edit');
    Route::get('/{banner}/delete', 'BannerController@delete')->name('delete');
    Route::get('/{banner}/restore', 'BannerController@restore')->name('restore');
    //轮播图
    Route::get('/image/get', 'ImageController@get')->name('image.get');
    Route::resource('/image', 'ImageController');
    Route::get('/image/{image}/delete', 'ImageController@delete')->name('image.delete');
    Route::get('/image/{image}/restore', 'ImageController@restore')->name('image.restore');
});
