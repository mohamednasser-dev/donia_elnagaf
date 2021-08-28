<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sobhy Group</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600"/>
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" href="{{ asset('front/css/templatemo-style.css')}}"/>
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <!-- This page CSS -->

    <!--c3 CSS -->
    <link href="{{ asset('/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
{{--    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('/css/myStyles.css') }}" rel="stylesheet">--}}

    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('/css/pages/dashboard1.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/pages/card-page.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    input[type=text] {
       color: grey;
    }
</style>

</head>
<body id="servicesPage">


<div class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('front/img/bg-01.jpg')}}">
    <div class="container-fluid">
        <div class="row tm-brand-row">
            <div class="col-lg-4 col-11">
                <div class="tm-brand-container tm-bg-black-transparent">
                    <img src="{{ asset('front/img/011.png')}}" alt="homepage" class="dark-logo"
                         style="width: 200px; height: 140px;"/>
                    <div class="tm-brand-texts">
                        <h1 class="text-uppercase tm-brand-name"></h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-1">
                <div class="tm-nav">
                    <nav class="navbar navbar-expand-lg navbar-light tm-bg-white-transparent tm-navbar">
                        <button class="navbar-toggler" type="button"
                                data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item ">
                                    <div class="tm-nav-link-highlight"></div>
                                    <a class="nav-link" href="{{url('/')}}">الرئيسيه <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item ">
                                    <div class="tm-nav-link-highlight"></div>
                                    <a class="nav-link" href="{{url('our-products')}}">منتجاتنا</a>
                                </li>
                                <li class="nav-item">
                                    <div class="tm-nav-link-highlight"></div>
                                    <a class="nav-link" href="{{url('contact-us')}}">اتصل بنا</a>
                                </li>
                                 <li class="nav-item active">
                                    <div class="tm-nav-link-highlight"></div>
                                    <a class="nav-link" href="{{url('customer_home')}}">طلباتى</a>
                                </li>
                                <li class="nav-item">
                                    <div class="tm-nav-link-highlight"></div>
                                    <a class="nav-link" href="{{url('/customer_logout')}}"> تسجيل الخروج  </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-header" style="text-align: right">
                <button  alt="default" data-toggle="modal" data-target="#add-modal" class="btn btn-info btn-bg" >
                   حجز طلب
                </button>
            </div>
            <!-- Start home table -->
            <table class="table full-color-table table-bordered">
                <thead>
                <tr style="color: white;background:#0A0A0A">
                    <th class="text-lg-center">{{trans('admin.status')}}</th>
                    <th class="text-lg-center">{{trans('admin.date')}}</th>
                    <th class="text-lg-center">{{trans('admin.car_model')}}</th>
                    <th class="text-lg-center">{{trans('admin.car_type')}}</th>
                 </tr>
                </thead>

                <tbody>
                @foreach($orders as $user)
                    <tr style="color: white;background:#0A0A0A">
                        <td class="text-lg-center">{{trans('admin.'.$user->status)}}</td>
                        <td class="text-lg-center">{{$user->created_at}}</td>
                        <td class="text-lg-center">{{$user->car_model}}</td>
                        <td class="text-lg-center">{{$user->car_type}}</td>
                     </tr>
                @endforeach
                </tbody>
            </table>

        <!-- sample modal content -->
            <div id="add-modal" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header center" >
                            <h4 class="modal-title"> حجز طلب جديد</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                            </button>
                        </div>
                        <div class="modal-body" style="text-align: right">
                            {{ Form::open( ['url'  => ['order'],'method'=>'post' , 'files'=>true , 'class'=>'form'] ) }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.car_type')}}</label>
                                {{ Form::text('car_type',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.car_model')}}</label>
                                {{ Form::text('car_model',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.in_color')}}</label>
                                {{ Form::text('in_color',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.out_color')}}</label>
                                {{ Form::text('out_color',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.double_thread_color')}}</label>
                                {{ Form::text('double_thread_color',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.design_type')}}</label>
                                {!! Form::select('design_type', ['normal'=>(trans('admin.normal')),'threeD'=>(trans('admin.threeD')) ] , null, ['class'=>'form-control','required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.recieved_date')}}</label>
                                {{ Form::date('recieved_date',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.special_request')}}</label>
                                {{ Form::text('special_request',null,["class"=>"form-control" ,"required"]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.chaire_image')}}</label><br>
                                {{ Form::file('chaire_image',null,["class"=>"form-control" ]) }}
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">{{trans('admin.sofa_image')}}</label><br>
                                {{ Form::file('sofa_image',null,["class"=>"form-control" ]) }}
                            </div>
                            <div class="form-group" style="text-decoration-color: #0A0A0A">
                                <label for="recipient-name" class="control-label">{{trans('admin.bill_type')}}</label>
                                {!! Form::select('bill_type', ['gomla'=>(trans('admin.gomla')),'part'=>(trans('admin.part')) ] , null, ['class'=>'form-control','required']) !!}
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                                Close
                            </button>
                            {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </div>

        <!-- Page footer -->
        <footer class="row">
            <p class="col-12 text-white text-center tm-copyright-text">
                Copyright &copy; 2021 TE-solutions.
            </p>
        </footer>
    </div>
    <!-- .container-fluid -->
</div>



<script src="{{ asset('front/js/jquery.min.js')}}"></script>
<script src="{{ asset('front/js/parallax.min.js')}}"></script>
<script src="{{ asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/slick/slick.min.js')}}"></script>
<script>
    $(function () {
        $('.tabgroup > div').hide();
        $('.tabgroup > div:first-of-type').show();
        $('.tabs a').click(function (e) {
            e.preventDefault();
            var $this = $(this),
                tabgroup = '#' + $this.parents('.tabs').data('tabgroup'),
                others = $this.closest('li').siblings().children('a'),
                target = $this.attr('href');
            others.removeClass('active');
            $this.addClass('active');
            $(tabgroup).children('div').hide();
            $(target).show();

            // Scroll to tab content (for mobile)
            if ($(window).width() < 992) {
                $('html, body').animate({
                    scrollTop: $("#first-tab-group").offset().top
                }, 200);
            }
        })

        $('.tm-carousel').slick({
            dots: true,
            infinite: false,
            arrows: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
</script>
</body>
</html>
