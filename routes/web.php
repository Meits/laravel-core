<?php

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

Auth::routes();

Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail')->name('register.confirm');

Route::group(['prefix' => 'administrator','middleware'=> ['auth','acheck','setLocale']],function() {


    Route::get('/',['uses' => 'Admin\IndexController@index','as' => 'admin-index']);

    Route::resource('pages', 'Admin\PagesController');
    Route::resource('seo', 'Admin\SeoController');
    Route::resource('settings', 'Admin\SettingsController');
    Route::resource('users', 'Admin\UsersController');
    Route::resource('roles', 'Admin\RolesController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('faq', 'Admin\FaqController');
    Route::resource('contacts', 'Admin\ContactsController');
    Route::resource('scripts', 'Admin\ScriptsController');
    Route::resource('robots', 'Admin\RobotsController');

    Route::any('/ckfinder/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
        ->name('ckfinder_examples');

    Route::post('image/upload','Admin\FilesController@storeFile')->name('admin-blog-get-alias');
});

Route::get('sitemap.xml',['uses' => 'Pub\SitemapController@index','as' => 'public-sitymap-index']);

// Pages
Route::get(
    '/{alias?}',
    'Pub\PageController@index')
    ->name('public-pages');
