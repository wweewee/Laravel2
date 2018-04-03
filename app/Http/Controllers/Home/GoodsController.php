<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
class GoodsController extends Controller
{
    // 
    public function list()
    {
        $res = Goods::get();
        // dd($res);
        return view('home.goods.list', compact('res'));
    }

    public function details($id)
    {   
        
        // 商品列表
        return view('home.goods.introduction',compact('data'));
        
    }
}
