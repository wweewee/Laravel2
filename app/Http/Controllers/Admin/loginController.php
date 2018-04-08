<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Session;
use App\Model\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;


class loginController extends Controller
{
    //后台登录页面
    public function login()
    {
    	return view('admin.login');
    }
    //生成验证码
     public function Code()
    {
    	$code = new Code();
        return $code->make();
    }
    // //生成验证的方法
    public function captcha($tmp)
    {
    	$phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(255, 153, 0);
        $builder->setMaxAngle(35);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 90, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }
    //登录处的逻辑
    public function dologin(Request $request)
    {
    	//1.获取用户数据  除去{{cdrf_field() }}都获取
    	$input = $request->except('_token');
    	//2.对提交的数据进行验证
    	$rule = [
    		'username' => 'required|between:4,10',
    		'password' => 'required|between:4,10'
    	];
    	$msg = [
    		'username.required' => '用户名的能为空', 
    		'username.between' => '字符长度在4-10',
    		'password.required' => '密码不能为空',
    		'password.between' => '密码长度在`4-10'
    	];
    	 //如果要求密码 必须输入、长度在6-18位之间、11位的电话号码
//        'username'=>'required|between:6,18',
//        'username'=>      array('regex:/^13\d{9}$|^14\d{9}$|^15\d{9}$|^17\d{9}$|^18\d{9}$/i'),
//        'username'=>email,
    	$Validator = Validator::make($input,$rule,$msg);
    	if ($Validator->fails()){
    		return redirect('admin/login')
    				->withErrors($Validator)
    				->withInput();
    	}
    	// 3.判断验证码是否正确
    	if(strtolower($input['code']) != strtolower(session()->get('code')) ){
    		return redirect('admin/login')->with('errors','验证码错误');
    	}
    	//4.判断是否有此用户
    	$user = User::where('username',$input['username'])->first();
    	//5.判断密码是否正确
    	if($input['password'] !=Crypt::decrypt($user->password)){
    		return redirect('admin/login')->with('errors','密码错误');
    	}
    	// 6.保存用户到ssssion中(session的操作)
    	Session::put('user',$user);
    	session()->get('user')->usrname;
    	// 7.如果都正确,跳转到首页
    	return redirect('admin/index');
    }
	
	public function jiami()
	{
		$str = '123456';
		//加密
		$cry_str = Crypt::encrypt($str);
		return $cry_str;
		//解密
		$str_crypt = 'eyJpdiI6ImVMWUNBdFRjUlRXa3lqbkE3eUR0Y1E9PSIsInZhbHVlIjoiUkpQVHVwOWszNThTV1NYeERqZjNwQT09IiwibWFjIjoiZmNjYzdiZTUwMDY5ZTMwMDEyNjUxZjVjMjA5ODFiYjZmM2ZmNWQ2ODJhYzdkNzQ4NWMyMDNlMjQwMDZmZTQ5MyJ9';
		return Crypt::decrypt($str_crypt);
	}
    
}
