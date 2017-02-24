<?php
//常见问题
Route::group(['namespace' => 'Faqs', 'as' => 'faq.', 'prefix' => 'faq'], function () {
    Route::get('/get', 'FaqController@get')->name('get');
    Route::get('/', 'FaqController@index')->name('index');
    Route::get('/create', 'FaqController@create')->name('create');
    Route::post('/', 'FaqController@store')->name('store');
    Route::get('{faq}/edit', 'FaqController@edit')->name('edit');
    Route::match(['put', 'patch'], '{faq}', 'FaqController@update')->name('update');
    Route::delete('/{faq}', 'FaqController@destroy')->name('destroy');
});
