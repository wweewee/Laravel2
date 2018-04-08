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
     
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="layui-table">
      <tr>
          <th>添加轮播图</th>
          <th><span class="x-right" style="line-height:40px">共有数据：{{count($data)}} 条数据</span>轮播图列表</th>
      </tr>
      <tr>
          <td width="350" valign="top">
              <form action="{{ url('/admin/show/insert') }}" method="post"  class="layui-form xbs" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
                      <tr>
                          <td><b>轮播图名称</b>
                              <input type="text" name="name" value="" size="20" class="layui-input" />
                          </td>
                      </tr>
                      <tr>
                          <td><b>幻灯图片</b>
                              @if (count($errors) > 0)
                                  <div class="layui-icon  alert-danger">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif
                              <input type="file" name="img" class="layui-input" />
                          </td>
                      </tr>

                      <tr>
                          <td><b>排序</b>
                              <input type="text" name="sort" value="" size="20" class="layui-input" />
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <input type="hidden" name="token" value="79db104d" />
                              <input  class="layui-btn" type="submit" value="提交" />
                          </td>
                      </tr>
                  </table>
              </form>
          </td>
          <td valign="top">
              <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
                  <tr>
                      <th width="100">图片</th>
                      <th width="100">轮播图名称</th>

                      <th width="50" align="center">修改排序</th>

                      <th width="80" align="center">操作</th>
                  </tr>
                  @foreach($data as $item)
                      <tr>
                          <td><img src="/uploads/{{ $item->img }}"  width="200px" height="100px" /></td>
                          <td>{{ $item->name }}</td>
                          {{--<td><input type="text" class="layui-input"  value="{{ $item->name }}"></td>--}}
                          <td><input type="text" class="layui-input" onchange="changeOrder(this,{{ $item->id }})" value="{{ $item->sort }}"></td>

                          <td align="center">
                            <a href="{{url('admin/show/edit')}}/{{$item->id}}"><i class="layui-icon">&#xe642;</i> 修改</a>
                            <a href="{{url('admin/show/delete')}}/{{$item->id}}"><i class="layui-icon">&#xe640;</i>删除</a>
                          </td>

                  @endforeach
              </table>
          </td>
      </tr>
  </table>
      
      

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