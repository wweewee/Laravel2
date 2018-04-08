<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Register;
use Illuminate\Support\Facades\Validator;
use Mail;


class RegisterController extends Controller
{
    //显示注册页面
    public function index()
    {
        return view('home.register');
    }

    public function register(Request $request)
    {
        $input = $request->except('_token');
        $input['username'] = $input['email'];

//        生成一个token 为了保证账号的安全性
        $token =  md5(rand(1000,9999).time().uniqid());
//        2.验证密码格式是否正确
           $rule = [
               'email'=>'required',
               'email'=>'regex:/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/',
               'password'=>'required|between:4,10',
               'repassword'=>'required|between:4,10'
           ];

           $msg = [
               'password.required'=>'密码不能为空',
               'password.between'=>'密码必须在4-10位之间',
               'repassword.required'=>'确认密码不能为空',
               'repassword.between'=>'确认密码必须在4-10位之间',
               'email.regex'=>'请填入邮箱'
           ];
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('home/register')
                ->withErrors($validator)
                ->withInput();
        }
        if($input['password'] != $input['repassword']){
            return redirect('home/register')->with('errors','两次密码不一致');
        }
        // 表单数据存入数据库中
//        $register = new Register();
//        $register->email =  $input['email'];
//        $register->password =  $input['password'];
//        $res = $register->save();

        $user = Register::create(['email'=>$input['email'],'password'=>$input['password'],'token'=>$token]);
//       $user = compact($res);
//        dd($user);
        //成功后怎么怎么样 失败怎么怎么样
        if($user){

            $res = Mail::send('email.active',['user'=>$user],function ($m) use ($user){
                //通过什么邮箱服务器发送的
//                $m->from('hello@app.com','Your Application');
                $m->to($user->email,$user->username)->subject('账号激活邮件');
            });

            return redirect('home/Login')->with('errors','请去邮箱激活账号');

        }else{
            return redirect('home/register');
        };

    }

    public function active(Request $request)
    {
        $input = $request->all();
        //根据传过来的用户id获取用户
//        dd($input);die;
        $user = Register::findOrFail($input['id']);
//        dd($user);die;
        if(!$user){
            return '无此用户';
        }
        //1. 先验证token的有效性
        if($input['token'] != $user->token){
            return '无链接为无效链接';
        }

        //2. 激活用户
        $res = $user->update(['active'=>1]);
        if($res){
            return redirect('home/Login');
        }else{
            return '账号激活失败，请重新注册';
        }


    }


}
