@extends('layouts.admin')

@section('body')
  
  <body>
    <div class="x-body">
        <form enctype="multipart/form-data" id="art_form" class="layui-form" action="{{ url('admin/permission') }}" method="post">
          {{ csrf_field() }}
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>权限名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="per_name" required="" lay-verify=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>权限对应路由
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="per_url" required="" lay-verify=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
          //监听提交
          form.on('submit(add)', function(data){
              $.ajax({
                  type: "POST",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-field"]').attr('content')
                  },
                  url: "/admin/permission",
                  data: data.field,
                  dataType: "json",
                  success: function(data){
                      // 如果添加成功
                        if(data.status == 0){
                            layer.alert(data.msg,function(){
                                //关闭弹层，刷新父页面
                                parent.location.reload(true);
                            })
                        }else{
                            layer.alert(data.msg,function(){
                                //关闭弹层，刷新父页面
                                parent.location.reload(true);
                            })
                        }
                  }
              });
            return false;
          }); 
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>
@endsection