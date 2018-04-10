<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 用户列表页面
    public function index(Request $request)
    {
        // 多条件并分页
        $user = User::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('keywords1');
                $email = $request->input('keywords2');
                $phone = $request->input('keywords3');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('username','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
                //如果手机号不为空
                if(!empty($phone)) {
                    $query->where('phone','like','%'.$phone.'%');
                }
            })
            ->paginate($request->input('num', 5));
            $renshu = User::count('*');
        return view('admin.user.list',['renshu'=>$renshu,'users'=>$user, 'request'=> $request]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 用户修改
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 1. 获取提交的数据
        $username = $request->input('username');
       // 2. 根据id找到要修改的用户
        $user = User::find($id);
       // 3. 将用户的属性改成提交过来的值
        $res = $user->update(['username'=>$username]);
       // 4. 如果修改成功，返回成功信息；失败就返回失败信息
        if($res){
           // json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $arr; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $res = $user->delete();
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>1,
                'msg'=>'删除成功'
            ];
        }else{
            $arr = [
                'status'=>0,
                'msg'=>'删除失败'
            ];
        }
        return $arr;
    }
    //禁用  启用用户
    public function changestatus(Request $request)
    {
        // return 11111;
        //用户id
        $uid = $request->input('id');
        //用户的状态
        $status =  ($request->input('status') == 1)? 0:1;
        //修改状态
        $user = User::find($uid);
        $res = $user->update(['status'=>$status]);
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $arr;
    }

    //删除所有被选中的用户
    public function delall(Request $request)
    {
        //获取请求参数中，要删除的用户的id
        $ids = $request->input('ids');
       // return $ids;
       // 删除ids里存储的用户的id对应的用户
        $res = User::destroy($ids);
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }
    
}
