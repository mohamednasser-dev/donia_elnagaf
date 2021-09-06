<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
        <title>{{settings()->name}}</title>
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- page css -->
        <link href="{{ asset('/css/pages/login-register-lock.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

        <!-- You can change the theme colors from here -->
        <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Shop manager</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{ asset('/assets/images/background/login-register.jpg') }});">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{route('login_user') }}">
                         @csrf
                        <a href="javascript:void(0)" class="text-center db">
                            <img src="{{ asset('/assets/images/logo.png') }}" style="width: 150px; height: 150px;" alt="Home" />
                        </a>
                        @include('layouts.errors')
                        @include('layouts.messages')
                        <div class="form-group m-t-40">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email" id="email" required="" placeholder="{{trans('admin.email')}}" required="">
                                @error('email')
                                    <span role="alert">
                                        <strong class="red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" id="password" required="" placeholder="{{trans('admin.password')}}">
                                @error('password')
                                    <span role="alert">
                                        <strong class="red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">{{trans('admin.login')}} </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <!--Custom JavaScript -->
        <script type="text/javascript">
            $(function() {
                $(".preloader").fadeOut();
            });
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });
            // ==============================================================
            // Login and Recover Password
            // ==============================================================
            $('#to-recover').on("click", function() {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });
        </script>
    </body>
</html>
