<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Session;
class InformationController extends Controller
{
    //显示页面
    public function inform()
    {
        return view('home.information');
    }
    public function user_inform(Request $request)
    {
        $input = $request->except('_token');
//            dd($input);
        $res = User::create([
            'email'=>$input['email'],
            'nickname'=>$input['nickname'],
            'phone'=>$input['phone'],
            'sex'=>$input['sex'],
            'true-name'=>$input['true-name']
        ]);
        if($res){
            Session::put('intro',$input);
            return redirect('home/information');
        }else{
            return redirect('home/information');
        }

    }

    public function password($email)
    {
        return view('home/password',['email'=>$email]);
    }
    public function dopass(Request $request)
    {

        $data = $request->all();
//        dd($data);
        $res = \DB::table('home_user_register')->where('email',$data['email'])->first();
//        dd($res);
        if($data['password'] != $res->password)
        {
            return back()->with(['errors'=>'原密码输入有误']);
        }

         $this->validate($request,[
             'password' => 'required',
             'newpass' => 'required',
             'repass' => 'required|same:newpass'
         ],[
             'password.required' => '请填写原密码',
             'newpass.required' => '请输入新密码',
             'repass.required' => '请确认密码',
             'repass.same' => '两次输入不一致'
         ]);

            $data = $request->except('_token','repass','password','email');

            $data['newpass'] = $data['newpass'];

            $pass = \DB::table('home_user_register')
                ->where('email',$res->email)
                ->update(['password'=>$data['newpass']]);

              if($pass)
              {
                  return redirect('/home/Login');
              }else{
                  return back()->with(['errors'=>'密码修改失败']);
              }


    }

}
