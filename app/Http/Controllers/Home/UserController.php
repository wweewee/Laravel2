<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;


class UserController extends Controller
{
    // 个人中心
    public function personal()
    {
        return view('home.user.personal');
    }

    // 个人信息页面
    public function userinfo()
    {
        return view('home.user.userinfo');
    }

    // 完善个人信息
    public function userinfo_create(Request $request)
    {
       
    }
    
   
    // 实验
    public function introduction()
    {
        return view('home.goods.introduction');
    }
    public function pay()
    {
        return view('home.goods.pay');
    }
    public function success()
    {
        return view('home.goods.success');
    }
    public function shopcart()
    {
        return view('home.cart.shopcart');
    }
    public function search()
    {
        return view('home.goods.search');
    }
    public function address()
    {
        return view('home.user.address');
    }
    public function safety()
    {
        return view('home.user.safety');
    }
} 
