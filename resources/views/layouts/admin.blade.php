<?php
//use app\Http\Controllers\Auth\AuthController;
if(Auth::check()){
    $user = Auth::user();
}else{
    $user = null;
}
?>
<!DOCTYPE html>
<html>
<head>


    <meta charset="UTF-8">
    <title>معماری پایدار | @yield('location')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{ asset('resources/dist/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/dist/css/bootstrap-rtl.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('resources/dist/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('resources/dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('resources/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/dist/fonts/fonts-fa.css') }}">





@yield('css')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">پنل</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">پنل مدیریت سایت</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('resources/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $user->name ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('resources/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                <p>
                                    <?php
                                        echo $user->name;
                                    ?>
                                </p>
                                <p><?php
                                        $role =  $user->role;
                                        if($role == 'admin'){
                                            echo '<small>مدیریت</small>';
                                        }else{
                                            echo '<small>کاربر</small>';
                                        }
                                    ?></p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">خروج</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="{{ asset('resources/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $user->name; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                </div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">منوی اصلی</li>
                <li>
                    <a href="{{ url('admin') }}">
                        <i class="fa fa-dashboard"></i> <span>پیشخوان</span>
                    </a>
                </li>



                <li>
                    <a href="{{ url('admin/pages') }}">
                        <i class="fa fa-book"></i> <span>صفحات جانبی</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/cat') }}">
                        <i class="fa fa-code-fork"></i> <span>دسته بندی</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/cm') }}">
                        <i class="fa fa-comments"></i> <span>آگهی ها</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/users') }}">
                        <i class="fa fa-user"></i> <span>کاربران</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/newsletter') }}">
                        <i class="fa fa-send-o"></i> <span>مدیریت و ارسال خبرنامه</span>
                    </a>
                </li>



                @yield('sidebar_menu')
                <li>
                    <a href="{{ url('logout') }}">
                        <i class="fa fa-power-off"></i> <span>خروج</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                پیشخوان
                <small>پنل مدیریت</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php
                                echo App\Project::count();
                                ?></h3>
                            <p>آگهی</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-code"></i>
                        </div>

                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php
                                echo App\User::count();
                                ?></h3>
                            <p>کاربر </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php
                                echo '000'
                                ?></h3>
                            <p>بازدید امروز </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-ticket"></i>
                        </div>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo App\News::count(); ?></h3>
                            <p>آگهی امروز</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- Main_content -->
            <div class="row">
                @yield('content')
            </div>
            <!-- ./Main_content -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('resources/dist/js/jQuery-2.1.4.min.js') }}"></script>

    <!-- Bootstrap 3.3.4 -->
    <script src="{{ asset('resources/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('resources/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('resources/dist/js/demo.js') }}"></script>




@yield('js')
</body>
</html>
