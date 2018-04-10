<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>修改活动信息</title>
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
        <form class="layui-form" action="{{ url('/admin/activity/update') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}



            <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                            <span class="x-red"></span>ID
                        </label>

                        <input type="text" name="id" readonly="readonly" value="{{ $data->id }}" style="width:200px" class="layui-input" />
                        <span class="x-red" ></span>
                        {{--<img src="/uploads/{{ $data->img }}" width="100" />--}}

                </div>
            <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                            <span class="x-red"></span>缩略图

                        </label>

                        <span class="x-red"></span>
                        <input id="file_upload" name="img"  type="file" multiple="true" >
                        <br>
                        <!-- <img src="/uploads/{{ $data->img }}" alt="" id="file_upload_img" value="{{ $data->img }}" style="max-width: 350px; max-height:100px;"> -->
                        <span class="x-red" style="color:red;">缩略图大小不能大于350×100</span>
            </div>

            <div class="layui-form-item">
                <label for="desc" class="layui-form-label">
                    <span class="x-red"></span>名称(描述)
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="desc" name="name" value="{{ $data->name }}" required="" lay-verify="required"
                    autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red"></span>
                </div>
            </div>
                    <div class="layui-form-item">
                        <label for="desc" class="layui-form-label">
                            <span class="x-red"></span>排序
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="desc" name="sort" value="{{ $data->id }}" required="" lay-verify="required"
                                    autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span>
                        </div>
                    </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    更改
                </button>
            </div>
        </form>
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