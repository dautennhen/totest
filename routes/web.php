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

Route::get('', array('uses' => 'HomeController@index'));
/*
Route::get('/user',array('uses' => 'TestController@userResource'))->name('resource');
Route::get('/users',array('uses' => 'TestController@usersResource'))->name('resources');
Route::get('/search',array('uses' => 'TestController@elasticSearch'))->name('search');
*/
//Route::group(['middleware' => ['permission']], function () {
//load-route-action
Route::get('load-route-action/{route}', array('uses' => 'loadController@load'))->name('load-route-action');
Route::group(['prefix' => 'zipcodes'], function () {
    Route::get('', array('uses' => 'Zipcodenew\ZipcodenewController@getList'))->name('zipcode-list');
    Route::post('', array('uses' => 'Zipcodenew\Ajax\ZipcodenewAjaxController@getList'))->name('zipcode-list');
    Route::get('detail/{id}', array('uses' => 'Zipcodenew\ZipcodenewController@getItem'))->name('zipcode-detail');
    Route::get('new', array('uses' => 'Zipcodenew\ZipcodenewController@newItem'))->name('zipcode-new');
    Route::get('new-ajax', array('uses' => 'Zipcodenew\Ajax\ZipcodenewAjaxController@newItem'))->name('zipcode-new-ajax');
    Route::get('edit/{id}', array('uses' => 'Zipcodenew\Ajax\ZipcodenewAjaxController@editItem'))->name('zipcode-edit');
    Route::delete('remove/{id}', array('uses' => 'Zipcodenew\Ajax\ZipcodenewAjaxController@remove'))->name('zipcode-remove');
    Route::post('save/{id}', array('uses' => 'Zipcodenew\Ajax\ZipcodenewAjaxController@save'))->name('zipcode-save');
});

Route::group(['prefix' => 'admin/acl'], function () {
    Route::resource('users', 'Admin\Acl\UserController');
    Route::post('users-list', 'Admin\Acl\UserController@items')->name('users.list');
    Route::delete('users-list', 'Admin\Acl\UserController@destroyItems')->name('users.delete.items');
    Route::resource('permissions', 'Admin\Acl\PermissionController');
    Route::post('permissions-list', 'Admin\Acl\PermissionController@items')->name('permissions.list');
    Route::resource('groups', 'Admin\Acl\GroupController');
    Route::post('group-list', 'Admin\Acl\GroupController@items')->name('groups.list');
    Route::resource('roles', 'Admin\Acl\RoleController');
    Route::post('role-list', 'Admin\Acl\RoleController@items')->name('roles.list');
});

Route::group(['prefix' => 'admin/purchase'], function () {
    Route::resource('socials', 'Admin\Purchase\SocialController');
    Route::post('socials-list', 'Admin\Purchase\SocialController@items')->name('socials.list');
    Route::delete('socials-list', 'Admin\Purchase\SocialController@destroyItems')->name('socials.delete.items');
    Route::resource('purchase-categories', 'Admin\Purchase\CategoryController');
    Route::post('purchase-categories-list', 'Admin\Purchase\CategoryController@items')->name('purchase-categories.list');
    Route::delete('purchase-categories-list', 'Admin\Purchase\CategoryController@destroyItems')->name('purchase-categories.delete.items');
    Route::resource('products', 'Admin\Purchase\ProductController');
    Route::post('products-list', 'Admin\Purchase\ProductController@items')->name('products.list');
    Route::delete('products-list', 'Admin\Purchase\ProductController@destroyItems')->name('products.delete.items');
    
    Route::get('products-facebook-token', 'Admin\Purchase\ProductController@facebookToken')->name('facebook-token');
    Route::get('products-facebook-callback', 'Admin\Purchase\ProductController@facebookCallback')->name('facebook-callback');
});

//Upload file
Route::post('ajax-upload-image/{folder}/{name}', 'Admin\UploadController@storeMulti')->name('ajax-upload-image');
Route::post('ajax-destroy-image/{folder}/{name}', 'Admin\UploadController@destroy')->name('ajax-destroy-image');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('dashboard');
Route::get('admin/backup', 'Admin\BackupController@index')->name('backup');

Route::get('glide/{path}', function($path){
    $server = \League\Glide\ServerFactory::create([
        'source' => app('filesystem')->disk('public')->getDriver(),
    'cache' => storage_path('glide'),
    ]);
    return $server->getImageResponse($path, Input::query());
})->where('path', '.+');