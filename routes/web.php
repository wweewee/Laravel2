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

// Route::get('/', function () {
//     return view('welcome');
// });
//=============后台部分================================================
//后台登录---------------------------------
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	//后台登录
	Route::get('/login','loginController@login');
	//生成验证码
	Route::get('/code','loginController@Code');
	//登录处的逻辑
	Route::post('/dologin','loginController@dologin');
	// 第三方组件生成验证码的路由
	Route::get('/code/captcha/{id}','loginController@captcha');
	//加密
	Route::get('/jiami','loginController@jiami');
});
	

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],function(){
	//后台主页
	Route::get('index','indexController@index');
	//后台信息页
    Route::get('info','indexController@info');
	//退出登录
    Route::get('logout','indexController@logout');

	//后台分类模块------------------------------
	Route::post('cate/changeorder','CateController@changeOrder');

	//后台商品模块----------------------------------
	
	Route::post('goods/uploads','GoodsController@upload');
	Route::resource('goods','GoodsController');
});