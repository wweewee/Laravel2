<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>商品分类列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
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
     
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有数据：{{count($cates)}}条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>  
            <th> 父类ID </th>
            <th> ID </th>
            <th> 商品分类</th>
            <th> 商品 </th>
            <th> 操作</th>
        </thead>
        <tbody>
        @foreach($cates as $k=>$v)
                <tr>
                  <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                  </th>
                  <td>
                    {{$v->pid}}
                  </td>
                  <td >{{ $v->id }}</td>
                  <td >{{ $v->name }}</td>
                  <td >{{ $v->describe }}</td>
                  <td>
                  <a class="layui-btn layui-btn-normal" href="{{ url('admin/cate/'.$v->id.'/edit') }}">修改</a>
                  <a class="layui-btn layui-btn-danger" href="javascript:;" onclick="del({{ $v->id }})">删除</a>
                  </td>
                </tr>
                @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          <a class="prev" href="">&lt;&lt;</a>
          <a class="num" href="">1</a>
          <span class="current">2</span>
          <a class="num" href="">3</a>
          <a class="num" href="">489</a>
          <a class="next" href="">&gt;&gt;</a>
        </div>
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

       function del(id){
            //询问框
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //向服务器发送ajax请求，删除当前id对应的用户数据
//                $.post('请求的路由','携带的参数','处理成功后的返回结果')
                $.get('{{ url('admin/cate/') }}/'+id,{'_token':"{{csrf_token()}}",'_method':'delete'},function (data) {
//                    data就是服务器返回的json数据
                  //  console.log(data);


                     if(data.status == 0){
                        layer.msg(data.message, {icon: 6});
                        setTimeout(function(){
                            window.location.href = location.href;
                        },2000);


                    }else{
                        layer.msg(data.message, {icon: 5});

                        window.location.href = location.href;
                    }

                })

//
            }, function(){

            });
        }
    </script>
   
  </body>

</html>