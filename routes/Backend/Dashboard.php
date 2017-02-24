<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/', 'DashboardController@index')->name('index');
//媒体库
Route::get('/media', 'Media\IndexController@index')->name('media.index');
