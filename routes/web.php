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
Route::group(['middleware'=>'checkAdminer', 'prefix'=>'admin'], function () {
  Route::get('dashboard', 'Admin\AdminerLoginController@dashboard')->name('admin.dashboard');
  Route::get('dashbard/index', 'Admin\AdminerLoginController@index')->name('admin.dashbard.index');
  Route::get('logout', 'Admin\AdminerLoginController@logout')->name('admin.logout');

  Route::get('adminers/{adminer}', 'Admin\AdminersController@show')->name('adminers.show');
  Route::get('adminers/{adminer}/edit', 'Admin\AdminersController@edit')->name('adminers.edit');
  Route::patch('adminers/{adminer}', 'Admin\AdminersController@update')->name('adminers.update');
  Route::get('adminers/{adminer}/changepassword', 'Admin\AdminersController@updatePassword')->name('adminers.update.password');
  Route::post('adminers/{adminer}/changepassword', 'Admin\AdminersController@updatePasswordaction')->name('adminers.update.passwordaction');

  Route::get('coupons/create', 'Admin\CouponsController@create')->name('admin.coupons.create');
  Route::post('copons/create/excel', 'Admin\CouponsController@storeExcel')->name('admin.coupons.storeExcel')->middleware('CheckCouponExcel');
  Route::get('coupons/delete/show', 'Admin\CouponsController@deleteShow')->name('admin.coupons.delete.show');
  Route::post('coupons/delete/all', 'Admin\CouponsController@deleteAll')->name('admin.coupons.delete.all');
  Route::post('coupons/delete/fromdatetodate', 'Admin\CouponsController@deleteFromDateToDate')->name('admin.coupons.delete.fromdatetodate');
  Route::get('coupons', 'Admin\CouponsController@index')->name('admin.coupons.index');
  Route::post('coupons/delete/byids', 'Admin\CouponsController@deleteByIds')->name('admin.coupons.deleteByIds');
  Route::post('coupons/recommend/byids', 'Admin\CouponsController@recommendByIds')->name('admin.coupons.recommendByIds');
  Route::post('coupons/notrecommend/byids', 'Admin\CouponsController@notRecommendByIds')->name('admin.coupons.notRecommendByIds');
  Route::post('coupons/show/byids', 'Admin\CouponsController@showByIds')->name('admin.coupons.showByIds');
  Route::post('coupons/notshow/byids', 'Admin\CouponsController@notShowByIds')->name('admin.coupons.notShowByIds');
  Route::get('coupons/delete/{id}', 'Admin\CouponsController@deleteById')->name('admin.coupons.deleteById')->where('id', '[0-9]+');
  Route::get('coupons/recommend/{id}', 'Admin\CouponsController@recommendById')->name('admin.coupons.recommendById')->where('id', '[0-9]+');
  Route::get('coupons/notrecommend/{id}', 'Admin\CouponsController@notRecommendById')->name('admin.coupons.notRecommendById')->where('id', '[0-9]+');
  Route::get('coupons/show/{id}', 'Admin\CouponsController@showById')->name('admin.coupons.showById')->where('id', '[0-9]+');
  Route::get('coupons/notshow/{id}', 'Admin\CouponsController@notShowById')->name('admin.coupons.notShowById')->where('id', '[0-9]+');

  Route::get('couponCategorys/delete/{id}', 'Admin\CouponCategorysController@delete')->name('couponCategorys.delete')->where('id', '[0-9]+');
  Route::post('couponCategorys/deleteMany/', 'Admin\CouponCategorysController@deleteMany')->name('couponCategorys.deleteMany');
  Route::get('couponCategorys/isshow/{id}', 'Admin\CouponCategorysController@isShow')->name('couponCategorys.isShow')->where('id', '[0-9]+');
  Route::get('couponCategorys/notshow/{id}', 'Admin\CouponCategorysController@notShow')->name('couponCategorys.notShow')->where('id', '[0-9]+');
  Route::post('couponCategorys/changeOrder', 'Admin\CouponCategorysController@changeOrder')->name('couponCategorys.changeOrder');
  Route::resource('couponCategorys', 'Admin\CouponCategorysController');

  Route::post('categorys/changeOrder', 'Admin\CategorysController@changeOrder')->name('categorys.changeOrder');
  Route::post('categorys/deleteMany', 'Admin\CategorysController@deleteMany')->name('categorys.deleteMany');
  Route::get('categorys/delete/{id}', 'Admin\CategorysController@deleteById')->name('categorys.deleteById')->where('id', '[0-9]+');
  Route::resource('categorys', 'Admin\CategorysController');

  Route::get('brandCategorys/isShow/{id}', 'Admin\BrandCategorysController@isShow')->name('brandCategorys.isShow')->where('id', '[0-9]+');
  Route::get('brandCategorys/notShow/{id}', 'Admin\BrandCategorysController@notShow')->name('brandCategorys.notShow')->where('id', '[0-9]+');
  Route::get('brandCategorys/delete/{id}', 'Admin\BrandCategorysController@delete')->name('brandCategorys.delete')->where('id', '[0-9]+');
  Route::post('brandCategorys/deleteMany', 'Admin\BrandCategorysController@deleteMany')->name('brandCategorys.deleteMany');
  Route::post('brandCategorys/changeOrder', 'Admin\BrandCategorysController@changeOrder')->name('brandCategorys.changeOrder');
  Route::post('brandCategorys/updateTotalMuti', 'Admin\BrandCategorysController@updateTotalMuti')->name('brandCategorys.updateTotalMuti');
  Route::resource('brandCategorys', 'Admin\BrandCategorysController');

  Route::get('brands/isShow/{id}', 'Admin\BrandsController@isShow')->name('brands.isShow')->where('id', '[0-9]+');
  Route::get('brands/notShow/{id}', 'Admin\BrandsController@notShow')->name('brands.notShow')->where('id', '[0-9]+');
  Route::get('brands/delete/{id}', 'Admin\BrandsController@delete')->name('brands.delete')->where('id', '[0-9]+');
  Route::post('brands/deleteMany', 'Admin\BrandsController@deleteMany')->name('brands.deleteMany');
  Route::post('brands/changeOrder', 'Admin\BrandsController@changeOrder')->name('brands.changeOrder');
  Route::resource('brands', 'Admin\BrandsController');
});
