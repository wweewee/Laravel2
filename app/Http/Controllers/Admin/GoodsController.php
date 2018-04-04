<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Goods;
use App\Model\Admin\Cate;
use Session;

class GoodsController extends Controller
{
     //文件上传
    public function upload(Request $request)
    {   
        
        $file = $request->file('fileupload');
        //判断如果是有效的文件上传
        if($file->isValid()){
            //获取文件类型`(后缀名)
            $ext = $file->getClientOriginalExtension();    //文件拓展名
//            生成新文件名
            $newfile = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
            //1.将文件传到本地服务器上
            $path = $file->move(public_path().'/uploads',$newfile);

            $newfile = '/uploads/'.$newfile;


            //2.返回上传文件路径
            return $newfile;

        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $goods = Goods::all();
        // dd($goods);

        //商品列表
        
        //分页显示数据
        $goods = Goods::paginate(5);
        return view('admin.goods.index',compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::all();
        $cate = Cate::Cates($cate);
//        dd($cate);
        //添加商品
        return view('admin.goods.add',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //接受添加
        $input = $request->all();      //1.获取表单添加的数据
        $goods = new Goods();
         // return($input);
        //2.添加到数据表              
        // $goods -> gname = $input['gname'];   
        // $goods -> money = $input['money'];
        // $res->$goods->save();         
        //方法二
        $res = Goods::create([
            'money'=>$input['money'],
            'fileupload'=>$input['fileupload'],
            'number'=>$input['number'],
            'content'=>$input['content'],
            'depict'=>$input['depict'],
            'gname'=>$input['gname'],
            'cid'=>$input['cid']
            ]);

        // dd($res);
        //判断是否添加成功
        if($res){
            // return redirect('admin/goods')->with('msg','添加成功');
            $arr = [
                'status'=>0,
                'msg'=>'添加成功了'
            ];
        }else{
            $arr = [
            'status'=>1,
            'msg'=>'添加失败'
            ];
        }
       return $arr; 
        // return redirect('admin/goods/');
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
        $cate = Cate::all();
        $cate = Cate::Cates($cate);
//        dd($cate);
        //添加商品
        // return view('admin.goods.edit',compact('cate'));
        //通过id查询单条数据
        $goods = Goods::findOrFail($id);
        // dd($goods);
        return view('admin.goods.edit',compact('goods','cate'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$did)
    {   
            

        //接受修改

        // 1.获取提交的数据
        $goods = $request->input();
       
        // 2.根据id找到要修改的内容的商品
        $comm = Goods::find($did);
        
        // 3.  将商品属性改成提交过来的值
        $res = $comm->update([
            'money'=>$goods['money'],
            'fileupload'=>$goods['fileupload'],
            'number'=>$goods['number'],
            'content'=>$goods['content'],
            'depict'=>$goods['depict'],
            'gname'=>$goods['gname'],
            'cid'=>$goods['cid']
            ]);

        //4.如果修改完成后,返回成功信息或失败信息
        if($res){
            $arr=[
            'status'=>0,
            'msg'=>'修改成功'
            ];
        }else{
            $arr=[
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
    public function destroy($did)
    {
        //删除商品
        $res = Goods::destroy($did);
        //
       
        if($res){
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
}
