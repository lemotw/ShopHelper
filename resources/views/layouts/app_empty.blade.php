<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link rel="shortcut icon" type="image/png" href="./images/favicon.png" /> -->

    <title> @yield('page_title') </title>

    <!-- ootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">

    <!-- 下拉選單 CSS -->
    <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet"> 
    <link href="{{ asset('icomoon/style.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
@media (max-width:767px){
    .iconfont-size{
        font-size:90px
    }
}
@media (min-width:768px) and (max-width:991px){
    .iconfont-size{
        font-size:200px
    }
}

@media (min-width:992px) and (max-width:1199px){
    .iconfont-size{
        font-size:170px
    }
}
@media (min-width:1200px){
    .iconfont-size{
        font-size:140px
    }
}

.li-icon
{
    margin-right:20px;
}
</style>

<body>

    <!-- <div id="wrapper"> -->
<!--
MENU START
-->
        <!-- <div id="sidebar-wrapper">
            <ul class="sidebar-nav" id="side-menu">
                <li class="sidebar-brand">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-home home-icon"></i>HOME
                    </a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-file-invoice-dollar li-icon"></i>營業日報表</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-chart-line li-icon"></i>當日商品統計</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-chart-pie li-icon"></i>商品銷售統計</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-book li-icon"></i>銷售明細查詢</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-file-invoice li-icon"></i>發票明細查詢</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-id-badge li-icon"></i>員工出勤查詢</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-stopwatch li-icon"></i>時段分析</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-fw fa-paper-plane li-icon"></i>離開</a>
                </li>

 -->
                <!-- <li>
                    <a href=""><i class="fas fa-user-cog home-icon"></i>使用者維護</a>
                </li>
                <li>
                    <a href=""><i class="fas fa-store-alt home-icon"></i>店家維護</a>
                </li> -->
 
                <!-- 
                <li>
                    <a href="#"><span class="icon-icon2-01 sidebar-icon"></span>噪音監測<span class="fa arrow"></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="noise_environment.php" class="sidebar-subproject">環境噪音</a>
                        </li>
                        <li>
                            <a href="noise_traffic.php" class="sidebar-subproject">交通噪音</a>
                        </li>
                    </ul>
                </li>
                -->
            <!-- </ul>
        </div> -->
<!--
MENU END
-->


<!--
PAGE CONTENT START
-->      
        

        <div id="page-content-wrapper">

<!-- HEADER -->

            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="col-lg-12 ">
                    <a href="#menu-toggle" class="btn btn-default-mune" id="menu-toggle">
                        <span class="icon-munebar-index">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                        </span>
                        <SPAN class="topbar-icon-word">Menu</SPAN>
                    </a>
                    <div class="top-link">
                        @if(Auth::check())
                        <a href="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
                        @endif
                        <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right">
                            <a href="http://127.0.0.1:8080/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a> 
                            <form id="logout-form" action="http://127.0.0.1:8080/logout" method="POST" style="display: none;">@csrf</form>
                        </div>
                        <a class="btn-sitemap" href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </div>
                </div>
            </nav>

<!-- HEADER END -->

<!-- CONTENT -->

@yield('content')

<!-- CONTENT END -->

<!-- FOOTER -->

            <footer class=" footer ">
                <div class="footer-box">
	                <span class="footer-cobyright">
	                	<strong>COPYRIGHT2019 &copy; All Rights Reserved.</strong>
	                </span>
            	</div>

                <div class="btn back-to-top" data-scroll-to-target="body"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></div>
            </footer>

<!-- FOOTER END -->
        </div>
<!-- PAGE CONTENT END -->      
    </div>

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/Chart.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>