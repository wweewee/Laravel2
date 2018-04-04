<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>商品添加</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
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
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane" action="/admin/index">
          <input class="layui-input" placeholder="分类名" name="goods">
          <button class="layui-btn"  onclick="x_admin_show('搜索','{{url ('admin/goods/') }}')"><i class="layui-icon">搜索</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>删除</button>
        <button class="layui-btn"  lay-submit="" lay-filter="sreach" onclick="x_admin_show('添加','{{url ('admin/goods/create') }}')"><i class="layui-icon"></i>增加</button>

        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;全选</i></div>
            </th>
            <th>ID</th>
            <th>商品类别</th>
            <th>图片</th>
            <th>商品名</th>
            <th>金额</th>
            <th>库存</th>
            <th>描述</th>
            <th>详情</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($goods as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->did}}</td>
            <td>{{$v->cid}}</td>
            <td><img src="{{$v->fileupload}}" alt=""></td>
            <td>{{$v->gname}}</td>
            <td>{{$v->money}}</td>
            <td>{{$v->number}}</td>
            <td>{{$v->depict}}</td>
            <td>{{$v->content}}</td>
            <td class="td-manage">
              <a title="修改"  onclick="x_admin_show('修改','{{url ('admin/goods/'.$v->did.'/edit') }}')" style="cursor:pointer">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="member_del(this,{{ $v->did }})" style="cursor:pointer">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{$goods->links()}}
        </div>
      </div>

    </div>
    <script>
      // layui.use('laydate', function(){
      //   var laydate = layui.laydate;
        
      //   //执行一个laydate实例
      //   laydate.render({
      //     elem: '#start' //指定元素
      //   });

      //   //执行一个laydate实例
      //   laydate.render({
      //     elem: '#end' //指定元素
      //   });
      // });

      layui.use('layer',function(){
        var layer = layui.layer;
      })

       /*用户-停用*/
      // function member_stop(obj,id){
      //     layer.confirm('确认要停用吗？',function(index){

      //         if($(obj).attr('title')=='启用'){

      //           //发异步把用户状态进行更改
      //           $(obj).attr('title','停用')
      //           $(obj).find('i').html('&#xe62f;');

      //           $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
      //           layer.msg('已停用!',{icon: 5,time:1000});

      //         }else{
      //           $(obj).attr('title','启用')
      //           $(obj).find('i').html('&#xe601;');

      //           $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
      //           layer.msg('已启用!',{icon: 5,time:1000});
      //         }
              
      //     });
      // }

      /*用户-删除*/
      function member_del(obj,did){
          layer.confirm('确认要删除吗？',function(index){
            // $.post('请求路径','携带的参数','执行成功后的返回结果')
            $.post("{{url('admin/goods/')}}/"+did,{'_token':"{{csrf_token()}}",'_method':'delete'},function(data){
              //如果删除成功
              if(data.status == 0){
                 $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                  }else{
                    layer.msg('删除失败!',{icon:1,time:1000});
                }
              
            });
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

</html>
