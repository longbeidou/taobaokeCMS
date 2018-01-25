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
Route::get('admin/login', 'Admin\AdminerLoginController@create')->name('admin.create');
Route::post('admin/login', 'Admin\AdminerLoginController@checkAdminer')->name('admin.checkAdminer');

// 管理员后台登录
Route::group(['middleware'=>'CheckAdminer'], function () {
  Route::get('admin/dashboard', 'Admin\AdminerLoginController@dashboard')->name('admin.dashboard');
});
