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
    <button class="layui-btn" onclick="x_admin_show('添加权限','{{ url('admin/permission/create') }}',600,400)"><i class="layui-icon"></i>添加</button>
    <span class="x-right" style="line-height:40px">共有数据：88 条</span>
  </xblock>
  <table class="layui-table">
    <thead>
    <tr>

      <th>ID</th>
      <th>权限名称</th>
      <th>权限对应路由</th>
      <th>操作</th></tr>
    </thead>
    <tbody>

    @foreach($pers as $v)
      <tr>
        <td>{{ $v->id }}</td>
        <td>{{ $v->per_name }}</td>
        <td>{{ $v->per_url }}</td>
        <td class="td-manage">
          <a onclick="member_stop(this,{{ $v->id }})" href="javascript:;"  title="启用">
            <i class="layui-icon">&#xe601;</i>
          </a>
          <a title="编辑"  onclick="x_admin_show('编辑','{{  url('admin/permission/'.$v->id.'/edit') }}',600,400)" href="javascript:;">
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
        $.post('/admin/cate/changeorder',{"_token":"{{ csrf_token() }}","id":cateid,"cate_order":cate_order},function (data) {
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


    /*用户-删除*/
    function member_del(obj,id){
          //询问框
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //向服务器发送ajax请求，删除当前id对应的用户数据
//                $.post('请求的路由','携带的参数','处理成功后的返回结果')
                $.post("{{ url('admin/permission/') }}/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function (data) {
//                    data就是服务器返回的json数据
                   // console.log(data);
                      if(data.status == 0){
                        layer.msg('删除成功',{icon:6});
                        setTimeout(function(){
                            window.location.href = location.href;
                        });
                    }else{
                        layer.msg('删除失败',{icon:5});
                        window.location.href = location.href;
                      }
                  })
                },function(){
             });
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