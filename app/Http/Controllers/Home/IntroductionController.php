<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ShopCart;


class IntroductionController extends Controller
{
    //显示单件商品页
    public function index()
    {


       $cart = ShopCart::find(33);
//     dd($cart);

     return view('/home/introduction',compact('cart'));
    }



}
