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
    Route::group(['prefix' => 'zipcodes'], function () {
        Route::get('', array('uses' => 'Zipcode\ZipcodeController@getList'))->name('zipcode-list');
        Route::post('', array('uses' => 'Zipcode\ZipcodeController@getList'))->name('zipcode-list');
        Route::get('detail/{id}', array('uses' => 'Zipcode\ZipcodeController@getItem'))->name('zipcode-detail');
        Route::get('new', array('uses' => 'Zipcode\ZipcodeController@newItem'))->name('zipcode-new');
        Route::get('edit/{id}', array('uses' => 'Zipcode\ZipcodeController@editItem'))->name('zipcode-edit');
        Route::post('remove/{id}', array('uses' => 'Zipcode\Ajax\ZipcodeAjaxController@remove'))->name('zipcode-remove');
        Route::post('save/{id}', array('uses' => 'Zipcode\Ajax\ZipcodeAjaxController@save'))->name('zipcode-save');
    });
//});
//Auth::routes();
