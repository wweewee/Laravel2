<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
    //后台登录页面
    public function login()
    {
    	return view('admin.login');
    }
}
