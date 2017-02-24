<?php
//反馈
Route::group(['namespace' => 'Feedbacks', 'as' => 'feedback.', 'prefix' => 'feedback'], function () {
    Route::get('/get', 'FeedbackController@get')->name('get');
    Route::get('/', 'FeedbackController@index')->name('index');
    Route::get('/{feedback}', 'FeedbackController@show')->name('show');
    Route::delete('/{feedback}', 'FeedbackController@destroy')->name('destroy');
});