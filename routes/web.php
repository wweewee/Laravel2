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

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	// 后台信息页
	Route::get('info','IndexController@info');
 
	// 后台用户模块
	Route::resource('user','UserController');
	Route::post('user/changestatus','UserController@changestatus');
    //删除所有选中的用户
    Route::get('user/delall','UserController@delall');
    
    // 后台订单
    Route::resource('order','OrderController');
 
    // 后台管理员
    Route::resource('keeper','KeeperController');
    Route::get('keeper/auth/{id}','KeeperController@auth');
    Route::post('keeper/doauth','KeeperController@doAuth');
    Route::get('keeper/edit/{id}','KeeperController@edit');
	Route::post('keeper/changestatus','KeeperController@changestatus');
    Route::get('keeper/delall','KeeperController@delall');

    //    给角色授权
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    Route::resource('role','RoleController');


    // 权限模块
    Route::resource('permission','PermissionController');

    //修改密码
    Route::get('keeper/editpass/{id}','KeeperController@editpass');
    // 权限管理
    Route::resource('permission','PermissionController');
});
