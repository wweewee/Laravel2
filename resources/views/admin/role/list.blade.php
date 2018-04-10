@extends('layouts.admin')

@section('body')
<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
  <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
  <div class="layui-row">

  </div>
  <xblock>
    <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
    <button class="layui-btn" onclick="x_admin_show('添加角色','{{ url('admin/user/create') }}',600,400)"><i class="layui-icon"></i>添加</button>
    <span class="x-right" style="line-height:40px">共有数据：88 条</span>
  </xblock>
  <table class="layui-table">
    <thead>
    <tr>

      <th>ID</th>
      <th>角色名称</th>
      <th>权限描述</th>
      <th>操作</th></tr>
    </thead>
    <tbody>

    @foreach($role as $v)
      <tr>
        <td>{{ $v->id }}</td>
        <td>{{ $v->role_name }}</td>
        <td>{{ $v->role_description }}</td>
        <td class="td-manage">
          <a  href="{{ url('admin/role/auth/'.$v->id) }}"  title="授权">
            <i class="layui-icon">&#xe601;</i>
          </a>
          <a title="编辑"  onclick="x_admin_show('编辑','{{  url('admin/role/'.$v->id.'/edit') }}',600,400)" href="javascript:;">
            <i class="layui-icon">&#xe642;</i>
          </a>

          <a title="删除" onclick="member_del(this,{{ $v->id }})" href="javascript:;">
            <i class="layui-icon">&#xe640;</i>
          </a>
        </td>
      </tr>

    @endforeach
    </tbody>
  </table>
  <div class="page">
  </div>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });


    // 修改用户排序
    // @param obj 当前文本框元素
    // @cateid 当前分类的
    function changeOrder(obj,cateid){
        // 获取当前文本框的值
        var cate_order = $(obj).val();

        $.post('/admin/role/changeorder',{"_token":"{{ csrf_token() }}","id":cateid,"cate_order":cate_order},function (data) {
            console.log(data);

            if(data.status == 0){
                layer.msg(data.msg,{icon:6,time:1000});
                //刷新页面
                window.location.reload(true);
            }else{
                layer.msg(data.msg,{icon:5,time:1000});
            }
        })
    }

    /*用户-停用*/
    
    /*用户-删除*/
    function member_del(obj,id){
        //
        layer.confirm('确认要删除吗？',function(index){
            // $.post('请求的路径','携带的参数'，执行成功后的返回结果)
            $.post("{{ url('admin/role/') }}/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function(data){
                //如果删除成功
                if(data.status == 0){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败!',{icon:1,time:1000});
                }
            });
        });
    }
    function delAll () {
        //声明一个空数组，存放所有被选中的复选框的data-id属性值
        var ids = [];
        //获取所有的被选中的复选框
        $('.layui-form-checked').not('.header').each(function(i,v){
            ids.push($(v).attr('data-id'));
        });
        $.get('/admin/role/delall',{"ids":ids},function(data){
            //后台如果删除成功，在前台上也把相关记录删除掉
            if(data.status == 0){
                layer.msg('删除成功', {icon: 1});
                $(".layui-form-checked").not('.header').parents('tr').remove();
            }else{
                layer.msg('删除失败', {icon: 2});
            }
        })
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>
@endsection