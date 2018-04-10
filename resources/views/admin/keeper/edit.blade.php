@extends('layouts.admin')

@section('body')
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>管理员
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="{{ $keeper->username }}" id="L_username" name="username" required="" lay-verify=""
                  autocomplete="off" class="layui-input">
              </div>
              <input type="hidden" name="userid" value="{{ $keeper->id }}">
          </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="edit" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
          });
          //监听提交
          form.on('submit(edit)', function(data){
              //获取当前要修改的用户的id
              var uid = $("input[type='hidden']").val();
              console.log(uid);
              $.ajax({
                  type: "PUT",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: "/admin/keeper/"+uid,
                  data: data.field,
                  dataType: "json",
                  success: function(data){
                      // 如果添加成功
                        if(data.status == 0){
                            layer.alert(data.msg,{icon:6,time:2000},function(){
                                //关闭弹层，刷新父页面
                                parent.location.reload(true);
                            })
                        }else{
                            layer.alert(data.msg,{icon:6,time:2000},function(){
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