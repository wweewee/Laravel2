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

    //轮播图管理
    Route::get('show/index','ShowController@index'); //页面
    Route::post('show/insert','ShowController@insert');  //添加提交
    Route::post('show/changeorder','ShowController@changeorder'); //排序
    Route::get('show/delete/{id}','ShowController@delete');  //删除轮播图
    Route::get('show/edit/{id}','ShowController@edit');  //轮播图页面
    Route::post('show/update','ShowController@update');
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

	//


    // 欢迎页面
    Route::get('welcome','indexController@welcome');
    //分类管理模块
    Route::get('cate/create','CateController@create');
    Route::post('cate/store','CateController@store');
    Route::get('cate/index','CateController@index');
    Route::post('cate/changeorder','CateController@changeOrder');
    Route::get('cate/{id}/edit','CateController@edit');
    Route::post('cate/update','CateController@update');
///
    Route::get('cate/{id}','CateController@del');
    //活动
    Route::get('activity/index','HuoController@index'); //页面
    Route::get('activity/add','HuoController@add'); //添加页面
    Route::post('activity/insert','HuoController@insert'); //添加
    Route::post('activity/delete/{id}','HuoController@delete');//删除
    Route::get('activity/edit/{id}','HuoController@edit');  //修改页面
    Route::post('activity/update','HuoController@update'); //修改
    Route::post('activity/changeorder','HuoController@changeorder'); //排序
    Route::post('activity/update','HuoController@update'); //修改广告位
    // 图片上传
    Route::post('file/upload','FileController@upload');
});
// 前台部分================================
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

    Route::get('list/{id}','GoodsController@list');
    // 轮播图
    Route::get('rotation', 'IndexController@rotation');
    // 详情表
    Route::get('/list/details/{id}','GoodsController@details');
    //提交订单
    Route::get('/orders','OrderController@sub');

});
//注册=================================
Route::get('/home/register','Home\RegisterController@index');
Route::post('/home/register','Home\RegisterController@register');
//账号激活
Route::get('/active','Home\RegisterController@active');
//登录
Route::get('/home/Login','Home\LoginController@index');
Route::post('/home/Login','Home\LoginController@doLogin');

//主页
Route::get('/home/index','Home\IndexController@index');
//商品详情页
Route::get('/home/introduction','Home\IntroductionController@index');
//商城购物车
Route::get('/home/shopcart/{did}','Home\ShopcartController@shopcart');
// 删除购物车中的商品
Route::get('/home/del/{did}','Home\ShopcartController@del');
//个人中心
Route::get('/home/information','Home\InformationController@inform');
//完善个人信息
Route::post('/home/infor','Home\InformationController@user_inform');
//修改密码页面
Route::get('/home/password/{email}','Home\InformationController@password');
//修改密码
Route::post('/home/dopass','Home\InformationController@dopass');





