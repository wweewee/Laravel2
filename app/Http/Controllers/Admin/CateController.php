<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;
use DB;
class CateController extends Controller
{
    //
    public function create()
    {
        //获取一级分类
        $cateone = Cate::where('pid', 0)->get();
        //返回一个分类添加页面

        return view('admin.cate.add', compact('cateone'));
//        return '123';
    }
    public function index()
    {


//        $cates = Cate::all();
//        dd($cates);

//        实例化分类对象

        $cate = new Cate();
//        $cates = $cate->getCate();
        $cates = Cate::all();
//        $cates = DB::table('data_category')->get();
//        $cates = DB::table('data_category')->get();
//        dd($cates);


        return view('admin.cate.list',compact('cates'));
    }

    public function store(Request $request)
    {
//        return 1111;
        //1 获取请求参数数据
        $input = $request->except('_token');
//        dd($input);
        //将数据添加到数据库
        $res = Cate::create($input);

        if ($res) {
            return redirect('admin/cate/index')->with('msg', '添加成功');
        } else {
            return back()->with('msg', '添加失败');
        }

    }
    //修改分类排序
    public function changeOrder(Request $request)
    {
//       排序的业务逻辑

        $input = $request->except('_token');

        // 找到要修改排序的那条记录
        $cate = Cate::find($input['id']);

//        修改这条记录的排序值为传过来的排序值
        $res = $cate->update(['pid'=>$input['pid']]);

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
    public function edit($id)
    {
//        return 1111;
        //1 通过传过来的id获取到要修改的用户记录
        $cate = Cate::find($id);
//        dd($cate);

        return view('admin.cate.edit',['cate'=>$cate]);

    }
    public function update(Request $request)
    {

        $input = $request->only('id', 'name', 'describe');
//        return 1111;
//        dd($input);
//        使用模型修改表记录的两种方法,方法一
        $cate = $request->only('id');
//        dd($cate);
//        $user->user_name = $input['user_name'];

//        $res = $user->save();

////        方法二
        $res = Cate::where('id', $cate)->update($input);
//
        if ($res) {

//          return 111;
            return redirect('admin/cate/index')->with('msg','修改成功');;
//            return redirect('admin/cate')->with('msg','添加成功');
        } else {
            //如果添加失败，返回到修改页
            return back()->with('msg', '修改失败');

        }
    }
    public function del($id)
    {
//        $a = DB::table('data_category')->where('id',$id)->first();
        // dd($id);
        $cate = Cate::find($id);
        $count = Cate::where('pid',$id)->count();
        
        // dd($count);
        if ($count) {
            $data = [
                'status' => 1,
                'message' => '分类下有子类,不能删除'
            ];

            return $data;
        }
            $res = $cate->delete();

            if ($res) {
                // return response()->json(['status'=>1]);
                $data = [
                    'status' => 1,
                    'message' => '删除成功' 
                ];
            } else {
                // return response()->json(['stauts'=>0]);
                $data = [
                    'status' => 0,
                    'message' => '删除失败'
                ];
            }

            return $data;
           
    }
}
