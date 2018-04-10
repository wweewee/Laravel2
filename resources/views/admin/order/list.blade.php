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
        <form class="layui-form layui-col-md12 x-so" action="/admin/order" method="get">
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
          <input type="text" name="keywords1" value="{{$request->keywords1}}" placeholder="请输入姓名" autocomplete="off" class="layui-input">
          <input type="text" name="keywords2" value="{{$request->keywords2}}" placeholder="请输入手机号" autocomplete="off" class="layui-input">
          <input type="text" name="keywords1" value="{{$request->keywords3}}" placeholder="请输入收货地址" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有数据：{{ $shuju }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>用户名</th>
            <th>电话</th>
            <th>收货地址</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($order as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{ $v->oid }}</td>
            <td>{{ $v->name }}</td>
            <td>{{ $v->phone }}</td>
            <td>{{ $v->address }}</td>
            <td class="td-status">
              
            </td>
            <td class="td-manage">
              <a onclick="x_admin_show('订单')" href="javascript:;" status="{{ $v->status }}"  title="订单状态">
                <i class="layui-icon">&#xe601;</i>
              </a>
              <a title="编辑"  onclick="x_admin_show('编辑','{{  url('admin/order/'.$v->oid.'/edit') }}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a onclick="x_admin_show('订单详情',600,400)" title="订单详情" href="javascript:;">
                <i class="layui-icon">&#xe63c;</i>
              </a>
              <a title="删除" onclick="member_del(this,{{ $v->oid }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="page">
        {!! $order->appends($request->all())->render() !!}
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
      
      /*用户-删除*/
      function member_del(obj,id){
          //询问框
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //向服务器发送ajax请求，删除当前id对应的用户数据
//                $.post('请求的路由','携带的参数','处理成功后的返回结果')
                $.post("{{ url('admin/user/') }}/"+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function (data) {
//                    data就是服务器返回的json数据
                   // console.log(data);
                      if(data.status == 0){
                        layer.msg(data.message,{icon:2});
                        setTimeout(function(){
                            window.location.href = location.href;
                        },5000);
                    }else{
                        layer.msg(data.message,{icon:1});
                        window.location.href = location.href;
                      }
                  })
                },function(){
             });
          }
      function delAll (argument) {
        var data = tableCheck.getData();
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
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