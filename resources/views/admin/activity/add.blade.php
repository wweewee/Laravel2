<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>添加活动</title>
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
    <form class="layui-form" action="{{ url('/admin/activity/insert') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{--<table width="300px" border="0" cellpadding="20" cellspacing="30" >--}}



                <div class="layui-form-item">
                        <label for="desc" class="layui-form-label">
                                <span class="x-red"></span>缩略图
                                
                            </label>
                    <input id="file_upload" name="img" type="file" multiple="true">
                    <span class="x-red" style="color:red;">缩略图大小不能大于350×100</span>
                    <br>
                        <img src="" alt="" id="file_upload_img" style="max-width: 350px; max-height:100px;">
                </div>


                <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                        <span class="x-red"></span>活动描述
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="desc" name="name" required="" lay-verify="required"
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
                                <input type="text" id="desc" name="sort" required="" lay-verify="required"
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
                        增加
                    </button>
                </div>
            </form>
    </div>
    <script type="text/javascript">
           $("#file_upload").change(function () {
            uploadImage();
            });
            function uploadImage() {
            // alert('')判断是否有选择上传文件
            var imgPath = $("#file_upload").val();
            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'png' && strExtension != 'bmp' && strExtension == '') {
                alert("请选择图片文件");
                return;
            }

            //只将文件上传表单项的内容放入formData对象
            var formData = new FormData();
            formData.append('file_upload', $('#file_upload')[0].files[0]);
            formData.append('_token', '{{csrf_token()}}');

            $.ajax({
                type: "POST",
                url: "/admin/file/upload",
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
//                    console.log(data);
                    $('#file_upload_img').attr('src',data);
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }
        </script>
   
  </body>

</html>