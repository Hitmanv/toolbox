<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>TOOLBOX</title>
    <!-- common style-->
    <link href="{{ config('toolbox.asset_path') }}/css/style.css" rel="stylesheet">
    <link href="{{ config('toolbox.asset_path') }}/css/style-responsive.css" rel="stylesheet">
    @yield('css')
</head>
<body class="sticky-header">

<section>
    <div class="sidebar-left">
        <!--responsive view logo start-->
        <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
            <a href="#">
                <i class="fa fa-maxcdn"></i>
                <span class="brand-name">SlickLab</span>
            </a>
        </div>
        <!--responsive view logo end-->

        <div class="sidebar-left-info">
            <!-- visible small devices start-->
            <div class=" search-field">  </div>
            <!-- visible small devices end-->

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked side-navigation">
                <li><a href="#"><i class="fa fa-home"></i> <span>总览</span></a></li>
                <li class="menu-list">
                    <a href=""><i class="fa fa-book"></i>  <span>平台管理</span></a>
                    <ul class="child-list">
                        <li><a href="#">平台列表</a></li>
                        <li><a href="/admin/resource">资源生成</a></li>
                    </ul>
                </li>
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
<!-- body content start-->
    <div class="body-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--logo and logo icon start-->
            <div class="logo dark-logo-bg hidden-xs hidden-sm">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span class="brand-name" style="font-size: 17px;">TOOLBOX</span>
                </a>
            </div>

            <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                </a>
            </div>
            <!--logo and logo icon end-->

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
            <!--toggle button end-->
            <!--right notification start-->
            <div class="right-notification">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle">
                            退出登录
                        </a>
                    </li>
                </ul>
            </div>
            <!--right notification end-->
        </div>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3>
                @yield("page-title")
            </h3>
            <span class="sub-title">@yield('page-sub-title')</span>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
    @yield('content')
    <!--body wrapper end-->


        <!--footer section start-->
        <footer>
            2017 &copy; TOOLBOX.
        </footer>
        <!--footer section end-->
    </div>
    <!-- body content end-->
</section>

</body>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ config('toolbox.asset_path') }}/js/jquery-1.10.2.min.js"></script>
<script src="{{ config('toolbox.asset_path') }}/js/bootstrap.min.js"></script>
<script src="{{ config('toolbox.asset_path') }}/js/scripts.js"></script>
<script src="https://cdn.bootcss.com/vue/2.4.2/vue.min.js"></script>
@yield('script')

</html>
