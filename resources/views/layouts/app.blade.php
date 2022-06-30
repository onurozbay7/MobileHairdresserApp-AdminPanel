<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/mainLogo.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pace.css')}}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mobile Hairdressing</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/material-icons/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/mono-social-icons/monosocialiconsfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/feather-icons/feather.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <style>
        #example_filter input {
            border-radius: 5px;
            border-color: #0dace3;

        }

    </style>
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @yield('header')
</head>

<body class="header-dark sidebar-light sidebar-expand">
<div id="wrapper" class="wrapper">
    <!-- HEADER & TOP NAVIGATION -->
    <nav class="navbar d-print-none">
        <!-- Logo Area -->
        <div class="navbar-header ">
            <a href="/" class="navbar-brand">
                <img class="logo-expand" style="width: 80%;" alt="" src="{{asset('images/logo-collapse.png')}}">
                <img class="logo-collapse" style="width: 80%;" alt="" src="{{asset('images/mainLogo.png')}}">
                <!-- <p>BonVue</p> -->
            </a>
        </div>
        <!-- /.navbar-header -->
        <!-- Left Menu & Sidebar Toggle -->
        <ul class="nav navbar-nav">
            <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
            </li>
        </ul>
        <!-- /.navbar-left -->

        <!-- /.navbar-search -->
        <div class="spacer"></div>
        <!-- Button: Create New -->

        <!-- /.btn-list -->
        <!-- User Image with Dropdown -->
        <ul class="nav navbar-nav">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><span class="avatar thumb-xs2"><img src="{{ \App\Models\Worker::getPhoto() }}" class="rounded-circle" alt=""> <i class="feather feather-chevron-down list-icon"></i></span></a>
                <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex mb-0">




                        </header>
                        <ul class="list-unstyled card-body">
                            <li>
                                <a href="{{ route('profil.index') }}"><span><span class="align-middle">Profil Düzenle</span></span></a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" id="cikisButonu"><span><span class="align-middle">Çıkış</span></span></a>
                                <form id="logout-form" action="{{route('logout')}}" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}"></form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <!-- /.navbar-right -->
        <!-- Right Menu -->
        <ul class="nav navbar-nav d-none d-lg-flex  mr-4 ml-2 ml-0-rtl">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-bell list-icon"></i></a>
                <div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex align-items-center mb-0"> <span class="heading-font-family flex-1 text-center fw-400">BİLDİRİMLER</span>
                        </header>
                        <ul style="max-height: 480px;" class="card-body list-unstyled dropdown-list-group">
                                <li>
                                    <a href="" class="media">
                                            <span class="media-body">
                                                İşlem Yok
                                            </span>
                                    </a>
                                </li>


                        </ul>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.dropdown-menu -->
            </li>

        </ul>
        <!-- /.navbar-right -->
    </nav>
    <!-- /.navbar -->
    <div class="content-wrapper">
        <!-- SIDEBAR -->
        <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">
            <!-- User Details -->
            <div class="side-user">
                <div class="col-sm-12 text-center p-0 clearfix">
                    <div class="d-inline-block pos-relative mr-b-10">
                        <figure class="thumb-sm mr-b-0 user--online">
                            <img src="{{ \App\Models\Worker::getPhoto() }}" class="rounded-circle" alt="">
                        </figure><a href="" class="text-muted side-user-link"><i class="feather feather-settings list-icon"></i></a>
                    </div>
                    <!-- /.d-inline-block -->
                    <div class="lh-14 mr-t-5"><a href="" class="hide-menu mt-3 mb-0 side-user-heading fw-500">{{ Auth::user()->name }}</a>
                        <br><small class="hide-menu">Admin</small>
                    </div>
                </div>
                <!-- /.col-sm-12 -->
            </div>
            <!-- /.side-user -->
            <!-- Sidebar Menu -->
            @include('layouts.sidebar')

        </aside>
        <!-- /.site-sidebar -->
        <main class="main-wrapper clearfix">
            @yield('content')
        </main>
        <!-- /.main-wrappper -->

    </div>
    <!-- /.content-wrapper -->
    <!-- FOOTER -->
    <footer class="footer d-print-none"><span class="heading-font-family">Copyright @2022. All rights reserved creator of the Worker Panel, Onur Özbay</span>
    </footer>
</div>
<!--/ #wrapper -->
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.2/countUp.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mithril/1.1.1/mithril.js"></script>
<script src="{{asset('assets/vendors/theme-widgets/widgets.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>

<script>
    (function() {
        const checkBox = document.querySelector("#cikisButonu");
        checkBox.addEventListener('click', (event) => {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }, false);
    })();
</script>
@yield('footer')
</body>

</html>
