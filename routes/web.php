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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('dashboard');
