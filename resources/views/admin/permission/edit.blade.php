@extends('layouts.admin')

@section('body')
  
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <input type="hidden" name="_method" value="PUT">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>权限名
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="{{ $per->per_name }}" id="L_username" name="pername" required="" lay-verify=""
                  autocomplete="off" class="layui-input">
              </div>
              <input type="hidden" name="id" value="{{ $per->id }}">
          </div>
          <div class="layui-form-item">
              <input type="hidden" name="_method" value="PUT">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>权限路由
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="{{ $per->per_url }}" id="L_username" name="perurl" required="" lay-verify=""
                  autocomplete="off" class="layui-input">
              </div>
              <input type="hidden" name="userid" value="{{ $per->id }}">
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
            // nikename: function(value){
            //   if(value.length < 5){
            //     return '昵称至少得5个字符啊';
            //   }
            // }
            // ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            // ,repass: function(value){
            //     if($('#L_pass').val()!=$('#L_repass').val()){
            //         return '两次密码不一致';
            //     }
            // }
          });

          //监听提交
          form.on('submit(edit)', function(data){

              //获取当前要修改的用户的id
              var uid = $("input[type='hidden']").val();
              console.log(uid);
              $.ajax({
                  type: "POST",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: "/admin/permission/"+uid,
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




            // console.log(data);
            //发异步，把数据提交给php
            // layer.alert("增加成功", {icon: 6},function () {
            //     // 获得frame索引
            //     var index = parent.layer.getFrameIndex(window.name);
            //     //关闭当前frame
            //     parent.layer.close(index);
            // });
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