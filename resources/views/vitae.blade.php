<!DOCTYPE html>
<html>
<head>
    <title>秦胜坤</title>
    <!--fonts-->
    <link href='http://fonts.useso.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.useso.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic'
          rel='stylesheet' type='text/css'>
    <!--//fonts-->

    <link href="/css/lib/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/css/vitae.css" rel="stylesheet" type="text/css" media="all"/>

    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Kong Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- //for-mobile-apps -->
    <!-- js -->
    <script type="text/javascript" src="{{ URL::asset('/') }}js/vitae/jquery.min.js"></script>
    <!-- js -->

</head>
<body>
<!-- banner -->
<div class="banner" id="home">
    <div class="container">
        <div class="banner-info">
            <div class="banner-left">
                <img src="/img/vitae/qskane_head.jpeg" alt="" style="width: 16em;border-radius:1em;" />
            </div>
            <div class="banner-right">
                <h1>秦胜坤</h1>
                <div class="border"></div>
                <h2>php程序员</h2>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/">企业网站模板</a></div>
<!--about-->
<div class="about text-center" id="about">
    <div class="container">
        <h3>ABOUT ME</h3>
        <div class="strip text-center"><img src="/img/vitae/about.png" alt=" "/></div>
        <p>90后、踏实肯干、有思想、注意细节、完美主义、技术狂热、极客精神，这些词语也许并不一定是
            褒意词，但我要用他们来形容自己，可能会有偏差，至少不会太离谱。
            18个月的从业经验里，有冥思苦想，有豁然开朗，有寝食难安，有责任担当。从第一次在繁杂的项目中
            找到正确的文件，到理解沟通需求设计方案，回头看来时的坎坎坷坷，我知道成长很长，需要我一直前进去往
            没有尽头的尽头。
            我当然不可能属于秒查bug，行云流水的天才程序员，但我至少努力写好注释，逻辑简单，格式清晰，
            顺便让机器正确执行，做普通程序员，脱离平庸类。<br/>
            如果老了，别人问我‘为什么选择软件行业做了一生？’，我大概会毫不犹豫的回答‘因为热爱’。
        </p>
    </div>
