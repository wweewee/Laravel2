<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;


class JieController extends Controller
{
    //显示页面
    public function reorder(Request $request,$did)
    {

        session('cart')

        return view('home.jiesuan');
    }
}
