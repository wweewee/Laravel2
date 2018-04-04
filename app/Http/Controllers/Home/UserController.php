<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Home\Pro;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 个人中心
    public function personal()
    {
        return view('home.user.personal');
    }

    // 个人信息页面
    public function userinfo()
    {
        return view('home.user.userinfo');
    }

    // 完善个人信息
    public function userinfo_create(Request $request)
    {
        $this->validate($request,[
                'name' => 'required',
                'true_name' => 'required',
                'email' => 'required|email'
            ],[
                'name.required' => '请填写昵称',
                'true_name.required' => '请填写姓名',
                'email.required' => '请输入邮箱',
                'email.email' => '请正确填写邮箱'
            ]);
        $userdata = $request->except('_token');
        // dd($userdata);
        if($request->file('avatar')){
//            获取上传图片文件
            $file = $request->file('avatar');

            // 判断上传文件的有效性
            if ($file->isValid()) {

                $entension = $file->getClientOriginalExtension();//上传文件的后缀名

                // 生成新的文件名
                $newName = date('YmdHis') . mt_rand(1000, 9999) . '.' . $entension;
                // 将文件移动到指定位置
                $path = $file->move(public_path() . '/myuploads', $newName);
                // 返回上传文件图片  显示到浏览器上面
                $url = '/myuploads/' . $newName;
                // 把所保存的图片位置放入到字段中去
                $userdata['avatar'] = $url;
                $res = \DB::table('data_user_message')->where('email', $userdata['email'])->update($userdata);

                if ($res) {
                    return view('Home/user/userinfo')->with(['info' => '更新成功']);
                } else {
                    return back()->with(['info' => '添加失败']);
                }
            }else{
                return back()->with(['info'=>'文件上传无效']);
            }
        }else{
                return back()->with(['info'=>'没有文件上传']);
            }
    }
    
   
    // 实验
    public function introduction()
    {
        return view('home.goods.introduction');
    }
    public function pay()
    {
        return view('home.goods.pay');
    }
    public function success()
    {
        return view('home.goods.success');
    }
    public function shopcart()
    {
        return view('home.cart.shopcart');
    }
    public function search()
    {
        return view('home.goods.search');
    }
    public function address()
    {
        return view('home.user.address');
    }
    public function safety()
    {
        return view('home.user.safety');
    }
} 