</div>
<!--//about-->
<div class="about-back"></div>
<!--my skill-->
<div class="my-skills text-center">
    <div class="container">
        <h3>MY SKILLS</h3>
        <div class="strip text-center"><img src="/img/vitae/skill.png" alt=" "/></div>
        <div class="skill-grids">
            <div class="col-md-2 skills-grid text-center">
                <div class="circle" id="circles-1"></div>

                <p>linux</p>
            </div>
            <div class="col-md-2 skills-grid text-center">
                <div class="circle" id="circles-2"></div>
                <p>Photoshop</p>
            </div>
            <div class="col-md-2 skills-grid text-center">
                <div class="circle" id="circles-3"></div>
                <p>android</p>
            </div>
            <div class="col-md-2 skills-grid text-center">
                <div class="circle" id="circles-4"></div>
                <p>html/css</p>
            </div>
            <div class="col-md-2 skills-grid text-center">
                <div class="circle" id="circles-5"></div>
                <p>javascript</p>
            </div>
            <div class="col-md-2 skills-grid text-center">
                <div class="circle" id="circles-6"></div>
                <p>php</p>
            </div>
            <div class="clearfix"></div>
            <script type="text/javascript" src="{{ URL::asset('/') }}js/vitae/circles.js"></script>
            <script>
                $(document).ready(function () {
                    var colors = [
                        ['#6ed4c0', '#ffffff'], ['#6ed4c0', '#ffffff'], ['#6ed4c0', '#ffffff'], ['#6ed4c0', '#ffffff'], ['#6ed4c0', '#ffffff'], ['#6ed4c0', '#ffffff']
                    ];
                    var percentage = [40, 40, 50, 50, 50, 70];
                    for (var i = 1; i < 7; i++) {
                        var child = document.getElementById('circles-' + i);
                        Circles.create({
                            id: child.id,
                            percentage: percentage[i - 1],
                            radius: 80,
                            width: 10,
                            number: percentage[i - 1],
                            text: '%',
                            colors: colors[i - 1]
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>
<!--//my skill-->
<div class="my-skill-back"></div>
<!--education-->
<div class="education text-center">
    <div class="container">
        <div class="edu-info">
            <h3>EDUCATION</h3>
        </div>
        <div class="strip text-center"><img src="/img/vitae/edu.png" alt=" "/></div>
        <div class="edu-grids">
            <div class="col-md-4 edu-grid">
                <p>2013 - 2014</p><span>放弃</span>
                <img src="/img/vitae/arrow.png" alt=""/>
                <div class="edu-border">
                    <div class="edu-grid-master">
                        <h3>普通高等教育大专</h3>
                        <h4>四川职业技术学院</h4>
                    </div>
                    <div class="edu-grid-info">
                        <h5>
                            汽车相关专业，没有学到实用技能，加之兴趣使然，家庭因素等多方面原因入学一年放弃。
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 edu-grid">
                <p>2015.1 - 2015.5</p><span>完成培训</span>
                <img src="/img/vitae/arrow.png" alt=""/>
                <div class="edu-border">
                    <div class="edu-grid-master">
                        <h3>Android开发初级</h3>
                        <h4>重庆达渝仁IT技能培训中心</h4>
                    </div>
                    <div class="edu-grid-info">
                        <h5>0基础学习Java基础，再继续学习android开发，达到胜任基础开发水平。</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 edu-grid">
                <p>2016.6-今</p><span>在考</span>
                <img src="/img/vitae/arrow.png" alt=""/>
                <div class="edu-border">
                    <div class="edu-grid-master">
                        <h3>成人自考本科</h3>
                        <h4>重庆大学</h4>
                    </div>
                    <div class="edu-grid-info">
                        <h5>
                            学习计算机相关知识，加强基础，为更好的软件提供底层知识支持。
                        </h5>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
<!--//education-->
<div class="strip-border"><p></p></div>
<!--work-->
<div class="work-experience text-center">

    <div class="container">
        <div class="work-info">
            <h3>WORK EXPERIENCE</h3>
        </div>
        <div class="strip text-center"><img src="/img/vitae/work.png" alt=" "/></div>
        <div class="work-grids">
            <div class="col-md-6 w-grid">
                <div class="work-grid">
                    <h3>2015.6 - 2016.1</h3>
                    <div class="work-grid-info">
                        <h4>杭州轩马科技</h4>
                        <h5>Android开发</h5>
                        <p>工作的第一家软件公司，做外包业务。<br/>我主要做界面布局，各种基础事件响应，简单网络交互，本地内容存储，和基础维护。</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 w-grid">
                <div class="work-grid">
                    <h3>2016.2 - 今</h3>
                    <div class="work-grid-info">
                        <h4>重庆宝众电子商务有限公司</h4>
                        <h5>php开发</h5>
                        <p>公司业务：线上多用户商城，线下多端收银系统。
                            <br/>最初一人开发维护，需求量增大后，任4人团队负责人。<br/>
                            主要负责：理解需求，设计实现方案，分配任务，编写核心代码，测试验收。
                        </p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="services-back"></div>





<!--blog-->
<div class="blog" id="blog">
    <div class="container">
        <div class="blog-info text-center">
            <h3>PROJECT</h3>
            <div class="strip text-center"><img src="/img/vitae/blog.png" alt=" "/></div>
        </div>
        <div class="blog-grids">
            <div class="col-md-4 blog-text-info">
                <div class="blog-grid">
                    <a href="../../public/demos/resume/single.html"><img src="/img/vitae/ecmall.png"
                                                                         alt=""/></a>
                    <div class="project-name"><p class="project-title">baozho.com</p>
                        <p>1.1</p></div>
                    <div class="blog-text">
                        <a href="http://www.baozho.com" title="http://www.baozho.com"
                           target="_view">ECMALL多用户商城系统+后台管理系统</a>
                        <div class="stripa"></div>
                        <p>框架：ECMALL;
                            <br/>
                            环境：阿里云wamp;
                            <br/>
                            介绍：<br/>仿淘宝多用户商城系统，开发维护各项功能，主要发展手机端。
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-md-4 blog-text-info">
                <div class="blog-grid">
                    <a href="../../public/demos/resume/single.html"><img src="/img/vitae/shouyinba.png"
                                                                         alt=""/></a>
                    <div class="project-name"><p class="project-title">baozho.com</p>
                        <p>1.2</p></div>
                    <div class="blog-text">
                        <a href="http://www.baozho.com" title="http://www.baozho.com" target="_view">多渠道收银系统</a>
                        <div class="stripa"></div>
                        <p>
                            介绍：<br/>1. 支持微信、支付宝、QQ钱包、百度钱包、京东钱包支付 <a href="/img/vitae/qrcode.jpg" target="_view" class="taste">体验</a>；
                            <br/>
                            2. 先付款，后关注微信公众号，区分用户领取优惠券，再次消费抵用;
                            <br/>
                            3. 商家自行设置优惠券金额,过期等属性;
                            <br/>
                            4. 商家资金智能识别到帐，手续费等交易细节处理;
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 blog-text-info">
                <div class="blog-grid">
                    <a href="../../public/demos/resume/single.html"><img src="/img/vitae/wechat.jpg"
                                                                         alt=""/></a>
                    <div class="project-name"><p class="project-title">baozho.com</p>
                        <p>1.3</p></div>
                    <div class="blog-text">
                        <a href="http://www.baozho.com" title="http://www.baozho.com" target="_view">微信公众号+微信支付服务商</a>
                        <div class="stripa"></div>
                        <p>
                            框架：ECMALL;
                            <br/>
                            环境：阿里云wamp;
                            <br/>
                            介绍：<br/>1. 公众号名称：<a href="/img/vitae/gw.jpg" target="_view" class="taste">宝众商城</a>；
                            <br/>
                            2. 公众号开发相关内容;
                            <br/>
                            3. 转换于服务商模式下使用微信支付;
                        </p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="blog-grids">

            <div class="col-md-4 blog-text-info">
                <div class="blog-grid">
                    <a href="../../public/demos/resume/single.html"><img src="/img/vitae/apple2.jpeg"
                                                                         alt=""/></a>
                    <div class="project-name"><p class="project-title">apple-cq.vip</p>
                        <p>2</p></div>
                    <div class="blog-text">
                        <a href="http://www.apple-cq.vip" title="http://www.apple-cq.vip" target="_view">APPLE设备维修店官网</a>
                        <div class="stripa"></div>
                        <p>
                            框架：Thinkphp 3.2;
                            <br/>
                            环境：亚马逊AWS wamp;
                            <br/>
                            介绍：
                            <br/>
                            1. 独立开发，独立设计界面，交互，实现;
                            <br/>
                            2. 后台管理系统，打印系统;
                            <br/>
                            3. 全站原生JS，未使用JS插件及前端框架;
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 blog-text-info">
                <div class="blog-grid">
                    <a href="../../public/demos/resume/single.html"><img src="/img/vitae/laravel.jpeg"
                                                                         alt=""/></a>
                    <div class="project-name"><p class="project-title">eopark.com</p>
                        <p>3.1</p></div>
                    <div class="blog-text">
                        <a href="http://www.eopark.com" title="http://www.eopark.com" target="_view">互联网资源共享平台</a>
                        <div class="stripa"></div>
                        <p>
                            框架：laravel 5.2;
                            <br/>
                            环境：阿里云lamp;
                            <br/>
                            介绍：<br/>1. 独立开发，目标实现互联网资源的网易云音乐推荐系统+豆瓣电影评分系统；
                            <br/>
                            2. 大量使用AJAX，包括<a href="http://eopark.com/thanksgiving" class="taste" target="_view"
                                             title="http://eopark.com/thanksgiving">图片上传</a>;
                            <br/>
                            3. 资源按<a href="http://eopark.com/resources/48" class="taste" target="_view"
                                     title="http://eopark.com/resources/48">属性筛选</a>
                            <br/>
                            4. 正在学习Python，预实现资源自动抓爬;
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!--//blog-->
<div class="contact-back"></div>
<!--contact-->
<div class="contact" id="contact">
    <div class="container">
        <div class="contact-info text-center">
            <h3>CONTACT</h3>
            <div class="strip text-center"><img src="/img/vitae/con1.png" alt=" "/></div>
        </div>
        <div class="contact-grids">
            <div style="text-align: center">
                <p style="font-size: 20px;font-weight: 600;">Phone : 158 8188 1925</p>
                <p style="font-size: 20px;font-weight: 600;">Email : qskane1@163.com</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--//contact-->
<div class="footer-top"></div>

<!--footer-->
<div class="footer">
    <div class="container">
        <p>{{ config("set.siteBeian") }} | Copyright©{{ date("Y") }} <a
                    href="{{config('set.siteRoot')}}">{{config("set.sitePath")}}</a> All Rights
            Reserved</p>
    </div>
</div>
<!--//footer-->
<!-- here stars scrolling icon -->
<!-- //here ends scrolling icon -->
</body>
</html>