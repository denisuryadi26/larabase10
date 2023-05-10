<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title> {{env('APP_NAME') }} @hasSection('title') - @yield('title') @else - @endif </title>
    <style>
        .error {
            margin: 2px;
            color: red;
            background-color: #ffffff;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="ws_url" content="{{ env('WS_URL') }}">
    <meta name="user_id" content="{{Auth::id() }}">


    {{-- <link rel="apple-touch-icon" href="{{asset('vuexy/app-assets/images/ico/apple-icon-120.png')}}">--}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('vuexy/app-assets/images/ico/favicon.ico')}}">--}}
    <link rel="apple-touch-icon" href="{{asset('img/icon/favicon.ico')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/icon/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/themes/semi-dark-layout.css')}}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('lib/fonts/simple-line-icons/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('lib/fonts/line-awesome/css/line-awesome.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <!-- <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/chat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/pages/app-chat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/pages/app-chat-list.css')}}">

    <!-- END: Page CSS-->
    @yield('stylesheet')

</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- [ Header ] start -->
    @include('admin.templates.header')
    <!-- [ Header ] end -->
    <!-- [ navigation menu ] start -->
    @include('admin.templates.sidebar')
    <!-- [ navigation menu ] end -->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        {{--test--}}
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"> @yield('breadcumbs') </div>
            <div class="content-body"> @yield('content') </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('vuexy/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{asset('vuexy/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>--}}
    <script src="{{asset('vuexy/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{asset('vuexy/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('vuexy/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>--}}
    <!-- END: Page JS-->
    <script src="{{asset('vuexy/app-assets/js/scripts/components/components-modals.js')}}"></script>
    <!-- Sweetalert2 Js -->
    <script src="{{asset('lib/sweetalert2/sweetalert2.js')}}"></script>
    <!-- Sweetalert2 Js -->
    <!-- jquery-validation Js -->
    <script src="{{asset('lib/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <!-- form-picker-custom Js -->
    <script src="{{asset('lib/form/form-validation.js')}}"></script>
    <script src="{{asset('js/core.js')}}"></script>


    {{--SOCKET JS--}}
    <script src="{{ asset('lib/socket/vue.js') }}"></script>
    <script src="{{ asset('lib/socket/socket.io.js') }}"></script>
    <script src="{{ asset('lib/socket/moment.min.js') }}"></script>
    <script src="{{ asset('lib/socket/chat.js') }}"></script>
    <script src="{{ asset('lib/socket/notif.js') }}"></script>
    {{--SOCKET JS--}}


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('vuexy/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>

    <script src="{{asset('vuexy/app-assets/js/scripts/tables/table-datatables-advanced.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('vuexy/app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <!-- <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script> -->

    <!-- END: Page Vendor JS-->
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script> @yield('script')
</body>
<!-- END: Body-->

</html>