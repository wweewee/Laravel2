<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>
            悦桔拉拉
        </title>
        <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet"
        type="text/css" />
        <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet"
        type="text/css" />
        <link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css"
        />
        <link href="/home/css/hmstyle.css" rel="stylesheet" type="text/css" />
        <link href="/home/css/skin.css" rel="stylesheet" type="text/css" />
        <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js">
        </script>
        <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js">
        </script>
    </head>
    
    <body>
        <div class="hmtop">
            <!--顶部导航条 -->
            @include('home.inherit.header')
            <div class="banner">
                <!--轮播 -->
                <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
                    <ul class="am-slides">
                        <li class="banner1">
                            <a href="introduction.html">
                                <img src="/home/images/ad1.jpg" />
                            </a>
                        </li>
                        <li class="banner2">
                            <a>
                                <img src="/home/images/ad2.jpg" />
                            </a>
                        </li>
                        <li class="banner3">
                            <a>
                                <img src="/home/images/ad3.jpg" />
                            </a>
                        </li>
                        <li class="banner4">
                            <a>
                                <img src="/home/images/ad4.jpg" />
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clear">
                </div>
            </div>
            <div class="shopNav">
                <div class="slideall">
                    @include('home.inherit.nav')
                    <!--侧边导航 -->
                    <div id="nav" class="navfull">
                        <div class="area clearfix">
                            <div class="category-content" id="guide_2">
                                <div class="category">
                                    <ul class="category-list" id="js_climit_li">
                                    @foreach($cate_one as $v)
                                        <li class="appliance js_toggle relative">
                                       
                                            <div class="category-info">
                                                <h3 class="category-name b-category-name" style="cursor:pointer;">
                                                    <i>
                                                        <img src="/home/images/tea.png">
                                                    </i>
                                                    <a class="ml-22" title="" href="/home/list/{{$v->id}}">
                                                       {{$v->name}}
                                                    </a>
                                                </h3>
                                                <em> 
                                                    &gt;
                                                </em>
                                            </div>
                                            
                                            <div class="menu-item menu-in top">
                                                <div class="area-in">
                                                    <div class="area-bg">
                                                        <div class="menu-srot">
                                                            <div class="sort-side">
                                                                <dl class="dl-sort">
                                                                @foreach($arr[$v->name] as $m=>$n)
                                                                    <dd>
                                                                        <a title="" href="/home/list/{{$n['id']}}" style="cursor:pointer;">
                                                                            <span>
                                                                            {{$n['name']}}
                                                                            </span>
                                                                        </a>
                                                                
                                                                    </dd>      
                                                                     @endforeach                                                            
                                                                                                                               
                                                                </dl>                                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                           
                                            <b class="arrow">
                                            </b>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--轮播-->
                    <script type="text/javascript">
                        (function() {
                            $('.am-slider').flexslider();
                        });
                        $(document).ready(function() {
                            $("li").hover(function() {
                                $(".category-content .category-list li.first .menu-in").css("display", "none");
                                $(".category-content .category-list li.first").removeClass("hover");
                                $(this).addClass("hover");
                                $(this).children("div.menu-in").css("display", "block")
                            },function() {
                                $(this).removeClass("hover")
                                $(this).children("div.menu-in").css("display", "none")
                            });
                        })
                    </script>
                   
                    <!--小导航 -->
                    <div class="am-g am-g-fixed smallnav">
                        <div class="am-u-sm-3">
                            <a href="sort.html">
                                <img src="/home/images/navsmall.jpg" />
                                <div class="title">
                                    商品分类
                                </div>
                            </a>
                        </div>
                        <div class="am-u-sm-3">
                            <a href="#">
                                <img src="/home/images/huismall.jpg" />
                                <div class="title">
                                    大聚惠
                                </div>
                            </a>
                        </div>
                        <div class="am-u-sm-3">
                            <a href="#">
                                <img src="/home/images/mansmall.jpg" />
                                <div class="title">
                                    个人中心
                                </div>
                            </a>
                        </div>
                        <div class="am-u-sm-3">
                            <a href="#">
                                <img src="/home/images/moneysmall.jpg" />
                                <div class="title">
                                    投资理财
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--走马灯 -->
                    <div class="marqueen">
                        <span class="marqueen-title">
                            商城头条
                        </span>
                        <div class="demo">
                            <ul>
                                <li class="title-first">
                                    <a target="_blank" href="#">
                                        <img src="/home/images/TJ2.jpg">
                                        </img>
                                        <span>
                                            [特惠]
                                        </span>
                                        商城爆品1分秒
                                    </a>
                                </li>
                                <li class="title-first">
                                    <a target="_blank" href="#">
                                        <span>
                                            [公告]
                                        </span>
                                        商城与广州市签署战略合作协议
                                        <img src="/home/images/TJ.jpg">
                                        </img>
                                        <p>
                                            XXXXXXXXXXXXXXXXXX
                                        </p>
                                    </a>
                                </li>
                                <div class="mod-vip">
                                    <div class="m-baseinfo">
                                        <a href="../person/index.html">
                                            <img src="/home/images/getAvatar.do.jpg">
                                        </a>
                                        <em>
                                            Hi,
                                            <span class="s-name">
                                                小叮当
                                            </span>
                                            <a href="#">
                                                <p>
                                                    点击更多优惠活动
                                                </p>
                                            </a>
                                        </em>
                                    </div>
                                    <div class="member-logout">
                                        <a class="am-btn-warning btn" href="login.html">
                                            登录
                                        </a>
                                        <a class="am-btn-warning btn" href="register.html">
                                            注册
                                        </a>
                                    </div>
                                    <div class="member-login">
                                        <a href="#">
                                            <strong>
                                                0
                                            </strong>
                                            待收货
                                        </a>
                                        <a href="#">
                                            <strong>
                                                0
                                            </strong>
                                            待发货
                                        </a>
                                        <a href="#">
                                            <strong>
                                                0
                                            </strong>
                                            待付款
                                        </a>
                                        <a href="#">
                                            <strong>
                                                0
                                            </strong>
                                            待评价
                                        </a>
                                    </div>
                                    <div class="clear">
                                    </div>
                                </div>
                                <li>
                                    <a target="_blank" href="#">
                                        <span>
                                            [特惠]
                                        </span>
                                        洋河年末大促，低至两件五折
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        <span>
                                            [公告]
                                        </span>
                                        华北、华中部分地区配送延迟
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        <span>
                                            [特惠]
                                        </span>
                                        家电狂欢千亿礼券 买1送1！
                                    </a>
                                </li>
                            </ul>
                            <div class="advTip">
                                <img src="/home/images/advTip.jpg" />
                            </div>
                        </div>
                    </div>
                    <div class="clear">
                    </div>
                </div>
                <script type="text/javascript">
                    if ($(window).width() < 640) {
                        function autoScroll(obj) {
                            $(obj).find("ul").animate({
                                marginTop: "-39px"
                            },
                            500,
                            function() {
                                $(this).css({
                                    marginTop: "0px"
                                }).find("li:first").appendTo(this);
                            })
                        }
                        $(function() {
                            setInterval('autoScroll(".demo")', 3000);
                        })
                    }
                </script>
            </div>
            <div class="shopMainbg">
                <div class="shopMain" id="shopmain">
                    <!--今日推荐 -->
                    <div class="am-g am-g-fixed recommendation">
                        <div class="clock am-u-sm-3">
                            <img src="/home/images/2016.png ">
                            </img>
                            <p>
                                今日
                                <br>
                                推荐
                            </p>
                        </div>
                        <div class="am-u-sm-4 am-u-lg-3 ">
                            <div class="info ">
                                <h3>
                                    真的有鱼
                                </h3>
                                <h4>
                                    开年福利篇
                                </h4>
                            </div>
                            <div class="recommendationMain one">
                                <a href="introduction.html">
                                    <img src="/home/images/tj.png ">
                                    </img>
                                </a>
                            </div>
                        </div>
                        <div class="am-u-sm-4 am-u-lg-3 ">
                            <div class="info ">
                                <h3>
                                    囤货过冬
                                </h3>
                                <h4>
                                    让爱早回家
                                </h4>
                            </div>
                            <div class="recommendationMain two">
                                <img src="/home/images/tj1.png ">
                                </img>
                            </div>
                        </div>
                        <div class="am-u-sm-4 am-u-lg-3 ">
                            <div class="info ">
                                <h3>
                                    浪漫情人节
                                </h3>
                                <h4>
                                    甜甜蜜蜜
                                </h4>
                            </div>
                            <div class="recommendationMain three">
                                <img src="/home/images/tj2.png ">
                                </img>
                            </div>
                        </div>
                    </div>
                    <div class="clear ">
                    </div>
                    <!--热门活动 -->
                    <div class="am-container activity ">
                        <div class="shopTitle ">
                            <h4>
                                活动
                            </h4>
                            <h3>
                                每期活动 优惠享不停
                            </h3>
                            <span class="more ">
                                <a href="# ">
                                    全部活动
                                    <i class="am-icon-angle-right" style="padding-left:10px ;">
                                    </i>
                                </a>
                            </span>
                        </div>
                        <div class="am-g am-g-fixed ">
                            <div class="am-u-sm-3 ">
                                <div class="icon-sale one ">
                                </div>
                                <h4>
                                    秒杀
                                </h4>
                                <div class="activityMain ">
                                    <img src="/home/images/activity1.jpg ">
                                    </img>
                                </div>
                                <div class="info ">
                                    <h3>
                                        春节送礼优选
                                    </h3>
                                </div>
                            </div>
                            <div class="am-u-sm-3 ">
                                <div class="icon-sale two ">
                                </div>
                                <h4>
                                    特惠
                                </h4>
                                <div class="activityMain ">
                                    <img src="/home/images/activity2.jpg ">
                                    </img>
                                </div>
                                <div class="info ">
                                    <h3>
                                        春节送礼优选
                                    </h3>
                                </div>
                            </div>
                            <div class="am-u-sm-3 ">
                                <div class="icon-sale three ">
                                </div>
                                <h4>
                                    团购
                                </h4>
                                <div class="activityMain ">
                                    <img src="/home/images/activity3.jpg ">
                                    </img>
                                </div>
                                <div class="info ">
                                    <h3>
                                        春节送礼优选
                                    </h3>
                                </div>
                            </div>
                            <div class="am-u-sm-3 last ">
                                <div class="icon-sale ">
                                </div>
                                <h4>
                                    超值
                                </h4>
                                <div class="activityMain ">
                                    <img src="/home/images/activity.jpg ">
                                    </img>
                                </div>
                                <div class="info ">
                                    <h3>
                                        春节送礼优选
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear ">
                    </div>
                    <div id="f1">
                        <!--甜点-->
                        <div class="am-container ">
                            <div class="shopTitle ">
                                <h4>
                                    甜品
                                </h4>
                                <h3>
                                    每一道甜品都有一个故事
                                </h3>
                                <div class="today-brands ">
                                    <a href="# ">
                                        桂花糕
                                    </a>
                                    <a href="# ">
                                        奶皮酥
                                    </a>
                                    <a href="# ">
                                        栗子糕
                                    </a>
                                    <a href="# ">
                                        马卡龙
                                    </a>
                                    <a href="# ">
                                        铜锣烧
                                    </a>
                                    <a href="# ">
                                        豌豆黄
                                    </a>
                                </div>
                                <span class="more ">
                                    <a href="# ">
                                        更多美味
                                        <i class="am-icon-angle-right" style="padding-left:10px ;">
                                        </i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="am-g am-g-fixed floodFour">
                            <div class="am-u-sm-5 am-u-md-4 text-one list ">
                                <div class="word">
                                    <a class="outer" href="#">
                                        <span class="inner">
                                            <b class="text">
                                                核桃
                                            </b>
                                        </span>
                                    </a>
                                    <a class="outer" href="#">
                                        <span class="inner">
                                            <b class="text">
                                                核桃
                                            </b>
                                        </span>
                                    </a>
                                    <a class="outer" href="#">
                                        <span class="inner">
                                            <b class="text">
                                                核桃
                                            </b>
                                        </span>
                                    </a>
                                    <a class="outer" href="#">
                                        <span class="inner">
                                            <b class="text">
                                                核桃
                                            </b>
                                        </span>
                                    </a>
                                    <a class="outer" href="#">
                                        <span class="inner">
                                            <b class="text">
                                                核桃
                                            </b>
                                        </span>
                                    </a>
                                    <a class="outer" href="#">
                                        <span class="inner">
                                            <b class="text">
                                                核桃
                                            </b>
                                        </span>
                                    </a>
                                </div>
                                <a href="# ">
                                    <div class="outer-con ">
                                        <div class="title ">
                                            开抢啦！
                                        </div>
                                        <div class="sub-title ">
                                            零食大礼包
                                        </div>
                                    </div>
                                    <img src="/home/images/act1.png " />
                                </a>
                                <div class="triangle-topright">
                                </div>
                            </div>
                            <div class="am-u-sm-7 am-u-md-4 text-two sug">
                                <div class="outer-con ">
                                    <div class="title ">
                                        雪之恋和风大福
                                    </div>
                                    <div class="sub-title ">
                                        ¥13.8
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate">
                                    </i>
                                </div>
                                <a href="# ">
                                    <img src="/home/images/2.jpg" />
                                </a>
                            </div>
                            <div class="am-u-sm-7 am-u-md-4 text-two">
                                <div class="outer-con ">
                                    <div class="title ">
                                        雪之恋和风大福
                                    </div>
                                    <div class="sub-title ">
                                        ¥13.8
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate">
                                    </i>
                                </div>
                                <a href="# ">
                                    <img src="/home/images/1.jpg" />
                                </a>
                            </div>
                            <div class="am-u-sm-3 am-u-md-2 text-three big">
                                <div class="outer-con ">
                                    <div class="title ">
                                        小优布丁
                                    </div>
                                    <div class="sub-title ">
                                        ¥4.8
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate">
                                    </i>
                                </div>
                                <a href="# ">
                                    <img src="/home/images/5.jpg" />
                                </a>
                            </div>
                            <div class="am-u-sm-3 am-u-md-2 text-three sug">
                                <div class="outer-con ">
                                    <div class="title ">
                                        小优布丁
                                    </div>
                                    <div class="sub-title ">
                                        ¥4.8
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate">
                                    </i>
                                </div>
                                <a href="# ">
                                    <img src="/home/images/3.jpg" />
                                </a>
                            </div>
                            <div class="am-u-sm-3 am-u-md-2 text-three ">
                                <div class="outer-con ">
                                    <div class="title ">
                                        小优布丁
                                    </div>
                                    <div class="sub-title ">
                                        ¥4.8
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate">
                                    </i>
                                </div>
                                <a href="# ">
                                    <img src="/home/images/4.jpg" />
                                </a>
                            </div>
                            <div class="am-u-sm-3 am-u-md-2 text-three last big ">
                                <div class="outer-con ">
                                    <div class="title ">
                                        小优布丁
                                    </div>
                                    <div class="sub-title ">
                                        ¥4.8
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate">
                                    </i>
                                </div>
                                <a href="# ">
                                    <img src="/home/images/5.jpg" />
                                </a>
                            </div>
                        </div>
                        <div class="clear ">
                        </div>
                    </div>
                    <div class="clear ">
                    </div>
                </div>
                <div class="footer ">
                    <div class="footer-hd ">
                        <p>
                            <a href="# ">
                                恒望科技
                            </a>
                            <b>
                                |
                            </b>
                            <a href="# ">
                                商城首页
                            </a>
                            <b>
                                |
                            </b>
                            <a href="# ">
                                支付宝
                            </a>
                            <b>
                                |
                            </b>
                            <a href="# ">
                                物流
                            </a>
                        </p>
                    </div>
                    <div class="footer-bd ">
                        <p>
                            <a href="# ">
                                关于恒望
                            </a>
                            <a href="# ">
                                合作伙伴
                            </a>
                            <a href="# ">
                                联系我们
                            </a>
                            <a href="# ">
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
            <li class="active">
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
                <a href="../person/index.html">
                    <i class="am-icon-user">
                    </i>
                    我的
                </a>
            </li>
        </div>
        <script>
            window.jQuery || document.write('<script src="/home basic/js/jquery.min.js "><\/script>');
        </script>
        <script type="text/javascript " src="/home/basic/js/quick_links.js ">
        </script>
    </body>

</html>