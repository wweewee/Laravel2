@extends('layouts.admin')

@section('body')
  <body>
    <div class="x-body">


        <form enctype="multipart/form-data" id="art_form" class="layui-form" action="{{ url('admin/role') }}" method="post">
          {{ csrf_field() }}

            <div class="layui-form-item">

                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>角色名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="role_name" required="" lay-verify=""
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
            // return false;
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