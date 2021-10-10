<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <style>
        body {
            font-family: 'Droid Arabic Kufi', serif !important;
            font-size: 48px;
        }

        .col-xs-12 {
            width: 100%;
        }
    </style>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
    <title>{{trans('admin.website_title')}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <!-- This page CSS -->

    <!--c3 CSS -->
    <link href="{{ asset('/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/myStyles.css') }}" rel="stylesheet">

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
    @yield('styles')
</head>

<body>
<div class="row">
    <div class="col-md-12">
        <div class="card card-body printableArea">
            <div class="row">
                <div class="col-md-3">
                    <h3><p class="m-t-10"><b>{{trans('admin.bill_date')}}</b></i>{{$CustomerBill->date}}</p></h3>
                    <h3><p class="m-t-10"><b>{{trans('admin.mrs')}}</b></i>{{$CustomerBill->Customer->name}}</p></h3>
                    <h3><span class="pull-left"><b
                                class="text-danger">{{trans('admin.NO_bill')}}{{$CustomerBill->bill_num}}</b></span>
                    </h3>
                </div>
                <div class="col-md-3">
                    <img src="{{ asset('/assets/images/logo.png') }}" alt="homepage" class="dark-logo"
                         style="width: 200px; height: 120px;"/>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" style="clear: both; text-align: center;">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-lg-center">{{trans('admin.product_bill')}}</th>
                                <th class="text-lg-center">{{trans('admin.quantity_bill')}}</th>
                                <th class="text-lg-center">{{trans('admin.price_bill')}}</th>
                                <th class="text-lg-center">{{trans('admin.total')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($BillProduct as $product)
                                <tr>
                                    <td class="text-lg-center">{{$product->name}}</td>
                                    <td class="text-lg-center">{{$product->quantity}}</td>
                                    <td class="text-lg-center">{{$product->price}}</td>
                                    <td class="text-lg-center">{{$product->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <div class="col-md-12">
                        <div class="pull m-t-30 " style="text-align: center">
                            <p>{{trans('admin.sale_total')}} $ {{$CustomerBill->total}}</p>
                            <p>{{trans('admin.sale_pay')}} $ {{$CustomerBill->pay}}</p>
                            <hr>
                            <h3><b>{{trans('admin.sale_remain')}}</b> $ {{$CustomerBill->remain}}</h3>
                            <hr>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <h3><b>الفرع الاول : </b> شارع نعيم متفرع من شارع الجلاء - الزقازيق</h3>
            </div>
            <div class="row">
                <h3><b> 01091428014 - 0552348182</b></h3>
            </div>
            <br>
            <div class="row">
                <h3><b>الفرع الثاني : </b>شارع السلام متفرع من شارع المحافظة و شارع مجمع المصالح - الزقازيق</h3>
            </div>
            <div class="row">
                <h3><b> 01020074409 - 0552359013</b></h3>
            </div>
            <br>
            <div class="row">
                <h3><b>رقم الواتس : </b> 01064502658</h3>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('/js/custom.min.js') }}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--sparkline JavaScript -->
<script src="{{ asset('/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!--morris JavaScript -->
<!--c3 JavaScript -->
<script src="{{ asset('/assets/plugins/d3/d3.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/c3-master/c3.min.js') }}"></script>
<!-- Popup message jquery -->
<script src="{{ asset('/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('/js/dashboard1.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{ asset('/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('/assets/plugins/toastr/toastr.js') }}"></script>

<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<!-- ============================================================== -->
<!-- For Data Table -->
<!-- ============================================================== -->
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        window.print();
    });
</script>
</body>
</html>


