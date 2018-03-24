@extends('layouts.admin')

@section('body')
</head>
    <body class="login-bg">
    <div class="login">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @if(is_object($errors))
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @else
                    <li>{{ $errors }}</li>
                @endif
            </ul>
        </div>
    @endif
        <div class="message">x-admin2.0-管理登录</div>  
        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form" action="{{ url('admin/dologin') }}">
            {{ csrf_field() }}
            <input name="username" placeholder="用户名" value="{{old('username')}}" type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="验证码"  type="text" class="layui-input" style="width:150px;height:40px">
            <img src="{{ url('/admin/code')}}" onclick="this.src='{{ url('/admin/code') }}?'+Math.random()" alt=""style="width:150px;float:right;position:relative;top:-43px;left:0px">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script type="text/javascript">
        function re_captcha() {
            $url = "{{ URL('/code/captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('123456').src = $url;
        }
    </script>




    <script>

        // $(function  () {
        //     layui.use('form', function(){
        //         var form = layui.form;
        //         // layer.msg('玩命卖萌中', function(){
        //         //   //关闭后的操作
        //         //   });
        //         //监听提交
        //         form.on('submit(login)', function(data){
        //             // alert(888)
        //             layer.msg(JSON.stringify(data.field),function(){
        //                 location.href='index.html'
        //             });
        //             return false;
        //         });
        //     });
        // })


    </script>


    <!-- 底部结束 -->
    <script>
        //百度统计可去掉
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    </body>
@endsection