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

    <link rel="shortcut icon" type="image/png" href="../images/favicon.png" />

    <title>{{ env('APP_NAME') }} Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">

    <!-- 下拉選單 CSS -->
    <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('icomoon/style.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper wrapper_login">

<!--
PAGE CONTENT START
-->      
        <div id="page-content-wrapper">

<!-- HEADER -->

            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="col-lg-12 ">
                    <div class="login-munebar-index">Login</div>
                    <div class="top-link">
                        <a class="btn-sitemap" href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </div>
                </div>
            </nav>

<!-- HEADER END -->

<!-- CONTENT -->

            <div class="container-fluid">
                <div class="row heading-row-up">
                    <div class="col-lg-12 heading-row-title">
                        <h1>{{ env('APP_NAME') }}</h1>
                        <h5>POS機資料系統</h5>
                    </div>
                </div>
                <div class="row heading-row-down">
                    <div class="col-md-8"></div>
                    <div class="col-md-4"></div>
                </div>

                @yield('content')

           </div>

<!-- CONTENT END -->

<!-- FOOTER -->

            <footer class=" footer ">
                <div class="footer-box">
	                <span class="footer-cobyright">
	                	<strong>COPYRIGHT2019 &copy; All Rights Reserved.</strong>
	                </span>
	                <span class="footer-chineseword"></span>
	                <a class="" href="" target="_blank"></a>
            	</div>

                <div class="btn back-to-top" data-scroll-to-target="body"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></div>
            </footer>

<!-- FOOTER END -->
        </div>
<!--
PAGE CONTENT END
-->      
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/Chart.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>