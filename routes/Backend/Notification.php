<?php
//通知
Route::group(['namespace' => 'Notifications', 'as' => 'notification.', 'prefix' => 'notification'], function () {
    Route::get('/get', 'NotificationController@get')->name('get');
    Route::get('/', 'NotificationController@index')->name('index');
    Route::get('create', 'NotificationController@create')->name('create');
    Route::post('/', 'NotificationController@store')->name('store');
    Route::delete('/{notification}', 'NotificationController@destroy')->name('destroy');
});
