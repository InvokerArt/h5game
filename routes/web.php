<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => env('APP_BACKEND_PREFIX'), 'as' => env('APP_BACKEND_PREFIX').'.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});

Route::group(['namespace' => 'Backend', 'prefix' => env('APP_BACKEND_PREFIX'), 'as' => env('APP_BACKEND_PREFIX').'.', 'middleware' => 'guest'], function () {
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });
});
