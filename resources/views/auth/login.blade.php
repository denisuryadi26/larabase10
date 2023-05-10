<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Login Page - Juragan Beku CMS </title>
    <link rel="apple-touch-icon" href="{{asset('img/icon/favicon.ico')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/icon/favicon.ico')}}">
    {{-- <link rel="apple-touch-icon" href="{{asset('front/app-assets/images/ico/apple-icon-120.png')}}">--}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('front/app-assets/images/ico/favicon.ico')}}">--}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">


    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/bootstrap-extended.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/style.css')}}">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/sweetalert2.min.css')}}">

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
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                        <a class="brand-logo" href="javascript:void(0);">
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                                <img class="img-fluid" src="{{asset('auth/images/login-v2.svg')}}" alt="Login V2" />
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">

                                {{-- <h2 class="card-title font-weight-bold mb-1">Welcome to CMS! 👋</h2>--}}

                                <img class="" alt="logo" style="width:200px !important; height:40px !important" src="{{(!empty($setting['logo_icon']) ? asset('upload/'.$setting['logo_icon']) : asset('vuexy/app-assets/images/logo/logo.png'))}}">
                                <span style="font-size: 1.7em; font-weight: bold" class="font-weight-bolder">CMS</span>
                                <p class="card-text mb-2 mt-2">Please sign-in to your account and start the adventure</p>
                                <form class="auth-login-form mt-2" action="{{route('login')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Username" aria-describedby="username" autofocus="" tabindex="1" required />
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Password</label><a href="#"><small>Forgot Password?</small></a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="2" required />
                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="custom-control-label" for="remember-me"> Remember Me</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                                </form>
                                <p class="text-center mt-2"><span>Belum punya akun?</span><a href="{{ route('register') }}"><span>&nbsp;Register disini</span></a></p>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('auth/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('auth/js/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('auth/js/app-menu.js')}}"></script>
    <script src="{{asset('auth/js/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('auth/js/page-auth-login.js')}}"></script>
    <!-- END: Page JS-->

    <script src="{{asset('lib/sweetalert2/sweetalert2.js')}}"></script>



    @if($message)
    <script>
        setTimeout(function() {
            Swal.fire({
                icon: `error`,
                title: `Login Failed`,
                html: 'Kombinasi username dan password tidak sesuai',
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonColor: "#DD6B55",
                // timer: 2000,
            })
        }, 1000);
    </script>
    @endif

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