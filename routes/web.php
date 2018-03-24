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

Route::get('/', function () {
    return view('welcome');
});
//后台部分=================================
	//后台主页
	Route::get('/admin/index','Admin\indexController@index');
	//后台登录
	Route::get('/admin/login','Admin\loginController@login');
	//生成验证码
	Route::get('admin/code','Admin\loginController@Code');
	//登录处的逻辑
	Route::post('admin/dologin','Admin\loginController@dologin');
	// 第三方组件生成验证码的路由
	Route::get('/code/captcha/{id}','Admin\loginController@captcha');
	//加密
	Route::get('/admin/jiami','Admin\loginController@jiami');
