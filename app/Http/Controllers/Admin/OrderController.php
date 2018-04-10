<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 多条件并分页
        $order = Order::orderBy('oid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $name = $request->input('keywords1');
                $phone = $request->input('keywords2');
                $address = $request->input('keywords3');
                //如果姓名不为空
                if(!empty($name)) {
                    $query->where('name','like','%'.$name.'%');
                }
                //如果手机号不为空
                if(!empty($phone)) {
                    $query->where('phone','like','%'.$phone.'%');
                }
                //如果收货地址不为空
                if(!empty($address)) {
                    $query->where('address','like','%'.$address.'%');
                }
            })
            ->paginate($request->input('num', 5));
            $shuju = Order::count('*');
        return view('admin.order.list',['shuju'=>$shuju,'order'=>$order, 'request'=> $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.order.add');
    }
    //禁用  启用用户
    public function changestatus(Request $request)
    {
        // return 11111;
        //用户id
        $kid = $request->input('id');
        //用户的状态
        $status =  ($request->input('status') == 1)? 0:1;
        //修改状态
        $keeper = Keeper::find($kid);
        $res = $keeper->update(['status'=>$status]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
