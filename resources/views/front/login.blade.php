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
                                    <a class="nav-link" href="{{url('/customer_login')}}">تسجيل الدخول </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <section class="row tm-contact-row">
            <div class="col-lg-6 tm-contact-col-left" >

                <form action="{{url('/customer/login')}}" method="POST" id="tmContactForm" accept-charset="UTF-8" class="tm-bg-black-transparent tm-contact-form">
                    @csrf
                    <i class="mx-auto mb-5 fas fa-3x fa-user tm-app-feature-icon"></i>
                     <div class="form-group">
                        <input type="email" id="email" name="email"
                               class="form-control rounded-0 border-top-0 border-right-0 border-left-0"
                               placeholder="البريد الاليكترونى" required="">
                    </div>
                    <div class="form-group"  >
                        <input type="password" id="password" name="password"
                               class="form-control rounded-0 border-top-0 border-right-0 border-left-0"
                               placeholder="كلمة المرور"  required="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn  btn-primary tm-btn-submit rounded-circle">
                            تسجيل الدخول
                        </button>
                    </div>
                 </form>
            </div>
            <div class="col-lg-6 tm-contact-col-right">
                <div class="tm-bg-black-transparent tm-contact-text">

                    <img src="{{ asset('front/img/02.png')}}" alt="Image" class="img-fluid" />

                    {{--                    <i class="mx-auto mb-5 fas fa-3x fa-address-card tm-app-feature-icon"></i>--}}

{{--                    <h3 class="tm-service-tab-title">تسجيل الدخول</h3>--}}
{{--                    <p class="tm-service-tab-p">--}}
{{--                        Proin rutrum massa quis erat mollis iaculis. Vestibulum--}}
{{--                        a risus ex. Nunc rhoncus, justo at blandit cursus, orci--}}
{{--                        erat molestie felis, id ullamcorper mauris felis eu eros.--}}
{{--                    </p>--}}

                </div>
            </div>
        </section>


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
