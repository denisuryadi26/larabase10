<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <title> MAINTENANCE </title>
    <style>
        .error {
            margin: 2px;
            color: red;
            background-color: #ffffff;
        }
    </style>
    {{--    <link rel="apple-touch-icon" href="{{asset('vuexy/app-assets/images/ico/apple-icon-120.png')}}">--}}
    {{--    <link rel="shortcut icon" type="image/x-icon" href="{{asset('vuexy/app-assets/images/ico/favicon.ico')}}">--}}
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

    <link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/css/pages/page-misc.css')}}">

    <!-- END: Page CSS-->
    @yield('stylesheet')

</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Under maintenance-->
            <div class="misc-wrapper"><a class="brand-logo" href="javascript:void(0);">
                    <img class="" alt="logo" style="width:200px !important; height:40px !important"
                         src="{{(!empty($setting['logo_icon']) ? asset('upload/'.$setting['logo_icon']) : asset('vuexy/app-assets/images/logo/logo.png'))}}">
                </a>
                <div class="misc-inner p-2 p-sm-3">
                    <div class="w-100 text-center">
                        <h2 class="mb-1">Under Maintenance 🛠</h2>
                        <p class="mb-3">Sorry for the inconvenience but we're performing some maintenance at the moment</p>
                        <form class="form-inline justify-content-center row m-0 mb-2" action="javascript:void(0);">
                            <input class="form-control col-12 col-md-5 mb-1 mr-md-2" id="notify-email" type="text" placeholder="john@example.com" />
                            <button class="btn btn-primary mb-1 btn-sm-block" type="submit">Notify</button>
                        </form><img class="img-fluid" src="{{asset('vuexy/app-assets/images/pages/under-maintenance.svg')}}" alt="Under maintenance page" />
                    </div>
                </div>
            </div>
            <!-- / Under maintenance-->
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('vuexy/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('vuexy/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('vuexy/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->
</html>