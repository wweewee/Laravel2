<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keeper;
use Illuminate\Support\Facades\Crypt;
use App\Model\Permission;
use Illuminate\Support\Facades\DB;
use App\Model\Role;


class KeeperController extends Controller
{
    //返回角色授权页面
    public function auth($id)
    {
        //根据ID获取用户
        $keeper = Keeper::find($id);
        //获取所有的角色
        $roles = Role::get();
        //获取当前用户已经被授予的角色
        $own_roles = $keeper->role;
//        dd($own_roles);
        //当前用户拥有的角色的ID列表
        $own_roleids = [];
        foreach ($own_roles as $v){
            $own_roleids[] = $v->id;
        }
        return view('admin.keeper.auth',compact('keeper','roles','own_roleids'));
    }
    //处理角色授权
    public function doAuth(Request $request)
    {
        $input = $request->all();
//        dd($input);
        DB::beginTransaction();
        try{
            //要执行的sql语句
            //删除当前角色被赋予的所有权限
            DB::table('keeper_role')->delete();
            if(!empty($input['role_id'])){
                //将提交的数据添加到 角色权限关联表
                foreach ($input['role_id'] as $v){
                    DB::table('keeper_role')->insert([
                        'keeper_id'=>$input['keeper_id'],
                        'role_id'=>$v
                    ]);
                }
            }
            DB::commit();
            return redirect('admin/keeper');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 管理员列表页面
    public function index(Request $request)
    {

        // 多条件并分页
        $keeper = Keeper::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('keywords3');
                $id = $request->input('keywords4');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('username','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($id)) {
                    $query->where('id','like','%'.$id.'%');
                }
            })
            ->paginate($request->input('num', 5));
            $shuju = Keeper::count('*');
        return view('admin.keeper.list',['shuju'=>$shuju,'keeper'=>$keeper, 'request'=> $request]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 添加管理员
    public function create()
    {

        return view('admin.keeper.add');
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
        $res = Keeper::create(['username'=>$input['username'],'password'=>$input['pass']]);


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

//        json_encode($arr);
//        return response()->json($arr);

        return $arr;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 管理员修改
    public function edit($id)
    {
        $keeper = Keeper::findOrFail($id);
        // dd($keeper);
        return view('admin.keeper.edit',compact('keeper'));
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
        $keeper = Keeper::find($id);
       // 3. 将用户的属性改成提交过来的值
        $res = $keeper->update(['username'=>$username]);
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
    // 修改密码
    public function editpass($id)
    {
        $keeper = Keeper::findOrFail($id);

        return view('admin.keeper.editpass',compact('keeper'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keeper = Keeper::find($id);
        $res = $keeper->delete();
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
        $kid = $request->input('id');
        //用户的状态
        $status =  ($request->input('status') == 1)? 0:1;
        //修改状态
        $keeper = Keeper::find($kid);
        $res = $keeper->update(['status'=>$status]);
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
//        return $ids;
//        删除ids里存储的用户的id对应的用户
        $res = Keeper::destroy($ids);
        $res = $keeper->delete();
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
