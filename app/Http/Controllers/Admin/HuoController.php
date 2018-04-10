<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Huo;
use DB;
class HuoController extends Controller
{
    public function index()
    {
        $data = \DB::table('admin_activity')->OrderBy('sort', 'asc')->get();
        return view('admin.activity.list', ['data' => $data]);
//
    }
    public function add()
    {

        return view('admin.activity.add');
    }
    public function insert(Request $request)

    {
        $data = $request->except('_token', 'token');
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            if ($file->isValid()) {
                //处理//获取图片扩展名
                $ext = $file->getClientOriginalExtension();

                // dd($ext);}
                $filename = time() . mt_rand(1000, 99999) . '.' . $ext;
                $res = $file->move('./uploads', $filename);
                if ($res) {
                    $data['img'] = $filename;
                } else {
                    $data['img'] = 'default.jpg';
                }
            } else {
                $data['img'] = 'default.jpg';
            }
        } else {
            $data['img'] = 'default.jpg';
        }
        //时间
        $time = date('Y-m-d H:i:s', time());
        $data['created_at'] = $time;
        $data['updated_at'] = $time;

//        dd($data);
        $res1 = DB::table('admin_activity')->insert($data);

        if ($res1) {
            $data = [

                'message' => '删除成功'
            ];
            return redirect('/admin/activity/index')->with(['info' => '添加成功']);
        } else {
            return back()->with(['info' => '添加失败']);
        }
//         dd($data);
//        return view('');
    }
    public function delete($id)
    {
//        return 1111;
        $res = \DB::table('admin_activity')->where('id',$id)->delete();
//        $res = \DB::table('admin_activity')->where('id',$id)->select();
//       dd($res);
//        $res = Huo::find($id)->delete($id);
//        $res = Huo::find($id) -> delete();
//        dd($res);
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '删除成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '删除失败'
            ];
        }
        return $data;
    }

    public function edit($id)
    {
        //1 通过传过来的id获取到要修改的用户记录
        $data = \DB::table('admin_activity')->find($id);
//        dd($data);

        return view('admin.activity.edit',compact('data'));

    }
    public function changeOrder(Request $request)
    {
//       排序的业务逻辑

        $input = $request->except('_token');

        // 找到要修改排序的那条记录
        $cate = Huo::find($input['id']);


//        修改这条记录的排序值为传过来的排序值
        $res = $cate->update(['sort'=>$input['cate_order']]);

        //判断是否修改成功
        if($res){
            $data = [
                'status'=>0,
                'msg'=>"排序修改成功"
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>"排序修改失败"
            ];
        }
        return $data;
    }
    public function update(Request $request)
    {

        $data = $request->except('_token','token');
//        dd($data);
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            if($file->isValid()){
                //处理//获取图片扩展名
                $ext =  $file->getClientOriginalExtension();

                // dd($ext);}
                $filename = time().mt_rand(1000,99999).'.'.$ext;
                $res = $file->move('./uploads',$filename);
                if($res)
                {
                    $data['img'] = $filename;
                }else{
                    $data['img'] = 'default.jpg';
                }
            }else{
                $data['img'] = 'default.jpg';
            }
        }else{
            unset($data['img']);
        }
        //时间
        $time = date('Y-m-d H:i:s',time());
        $data['created_at'] = $time;
        $data['updated_at'] = $time;
//dd($data);
        $id = $data['id'];

        unset($data['id']);

        $res1 = \DB::table('admin_activity')->where('id',$id)->update($data);

        if($res1)
        {
            return redirect('/admin/activity/index')->with(['info'=>'更新成功']);
        }else{
            return back()->with(['info'=>'更新失败']);
        }
    }
}
