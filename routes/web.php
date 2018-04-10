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



