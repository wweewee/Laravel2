<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>活动列表</title>
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
            <a class="layui-btn" href="{{ url('admin/activity/add') }}"> 添加活动</a>
            <span class="x-right" style="line-height:40px">共有数据：{{count($data)}}条</span>
        </xblock>
        <table class="layui-table">
            <form action="{{ url('/admin/activity/insert') }}" method="post"  class="layui-form xbs" enctype="multipart/form-data">
                {{ csrf_field() }}
                <thead>
                    <tr>

                        <th>
                            ID
                        </th>
                        <th>
                            缩略图
                        </th>

                        <th>
                            名称(可描述)
                        </th>
                        <th>
                            排序
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                @foreach($data as $item)
                <tbody id="x-img">
                    <tr>
                        <td>
                            {{  $item->id  }}
                        </td>
                        <td>
                            <img  src="/uploads/{{ $item->img }}" width="200" alt="">
                        </td>

                        <td >
                            {{ $item->name }}
                        </td>
                        <td >
                            <input type="text" name="sort" onchange="changeOrder(this,{{ $item->id }})" value="{{ $item->sort }}" size="20" class="layui-input" />
                        </td>
                       
                        <td class="td-manage">  
                            <a title="编辑" href="{{ url('admin/activity/edit/'.$item->id) }}"
                            class="ml-5" style="text-decoration:none">

                                <i class="layui-icon">&#xe642;</i> 修改
                            </a>
                            <a title="删除" href="javascript:;" onclick="banner_del({{ $item->id }})"
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>删除
                            </a>

                        </td>
                    </tr>
                </tbody>
                @endforeach
            </form>
        </table>
    </div>
    <!-- <script>
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
    -->
    <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入

                layer.ready(function(){ //为了layer.ext.js加载完毕再执行
                  layer.photos({
                    photos: '#x-img'
                    //,shift: 5 //0-6的选择，指定弹出图片动画类型，默认随机
                  });
                }); 
              
            });

            function changeOrder(obj,id){
//            获取当前文本框的值
                var v = $(obj).val();
//            $.post('路由','参数','执行后的返回结果')
                $.post('{{ url('/admin/activity/changeorder') }}',{'_token':"{{ csrf_token() }}",'id':id,'cate_order':v},function(data){
//                console.log(data);
                    if(data.status == 0){
//                    如果修改成功，给用户一个修改成功的提示，然后刷新页面
                        layer.msg(data.msg);
                        // console.log(241);

                        setTimeout(function(){
                            window.location.href = location.href;
                        },1000);
                    }else{
                        layer.msg(data.msg);
                    }
                })
            }


           /*添加*/
            function banner_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

            /*删除*/
            function banner_del(id){
                layer.confirm('您确定要删除吗？',{
                    btn:['确定','取消']
                }, function(){
                    //向服务器发送ajax请求，删除当前id对应的用户数据
                    //$.post('请求的路由','携带的参数','处理成功后的返回结果')
                    $.post('{{ url('admin/activity/delete') }}/'+id,{'_token':"{{ csrf_token() }}"},function (data){
                        if(data.status == 0){
                            layer.msg(data.message,{icon:6});
                            setTimeout(function(){
                                window.location.href = location.href;
                            },1000);
                        }else{
                            layer.msg(data.message,{icon:5});
                            setTimeout(function(){
                                window.location.href = location.href;
                            },1000);
                        }
                    })
                })}
            </script>
  </body>

</html>