<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Admin\Cate;
class GoodsController extends Controller
{
    // 商品列表
    public function list($id)
    {   
        $cate = Cate::where('pid',$id)->first();
        if(!empty($cate)){
            $cate = Cate::where('pid',$id)->get();
            $res = Goods::whereIn('cid',$cate)->get();
        }else{
            $res = Goods::where('cid',$id)->get();
        }
        
        // dd($cate);
        return view('home.goods.list', compact('res'));
    }

    // 商品详情
    public function details($id)
    {
        $data = Goods::where('did',$id)->get();
        
        return view('home.goods.introduction',compact('data'));
        
    }
}
