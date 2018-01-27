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

// 管理员登录后台
Route::get('admin/login', 'Admin\AdminerLoginController@create')->name('admin.login');
Route::post('admin/login', 'Admin\AdminerLoginController@checkAdminer')->name('admin.checkAdminer');

// 管理员后台登录
Route::group(['middleware'=>'checkAdminer'], function () {
  Route::get('admin/dashboard', 'Admin\AdminerLoginController@dashboard')->name('admin.dashboard');
  Route::get('admin/dashbard/index', 'Admin\AdminerLoginController@index')->name('admin.dashbard.index');
  Route::get('admin/logout', 'Admin\AdminerLoginController@logout')->name('admin.logout');
  Route::get('adminers/{adminer}', 'Admin\AdminersController@show')->name('adminers.show');
  Route::get('adminers/{adminer}/edit', 'Admin\AdminersController@edit')->name('adminers.edit');
  Route::patch('adminers/{adminer}', 'Admin\AdminersController@update')->name('adminers.update');
  Route::get('adminers/{adminer}/changepassword', 'Admin\AdminersController@updatePassword')->name('adminers.update.password');
  Route::post('adminers/{adminer}/changepassword', 'Admin\AdminersController@updatePasswordaction')->name('adminers.update.passwordaction');
  Route::get('admin/coupons/create', 'Admin\CouponsController@create')->name('admin.coupons.create');
  Route::get('admin/coupons/delete/show', 'Admin\CouponsController@deleteShow')->name('admin.coupons.delete.show');
});
