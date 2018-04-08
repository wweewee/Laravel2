<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ShopCart;
use session;

class ShopcartController extends Controller
{
    //显示购物页


    public function shopcart(Request $request,$did)
    {
       $good = ShopCart::find($did);
//        dd($good);
        if(session('cart')){

            $cart = session('cart');
            $cart[$did]= $good;
//            dd($cart);
            session()->put('cart',$cart);

        }else{
            $cart = [];
            $cart[$did]= $good;
            session()->put('cart',$cart);
        }
        return view('home.shopcart',compact('cart'));


    }


    public function del($did)
    {   //删除购物车指定商品
//        $res = ShopCart::destroy($did);
//        session()->forget('cart');
        $cart = session('cart');

        unset($cart[$did]);

        session()->put('cart',$cart);

        $res = session('cart');
//      dd($res);
//         判断删除是否成功
        if($res)
        {
            return redirect('/home/shopcart/{did}');
        }else{
            return redirect('/home/shopcart');

        }


    }
}
