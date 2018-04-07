<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>
            商品列表
        </title>
        <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet"
        type="text/css" />
        <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet"
        type="text/css" />
        <link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css"
        />
        <link href="/home/css/seastyle.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js">
        </script>
        <script type="text/javascript" src="/home/js/script.js">
        </script>
    </head>
    
    <body>
        @include('home.inherit.header')
        <b class="line">
        </b>
        <div class="search">
            <div class="search-list">
                <div class="nav-table">
                    @include('home.inherit.nav')
                </div>
                <div class="am-g am-g-fixed">
                    <div class="am-u-sm-12 am-u-md-12">
                        <div class="theme-popover">
                            <div class="searchAbout">
                                <span class="font-pale">
                                    相关搜索：
                                </span>
                                <a title="坚果" href="#">
                                    坚果
                                </a>
                                <a title="瓜子" href="#">
                                    瓜子
                                </a>
                                <a title="鸡腿" href="#">
                                    豆干
                                </a>
                            </div>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="search-content">
                            <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                                @foreach($res as $v)
                                <li>
                                    <a href="details/{{$v ->did }}">
                                        <div class="i-pic limit"> 
                                            <img src="{{$v->fileupload}}"/>
                                            <p class="title fl">
                                                {{$v -> gname}}
                                            </p>
                                            <p class="price fl">
                                                <b>
                                                    ¥
                                                </b>
                                                <strong>
                                                    {{$v -> money}}
                                                </strong>
                                            </p>
                                            <p class="number fl">
                                                销量
                                                <span>
                                                    {{$v -> salecnt}}
                                                </span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clear">
                        </div>
                        <!--分页 -->
                        <ul class="am-pagination am-pagination-right">
                            <li class="am-disabled">
                                <a href="#">
                                    &laquo;
                                </a>
                            </li>
                            <li class="am-active">
                                <a href="#">
                                    1
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    2
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    3
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    4
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    5
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    &raquo;
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer">
                    <div class="footer-hd">
                        <p>
                            <a href="#">
                                恒望科技
                            </a>
                            <b>
                                |
                            </b>
                            <a href="#">
                                商城首页
                            </a>
                            <b>
                                |
                            </b>
                            <a href="#">
                                支付宝
                            </a>
                            <b>
                                |
                            </b>
                            <a href="#">
                                物流
                            </a>
                        </p>
                    </div>
                    <div class="footer-bd">
                        <p>
                            <a href="#">
                                关于恒望
                            </a>
                            <a href="#">
                                合作伙伴
                            </a>
                            <a href="#">
                                联系我们
                            </a>
                            <a href="#">
                                网站地图
                            </a>
                            <em>
                                © 2015-2025 Hengwang.com 版权所有. 更多模板
                                <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">
                                    模板之家
                                </a>
                                - Collect from
                                <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">
                                    网页模板
                                </a>
                            </em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--引导 -->
        <div class="navCir">
            <li>
                <a href="home.html">
                    <i class="am-icon-home ">
                    </i>
                    首页
                </a>
            </li>
            <li>
                <a href="sort.html">
                    <i class="am-icon-list">
                    </i>
                    分类
                </a>
            </li>
            <li>
                <a href="shopcart.html">
                    <i class="am-icon-shopping-basket">
                    </i>
                    购物车
                </a>
            </li>
            <li>
                <a href="/home/person/index.html">
                    <i class="am-icon-user">
                    </i>
                    我的
                </a>
            </li>
        </div>
        <script>
            window.jQuery || document.write('<script src="basic/js/jquery-1.9.min.js"><\/script>');
        </script>
        <script type="text/javascript" src="/home/basic/js/quick_links.js">
        </script>
        <div class="theme-popover-mask">
        </div>
    </body>

</html>