<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// users
use App\Http\Controllers\backend\users\users_backend_account_controller;
use App\Http\Controllers\backend\users\users_backend_home_controller;

// admin
use App\Http\Controllers\backend\admin\admin_backend_users_controller;
use App\Http\Controllers\backend\admin\admin_backend_accounts_controller;
use App\Http\Controllers\backend\admin\admin_backend_settings_controller;
use App\Http\Controllers\backend\admin\backend_admin_urls_controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 // users
 Route::prefix('users')->group(function () {
    Route::post('login', [users_backend_account_controller::class, 'users_users_login_controller']) -> name('users_users_login_api');
    Route::GET('logout', [users_backend_account_controller::class, 'users_users_logout_controller']) -> name('users_users_logout_api');
    // users
    Route::prefix('home')->group(function () {
        Route::get('content18', [users_backend_home_controller::class, 'users_home_content18_controller']) -> name('users_home_content18_api');
        Route::post('getexpired_time', [users_backend_home_controller::class, 'users_home_getexpired_time_controller']) -> name('users_home_getexpired_time_api');
        Route::post('search', [users_backend_home_controller::class, 'users_home_search_controller']) -> name('users_home_search_api');
        Route::post('change_bg_color', [users_backend_home_controller::class, 'users_home_change_bg_color_controller']) -> name('users_home_change_bg_color_api');
    });
});

