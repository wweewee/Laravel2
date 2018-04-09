<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Register;
use Session;

class LoginController extends Controller
{
    //显示登录页面
    public function index()
    {

        return view('home.Login');
    }


    public function doLogin(Request $request)
    {

        $input = $request->except('_token');

//         dd($input);
        //判断是否有此用户

        $user = \DB::table('home_user_register')
            ->where('email',$input['email'])
            ->first();
//    dd($user);

        if(!$user){
            return redirect('home/Login')->with('errors','用户名不存在');
        }



        //判断密码是否正确
        if($input['password'] != $user->password){

            return redirect('home/Login')->with('errors','密码错误');
        }

        //判断账号是否激活
        if($user->active !=1){
            return redirect('home/Login')->with('errors','邮箱未激活');
        }else{
            Session::put('user',$user);
            return redirect('home/index');
        }

    }



    }

