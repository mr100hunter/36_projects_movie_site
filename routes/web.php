<?php

use Illuminate\Support\Facades\Route;

// users
use App\Http\Controllers\frontend\users\users_frontend_accounts_controller;
use App\Http\Controllers\frontend\users\users_frontend_deshbord_controller;

// admin
use App\Http\Controllers\frontend\admin\admin_frontend_accounts_Controller;
use App\Http\Controllers\frontend\admin\admin_frontend_users_Controller;
use App\Http\Controllers\frontend\admin\admin_frontend_setting_Controller;
use App\Http\Controllers\frontend\admin\admin_frontend_reseller_controller;
use App\Http\Controllers\frontend\admin\admin_frontend_urls_controller;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['users'])->group(function () {
    Route::get('/', [users_frontend_deshbord_controller::class, 'users_home_controller']) -> name('users_home_web');
    Route::get('/home/{id?}', [users_frontend_deshbord_controller::class, 'users_home_controller']) -> name('users_home_web');
    Route::get('/server2', [users_frontend_deshbord_controller::class, 'users_server2tv_controller']) -> name('users_server2tv_web');
    
    Route::get('/note', [users_frontend_deshbord_controller::class, 'users_note_controller']) -> name('users_note_web');
    
    Route::get('cat/{id?}', function(Request $request, $id){
        $request->session()->put('id', $id);
        return back();
    })->name('cat');
    
    
    Route::get('/server3', [users_frontend_deshbord_controller::class, 'users_livetv_controller']) -> name('users_livetv_web');
    Route::get('/404', [users_frontend_deshbord_controller::class, 'users_404_controller']) -> name('users_404_web');
});
Route::get('/update', [users_frontend_deshbord_controller::class, 'users_update_controller']) -> name('users_update_web');

Route::get('links/{uniqeKey?}', [admin_frontend_urls_controller::class, 'admin_urls_links_controller']) -> name('settings.urls_admin_urls_links_web');
Route::get('accounts', [users_frontend_accounts_controller::class, 'users_accounts_controller']) -> name('users_accounts_web');


// admin
Route::prefix('admin')->group(function () {
    Route::get('', [admin_frontend_accounts_Controller::class, 'admin_accounts_controller']);
    Route::get('accounts', [admin_frontend_accounts_Controller::class, 'admin_accounts_controller']) -> name('admin_accounts_web');

    Route::middleware(['admin'])->group(function () {

        // users
        Route::prefix('users')->group(function () {
            Route::get('update/{id}', [admin_frontend_users_Controller::class, 'admin_users_update_controller']) -> name('users.admin_update_web');
            Route::get('add', [admin_frontend_users_Controller::class, 'admin_users_add_controller']) -> name('users.admin_add_web');
            Route::get('all', [admin_frontend_users_Controller::class, 'admin_users_all_controller']) -> name('users.admin_all_web');
            Route::get('ban', [admin_frontend_users_Controller::class, 'admin_users_ban_controller']) -> name('users.admin_ban_web');
        });

        // reseller
        Route::prefix('reseller')->group(function () {
            Route::get('update/{id}', [admin_frontend_reseller_controller::class, 'admin_reseller_update_controller']) -> name('reseller.admin_update_web');
            Route::get('add', [admin_frontend_reseller_controller::class, 'admin_reseller_add_controller']) -> name('reseller.admin_add_web');
            Route::get('all', [admin_frontend_reseller_controller::class, 'admin_reseller_all_controller']) -> name('reseller.admin_all_web');
            Route::get('ban', [admin_frontend_reseller_controller::class, 'admin_reseller_ban_controller']) -> name('reseller.admin_ban_web');
        });

        Route::prefix('settings')->group(function () {
            // update
            Route::get('update-links', [admin_frontend_setting_Controller::class, 'admin_settings_update_links_controller']) -> name('settings.admin_update_links_web');

            // products 1
            Route::get('products', [admin_frontend_setting_Controller::class, 'admin_settings_products_controller']) -> name('settings.admin_products_web');
            Route::get('products_add/{id?}', [admin_frontend_setting_Controller::class, 'admin_settings_products_add_controller']) -> name('settings.admin_products_add_web');
            Route::get('products_update/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_products_update_controller']) -> name('settings.admin_products_update_web');

            // products2
            Route::get('products2', [admin_frontend_setting_Controller::class, 'admin_settings_products2_controller']) -> name('settings.admin_products2_web');
            Route::get('products2_add', [admin_frontend_setting_Controller::class, 'admin_settings_products2_add_controller']) -> name('settings.admin_products2_add_web');
            Route::get('products2_update/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_products2_update_controller']) -> name('settings.admin_products2_update_web');

            Route::get('contact', [admin_frontend_setting_Controller::class, 'admin_settings_contact_controller']) -> name('settings.admin_contact_web');

            // slider
            Route::get('slider', [admin_frontend_setting_Controller::class, 'admin_settings_slider_controller']) -> name('settings.admin_slider_web');
            Route::get('slider_add', [admin_frontend_setting_Controller::class, 'admin_settings_slider_add_controller']) -> name('settings.admin_slider_add_web');
            Route::get('slider_update/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_slider_update_controller']) -> name('settings.admin_slider_update_web');

            // slider2
            Route::get('slider2', [admin_frontend_setting_Controller::class, 'admin_settings_slider2_controller']) -> name('settings.admin_slider2_web');
            Route::get('slider2_add', [admin_frontend_setting_Controller::class, 'admin_settings_slider2_add_controller']) -> name('settings.admin_slider2_add_web');
            Route::get('slider2_update/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_slider2_update_controller']) -> name('settings.admin_slider2_update_web');

            // live tv
            Route::get('live_tv', [admin_frontend_setting_Controller::class, 'admin_settings_live_tv_controller']) -> name('settings.admin_live_tv_web');
            Route::get('live_tv_add', [admin_frontend_setting_Controller::class, 'admin_settings_live_tv_add_controller']) -> name('settings.admin_live_tv_add_web');
            Route::get('live_tv_update/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_live_tv_update_controller']) -> name('settings.admin_live_tv_update_web');

            // cetegory add updel
            Route::get('category', [admin_frontend_setting_Controller::class, 'admin_settings_category_controller']) -> name('settings.admin_category_web');
            Route::get('category_add', [admin_frontend_setting_Controller::class, 'admin_settings_category_add_controller']) -> name('settings.admin_category_add_web');
            Route::get('category_update/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_category_update_controller']) -> name('settings.admin_category_update_web');
            Route::get('category_products/{id}', [admin_frontend_setting_Controller::class, 'admin_settings_category_products_controller']) -> name('settings.admin_category_products_web');

            // urls
            Route::prefix('urls')->group(function () {
                Route::get('', [admin_frontend_urls_controller::class, 'admin_urls_controller']) -> name('settings.urls_admin_urls_web');
            });
        });

    });
});
