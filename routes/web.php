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
	//轮播图管理
	Route::get('show/index','ShowController@index'); //页面
	Route::post('show/insert','ShowController@insert');  //添加提交
	Route::post('show/changeorder','ShowController@changeorder'); //排序
	Route::get('show/delete/{id}','ShowController@delete');  //删除轮播图
	Route::get('show/edit/{id}','ShowController@edit');  //轮播图页面
	Route::post('show/update','ShowController@update');

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

    // 欢迎页面
    Route::get('welcome','indexController@welcome');
    
    //分类管理模块
    Route::get('cate/create','CateController@create');
    Route::post('cate/store','CateController@store');
    Route::get('cate/index','CateController@index');
    Route::post('cate/changeorder','CateController@changeOrder');
    Route::get('cate/{id}/edit','CateController@edit');
    Route::post('cate/update','CateController@update');
    Route::get('cate/{id}','CateController@del');
});

// 前台部分================================
Route::group(['prefix'=>'home','namespace'=>'Home'/*, 'middleware'=>'islogin' */],function() {
    // 个人中心
    Route::get('personal', 'UserController@personal');
    // 个人信息
    Route::get('userinfo', 'UserController@userinfo');
    // 完善个人信息

    Route::post('userinfo_create','UserController@userinfo_create');

    // 首页
    Route::get('index', 'IndexController@index');
    // 商品分类
    Route::get('list', 'IndexController@list');
	Route::get('list/{id}','GoodsController@list');
	// 轮播图
	Route::get('rotation', 'IndexController@rotation');
    // 详情表
    Route::get('/list/details/{id}','GoodsController@details');

});
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
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



