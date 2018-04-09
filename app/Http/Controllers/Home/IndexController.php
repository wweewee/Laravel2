<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;
use App\Model\Admin\Show;
use App\Model\Admin\Huo;
class IndexController extends Controller
{

    public function index()
    {
        // 获取一级类
        $cate_one = Cate::where('pid', 0)->get();
        // 获取二级类
        $arr = [];
        foreach($cate_one as $k=>$v){
            $two = Cate::where('pid', $v->id)->get();
            foreach($two as $kk=>$vv){
                $two1[$kk] = $vv;
            }
            
            $arr[$v->name] = $two1;
        }
        $res = Show::get();
        $activity = Huo::get();
        return view('home.index.index', compact('cate_one','arr','res','activity'));
    }
}
 