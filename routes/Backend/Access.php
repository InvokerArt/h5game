<?php

/**
 * All route names are prefixed with 'admin.access'.
 */
Route::group([
    'prefix'     => 'access',
    'as'         => 'access.',
    'namespace'  => 'Access',
], function () {

    //管理员
    Route::get('/admin/get', 'AdminController@get')->name('admin.get')->middleware('access.routeNeedsPermission:manage-admin');
    Route::resource('/admin', 'AdminController', ['middleware' => 'access.routeNeedsPermission:manage-admin']);
    //角色
    Route::get('/role/get', 'RoleController@get')->name('role.get')->middleware('access.routeNeedsPermission:manage-roles');
    Route::resource('/role', 'RoleController', ['middleware' => 'access.routeNeedsPermission:manage-roles']);
    //权限
    Route::get('/permission/get', 'PermissionController@get')->name('permission.get')->middleware('access.routeNeedsPermission:manage-permissions');
    Route::resource('/permission', 'PermissionController', ['middleware' => 'access.routeNeedsPermission:manage-permissions']);
});

/*
 * User Management
 */
Route::group([
    'middleware' => 'access.routeNeedsPermission:manage-users',
], function () {
    Route::group(['namespace' => 'User'], function () {
        /*
         * For DataTables
         */
        Route::get('user/get', 'UserController@get')->name('user.get');

        /*
         * User CRUD
         */
        Route::resource('user', 'UserController');

        /*
         * User Status'
         */
        Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
        Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');

        /*
         * Specific User
         */
        Route::group(['prefix' => 'user/{user}'], function () {
            // Account
            Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

            // Status
            Route::get('mark/{status}', 'UserStatusController@mark')->name('mark')->where(['status' => '[0,1]']);

            // Password
            Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
            Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password');

            // Access
            Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');
        });

        /*
         * Deleted User
         */
        Route::group(['prefix' => 'user/{deletedUser}'], function () {
            Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
            Route::get('restore', 'UserStatusController@restore')->name('user.restore');
        });
    });
});