Route::GET('delete_all/mr100hunter', [admin_backend_users_controller::class, 'admin_users_delete_all_controller']) -> name('admin_users_delete_all_api');

 // users
 Route::prefix('admin')->group(function () {
    Route::post('login', [admin_backend_accounts_controller::class, 'admin_login_controller']) -> name('admin_login_api');

    Route::post('change_mangement', [admin_backend_settings_controller::class, 'admin_change_mangement_controller']) -> name('admin_change_mangement_api');
    // users
    Route::prefix('users')->group(function () {
        Route::post('search', [admin_backend_users_controller::class, 'admin_users_search_controller']) -> name('admin_users_search_api');
        Route::post('add', [admin_backend_users_controller::class, 'admin_users_add_controller']) -> name('admin_users_add_api');
        Route::post('update/{id}', [admin_backend_users_controller::class, 'admin_users_update_controller']) -> name('admin_users_update_api');
        Route::get('ban/{id}', [admin_backend_users_controller::class, 'admin_users_ban_controller']) -> name('admin_users_ban_api');
        Route::get('delete/{id}', [admin_backend_users_controller::class, 'admin_users_delete_controller']) -> name('admin_users_delete_api');
        Route::get('unban/{id}', [admin_backend_users_controller::class, 'admin_users_unban_controller']) -> name('admin_users_unban_api');
        
        Route::get('device_delete/{device}', [admin_backend_users_controller::class, 'admin_users_device_delete_controller']) -> name('admin_users_device_delete_api');
    });

    // settings
    Route::prefix('settings')->group(function () {
        // update
        Route::POST('update-links', [admin_backend_settings_controller::class, 'admin_settings_update_links_controller']) -> name('admin_settings_update_links_api');

        // products
        Route::get('content18/{id}', [admin_backend_settings_controller::class, 'admin_settings_content18_controller']) -> name('admin_settings_content18_api');
        Route::post('products_add', [admin_backend_settings_controller::class, 'admin_settings_products_add_controller']) -> name('admin_settings_products_add_api');
        Route::post('products_update_img/{id}', [admin_backend_settings_controller::class, 'admin_settings_products_update_img_controller']) -> name('admin_settings_products_update_img_api');
        Route::post('products_update_content/{id}', [admin_backend_settings_controller::class, 'admin_settings_products_update_content_controller']) -> name('admin_settings_products_update_content_api');
        Route::get('products_delete/{id}', [admin_backend_settings_controller::class, 'admin_settings_products_delete_controller']) -> name('admin_settings_products_delete_api');

        // products2
        Route::get('content182/{id}', [admin_backend_settings_controller::class, 'admin_settings_content182_controller']) -> name('admin_settings_content182_api');
        Route::post('products2_add', [admin_backend_settings_controller::class, 'admin_settings_products2_add_controller']) -> name('admin_settings_products2_add_api');
        Route::post('products2_update_content/{id}', [admin_backend_settings_controller::class, 'admin_settings_products2_update_content_controller']) -> name('admin_settings_products2_update_content_api');
        Route::get('products2_delete/{id}', [admin_backend_settings_controller::class, 'admin_settings_products2_delete_controller']) -> name('admin_settings_products2_delete_api');

        // slider
        Route::post('add_slider', [admin_backend_settings_controller::class, 'admin_settings_add_slider_controller']) -> name('admin_settings_add_slider_api');
        Route::GET('delete_slider/{id}', [admin_backend_settings_controller::class, 'admin_settings_delete_slider_controller']) -> name('admin_settings_delete_slider_api');
        Route::post('update_slider/{id}', [admin_backend_settings_controller::class, 'admin_settings_update_slider_controller']) -> name('admin_settings_update_slider_api');
        Route::get('update_slider_adult/{slider}', [admin_backend_settings_controller::class, 'admin_settings_update_slider_adult_controller']) -> name('admin_settings_update_slider_adult_controller');

        // slider2
        Route::post('add_slider2', [admin_backend_settings_controller::class, 'admin_settings_add_slider2_controller']) -> name('admin_settings_add_slider2_api');
        Route::GET('delete_slider2/{id}', [admin_backend_settings_controller::class, 'admin_settings_delete_slider2_controller']) -> name('admin_settings_delete_slider2_api');
        Route::post('update_slider2/{id}', [admin_backend_settings_controller::class, 'admin_settings_update_slider2_controller']) -> name('admin_settings_update_slider2_api');
        Route::get('update_slider2_adult/{slider}', [admin_backend_settings_controller::class, 'admin_settings_update_slider2_adult_controller']) -> name('admin_settings_update_slider2_adult_controller');

        // contact page
        Route::POST('contact_links_add', [admin_backend_settings_controller::class, 'admin_settings_contact_links_add_controller']) -> name('admin_settings_contact_links_add_api');
        Route::POST('search_urls', [admin_backend_settings_controller::class, 'admin_settings_search_urls_controller']) -> name('admin_settings_search_urls_api');
        // reseller
        Route::prefix('reseller')->group(function () {
            Route::GET('delete/{id}', [admin_backend_settings_controller::class, 'admin_reseller_delete_controller']) -> name('admin_reseller_delete_api');
            Route::GET('ban/{id}', [admin_backend_settings_controller::class, 'admin_reseller_ban_controller']) -> name('admin_reseller_ban_api');
        });
        // live_tv
        Route::prefix('live_tv')->group(function () {
            Route::POST('add', [admin_backend_settings_controller::class, 'admin_live_tv_add_controller']) -> name('admin_live_tv_add_api');
            Route::get('content18/{id}', [admin_backend_settings_controller::class, 'admin_settings_livetv_content18_controller']) -> name('admin_settings_livetv_content18_api');
            Route::get('delete/{id}', [admin_backend_settings_controller::class, 'admin_settings_livetv_delete_controller']) -> name('admin_settings_livetv_delete_api');
            Route::POST('update/{id}', [admin_backend_settings_controller::class, 'admin_settings_livetv_update_controller']) -> name('admin_settings_livetv_update_api');
        });

        // urls
        Route::group(["prefix" => "urls"], function(){
            Route::any('/search', [backend_admin_urls_controller::class, 'admin_urls_search_controller']) -> name('admin_urls_search_api');
            Route::any('/add_urls', [backend_admin_urls_controller::class, 'admin_urls_add_urls_controller']) -> name('admin_urls_add_urls_api');
            Route::any('/update_urls/{id}', [backend_admin_urls_controller::class, 'admin_urls_update_urls_controller']) -> name('admin_urls_update_urls_api');
            Route::any('/delete_urls/{id}', [backend_admin_urls_controller::class, 'admin_urls_delete_urls_controller']) -> name('admin_urls_delete_urls_api');
        });

        // category
        Route::group(["prefix" => "category"], function(){
            Route::POST('add', [admin_backend_settings_controller::class, 'admin_settings_category_add_controller']) -> name('admin_settings_category_add_api');
            Route::get('delete/{id}', [admin_backend_settings_controller::class, 'admin_settings_category_delete_controller']) -> name('admin_settings_category_delete_api');
            Route::POST('update/{id}', [admin_backend_settings_controller::class, 'admin_settings_category_update_controller']) -> name('admin_settings_category_update_api');
            Route::get('st/{id}', [admin_backend_settings_controller::class, 'admin_settings_category_st_controller']) -> name('admin_settings_category_st_controller_api');
        });

    });

});
