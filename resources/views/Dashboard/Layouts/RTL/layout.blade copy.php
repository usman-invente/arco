<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>ARCO (Arab red cresent and Red cross Organization)</title>
    <meta name="description" content="JARCO is a clean, modern society, it is designed for charity, non-profit, fundraising, donation, volunteer, businesses or any type of person or business who wants to showcase their work, services and professional way." />
{{--    <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Jetson Admin, Jetsonadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />--}}
    <meta name="author" content="hencework"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{ asset('public/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="{{ asset('public/dist/css/style.css') }}" rel="stylesheet" type="text/css">


    <style>
        .card-view.panel.panel-default > .panel-heading {
            background: #373636 !important;
        }
        .form-control {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid rgba(0, 0, 0, 0.63);
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->
<div class="wrapper theme-1-active pimary-color-green">

    <!-- Top Menu Items -->
    @include('Dashboard.Layouts.RTL.navbar')
    <!-- /Top Menu Items -->

    <!-- Left Sidebar Menu -->
    @include('Dashboard.Layouts.RTL.sidebar')
    <!-- /Left Sidebar Menu -->



    <script src="{{ asset('public/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>


    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">


            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">{{ $title }}</h5>
                </div>
                <!-- Breadcrumb -->
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard.home') }}">{{__('navbar.dashboard')}}</a></li>
                    </ol>
                </div>
                <!-- /Breadcrumb -->
            </div>




            @include('Dashboard.messages')
            <!-- Title -->
            @yield('content')
            <!-- /Title -->

            <!-- Footer -->
            @include('Dashboard.Layouts.RTL.footer')
            <!-- /Footer -->
        </div>
    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('public/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Data table JavaScript -->
<script src="{{ asset('public/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/dist/js/dataTables-data.js') }}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{ asset('public/dist/js/jquery.slimscroll.js') }}"></script>

<!-- Owl JavaScript -->
<script src="{{ asset('public/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

<!-- Switchery JavaScript -->
<script src="{{ asset('public/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('public/dist/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- Init JavaScript -->
<script src="{{ asset('public/dist/js/init.js') }}"></script>


</body>

</html>
