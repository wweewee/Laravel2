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
        <form class="layui-form layui-col-md12 x-so" action="/admin/keeper" method="get">
          <div class="layui-input-inline">
      {{ csrf_field() }}
          <select name="num">
            <option value="5"
                    @if($request['num'] == 5)  selected  @endif
            >5
            </option>
            <option value="10"
                    @if($request['num'] == 10)  selected  @endif
            >10
            </option>
          </select>
          </div>
          <input type="text" name="keywords3" value="{{$request->keywords3}}" placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <input type="text" name="keywords4" value="{{$request->keywords4}}" placeholder="请输入ID" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加管理员','{{ url('admin/keeper/create') }}',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{ $shuju }}条</span>
      </xblock>
      <meta name="csrf-token" content="{{ csrf_token() }}"> 
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>管理员名称</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($keeper as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{ $v->id }}</td>
            <td>{{ $v->username }}</td>
            <td class="td-status">
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
            <td class="td-manage">
              <a onclick="member_stop(this,{{ $v->id }})" href="javascript:;" status="{{ $v->status }}"  title="停用">
                <i class="layui-icon">&#xe601;</i>
              </a>
              <a title="编辑"  onclick="x_admin_show('编辑','{{ url('admin/keeper/edit/'.$v->id) }}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a  href="{{ url('admin/keeper/auth/'.$v->id) }}"  title="授权">
                <i class="layui-icon">&#xe631;</i>
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
        {!! $keeper->appends($request->all())->render() !!}
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
       function member_stop(obj,id){
          //获取要改变状态的用户的id
          //获取当前改变用户的状态
          var status = $(obj).attr('status');
              if($(obj).attr('title')=='停用'){
              layer.confirm('确认要停用吗？',function(index){
                  $.ajax({
                      type: "POST",
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url: "/admin/keeper/changestatus",
                      data: {'id':id,'status':status},
                      dataType: "json",
                      success: function(data){
                          //发异步把用户状态进行更改
                          $(obj).attr('title','启用')
                          $(obj).find('i').html('&#xe62f;');
                          $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                          layer.msg('已停用!',{icon: 5,time:1000});
                      }
                  });
                });
              }else if($(obj).attr('title')=='启用'){
                layer.confirm('确认要启用吗？',function(index){
                  $.ajax({
                      type: "POST",
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url: "/admin/keeper/changestatus",
                      data: {'id':id,'status':status},
                      dataType: "json",
                      success: function(data){
                          //发异步把用户状态进行更改
                          $(obj).attr('title','停用')
                          $(obj).find('i').html('&#xe601;');
                          $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                          layer.msg('已启用!',{icon: 6,time:1000});
                      }
                  }); 
                });
                
              }
         
      }
      /*用户-删除*/
      function member_del(obj,id){
          //询问框 
            layer.confirm('您确定要删除吗？', function(){
                //向服务器发送ajax请求，删除当前id对应的用户数据
//                $.post('请求的路由','携带的参数','处理成功后的返回结果')
                $.post("{{ url('admin/keeper/') }}/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function (data) {
//                    data就是服务器返回的json数据
                   // console.log(data);
                      if(data.status == 0){
                        layer.msg('删除失败',{icon:2});
                        setTimeout(function(){
                            window.location.href = location.href;
                        },5000);
                    }else{
                        layer.msg('删除成功',{icon:1});
                        window.location.href = location.href;
                      }
                  })
                },function(){
             });
          }
          
      function delAll (argument) {
        //声明一个空数组，存放所有被选中的复选框的data-id属性值
          var ids = [];
        //获取所有的被选中的复选框
          $('.layui-form-checked').not('.header').each(function(i,v){
              ids.push($(v).attr('data-id'));
          });
          // console.log(ids);
          $.get('/admin/keeper/delall',{"ids":ids},function(data){
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