<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>添加商品</title>
    <meta name="renderer" content="webkit">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="x-body">
        <form  action="{{ url('admin/goods/') }}" id="art_form"class="layui-form" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>类别:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="gid" name="gid" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>商品名:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="gname" name="gname" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="money" class="layui-form-label">
                  <span class="x-red">*</span>单价:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="money" name="money" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>库存:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="number" name="number" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>描述:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="depict" name="depict" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>商品详情:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="content" name="content" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>目前销量:
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="salecnt" name="salecnt" required="" lay-verify="text"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          
          <div class="layui-form-item">
                <label for="desc" class="layui-form-label">
                    <span class="x-red">*</span>图片:
                </label>
                <div class="layui-input-inline">
                    <input type="file" id="file_upload" name="fileupload" value="" required="" lay-verify=""
                           autocomplete="off" class="layui-input">
                </div>

                <div>
                    <img src="" id="art_thumb" alt="" width="100" height="100">
                    <input type="hidden" name="art_thumb" value="" >
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $("#file_upload").change(function () {
                        uploadImage();
                    })
                })
                function uploadImage() {
                    //  判断是否有选择上传文件
                    var imgPath = $("#file_upload").val();
                    if (imgPath == "") {
                        alert("请选择上传图片！");
                        return;
                    }
                    //判断上传文件的后缀名
                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                    if (strExtension != 'jpg' && strExtension != 'gif'
                        && strExtension != 'png' && strExtension != 'bmp') {
                        alert("请选择图片文件");
                        return;
                    }
                    // var formData = new FormData($('#art_form')[0]);
                    var formData = new FormData();
                    formData.append('fileupload',$('#file_upload')[0].files[0]);

                    $.ajax({
                        type: "POST",
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/goods/uploads",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            // console.log(data);
                            $('#art_thumb').attr('src',data);
                            $("input[name='art_thumb']").val(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("上传失败，请检查网络后重试");
                        }
                    });
                }
            </script>

              </div>
          </div>
          <!-- 提交 -->
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="add">
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
              headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                url:"/admin/goods",
                type:"POST",
                data:data.field,
                dataType:"json",
                success:function(data){
                       if (data.status == 0) {
                          layer.alert(data.msg, {icon: 6}, function () {
                              parent.location.reload(true);
                          });
                      } else {
                          layer.alert(data.msg, {icon: 6, time: 2000}, function () {
                              parent.location.reload(true);
                          });
                      }
                  
                }
            });
            return false;
          });
           
    </script>

     <script>
    var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>