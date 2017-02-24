const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    /**
     * 前台样式
     */
    .sass('resources/assets/sass/frontend/app.scss','css/frontend')
    /**
     * js插件样式
     * 后台合并所有插件样式
     */
    .less('resources/assets/less/app.less','../resources/assets/css/backend')
    /**
     * 默认模板
     */
    .sass('resources/assets/sass/backend/app.scss', '../resources/assets/css/backend/default.css')
    .combine([
        'resources/assets/css/backend/app.css',
        'resources/assets/css/vendor/jquery.dataTables.min.css',
        'resources/assets/css/vendor/dataTables.bootstrap.css',
        'resources/assets/css/vendor/bootstrap-datetimepicker.min.css',
        'resources/assets/css/vendor/media-manager.css'
    ], 'resources/assets/css/backend/plugin.css')
    .combine([
        'resources/assets/css/backend/plugin.css',
        'resources/assets/css/backend/default.css',
    ], 'public/css/backend/default.css')

    /**
     * 后台JS
     * 合并JS
     */
    .babel([
        'resources/assets/js/vendor/bootstrap.min.js',
        'resources/assets/js/vendor/bootstrap-switch.min.js',
        'resources/assets/js/vendor/bootstrap-hover-dropdown.min.js',
        'resources/assets/js/vendor/jquery.slimscroll.min.js',
        'resources/assets/js/vendor/jquery.blockUI.js',
        'resources/assets/js/vendor/js.cookie.js',
        'resources/assets/js/vendor/moment.min.js',
        'resources/assets/js/vendor/select2.min.js',
        'resources/assets/js/vendor/daterangepicker.js',
        'resources/assets/js/vendor/jquery.dataTables.min.js',
        'resources/assets/js/vendor/dataTables.bootstrap.js',
        'resources/assets/js/vendor/bootstrap-datetimepicker.min.js',
        'resources/assets/js/vendor/bootstrap-datepicker.min.js',
        'resources/assets/js/vendor/sweetalert.min.js',
        'resources/assets/js/vendor/icheck.min.js',
        'resources/assets/js/vendor/jquery.validate.min.js',
        'resources/assets/js/vendor/jsvalidation.min.js',
        'resources/assets/js/vendor/additional-methods.min.js',
        'resources/assets/js/vendor/jquery.bootstrap.wizard.min.js',
        'resources/assets/js/vendor/ekko-lightbox.min.js',
        'resources/assets/js/theme.js',
        'resources/assets/js/layout.js',
        'resources/assets/js/datatable.js',
        'resources/assets/js/quick-sidebar.js',
        'resources/assets/js/customer.js',
        /**
         * JS插件语言包
         */
        'resources/assets/js/language/*.js'
    ], 'public/js/backend.js')

     /**
     * 版本控制
     */
    .version();
