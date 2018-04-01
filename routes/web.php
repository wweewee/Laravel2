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
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    
    Route::get('index','indexController@index');
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
Route::group(['prefix'=>'home','namespace'=>'Home'/*, 'middleware'=>'islogin' */],function(){

    // 个人中心
    Route::get('personal','UserController@personal');
    
    // 个人信息
    Route::get('userinfo','UserController@userinfo');

    // 完善个人信息
    Route::post('userinfo_create','Home\UserController@userinfo_create');
    // 首页
    Route::get('index','IndexController@index');
    // 商品分类

    Route::get('list','IndexController@list');
	


});



Route::group(['prefix'=>'home','namespace'=>'Home'],function(){

    // 退出登录
    Route::get('logout','IndexController@logout'); 

   

    // 产品分类
    Route::get('goods','ListController@goods');

    // 实验
    Route::get('introduction','UserController@introduction');

    Route::get('pay','UserController@pay');

    Route::get('success','UserController@success');

    Route::get('shopcart','UserController@shopcart');
    Route::get('search','UserController@search');
    Route::get('address','UserController@address');
    Route::get('safety','UserController@safety');
    
});

// 购物车
