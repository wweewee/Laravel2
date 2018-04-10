<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pers = Permission::get();
        return view('admin.permission.list',compact('pers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. 接受管理员提交的添加信息
        $input = $request->all();
//        3. 将数据添加到数据库
        $res = Permission::create(['per_name'=>$input['per_name'],'per_url'=>$input['per_url']]);

//        4. 根据添加是否成功，进行页面跳转
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'添加失败'
            ];
        }
        return $arr;
    }
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
    public function edit($id)
    {
        $per = Permission::findOrFail($id);
        return view('admin.permission.edit',compact('per'));
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
        $pername = $request->input('pername');
        $perurl = $request->input('perurl');
       // 2. 根据id找到要修改的权限
        $per = Permission::find($id);
       // 3. 将权限的属性改成提交过来的值
        $res = $per->update(['per_name'=>$pername,'per_url'=>$perurl]);
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
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $res = $permission->delete();
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'删除失败'
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
}