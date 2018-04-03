<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
class GoodsController extends Controller
{
    // 商品列表
    public function list()
    {
        $res = Goods::get();
        // dd($res);
        return view('home.goods.list', compact('res'));
    }

    // 商品详情
    public function details($id)
    {   

        $data = Goods::where('did',$id)->get();
        
        return view('home.goods.introduction',compact('data'));
        
    }
}
