<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
    <title>{{settings()->name}}</title>
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/css/pages/error-pages.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            font-family: 'Helvetica';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            line-height: 1.0;
            background: #fff !important;
            color: #000;
            text-align: center;
        }

        .ticket {
            border: 1px dotted #000;
            width: 8cm;
            display: inline-block;
        }

        .table {
            width: 100%;
            font-family: 'Helvetica';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
        }

        .right, .table {
            text-align: right;
        }

        .timedate {
            font: 10pt;
        }

        .qrcode {
            text-align: center;
        }

        @media print {
            body {
                font-family: 'Helvetica';
                font-weight: normal;
                font-style: normal;
                font-variant: normal;
                line-height: 1.0;
                background: #fff !important;
                color: #000;
                text-align: inherit;
            }

            .ticket {
                border: none;
                width: 100%;
                display: auto;
            }

            .table {
                width: 100%;
                font-family: 'Helvetica';
                font-weight: normal;
                font-style: normal;
                font-variant: normal;
            }

            .timedate {
                font: 6pt;
            }
        }

        @page {
            size: auto;   /* auto is the initial value */
            margin: .2cm;  /* this affects the margin in the printer settings */
            font-family: emoji !important;
        }
    </style>
</head>
<body class="fix-header card-no-border fix-sidebar">
<section id="wrapper" class="error-page">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <hr>
                <div class="row">
                    <div class="col-lg-6" style="width: 48%;">
                        @if($CustomerBill->type == 'back')
                        {{trans('admin.nav_buy_back')}}
                        @endif
                        <br>
                        <br>
                        الرقم : {{$CustomerBill->bill_num}}<br><br>
                        تحريرا في : <small class="timedate">{{$CustomerBill->date}} </small><br><br>
                        المطلوب من العميل : {{$CustomerBill->Customer->name}}<br><br>
                        العنوان : {{$CustomerBill->Customer->address}} <br><br>
                    </div>
                    <div class="col-lg-6" style="width: 48%; text-align: left;">
                        <img src="{{ asset('/assets/images/logo.png') }}" alt="homepage" class="dark-logo"
                             style="width: 180px; height: 100px;"/>
                        <br><br>
                        اسم البائع : {{$CustomerBill->Saler_man->name}}<br><br>
                        ت : {{$CustomerBill->Customer->phone}}<br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="width: 48%;">


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-t-10" style="clear: both;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">{{trans('admin.product_bill')}}</th>
                                    <th class="text-center">{{trans('admin.quantity_bill')}}</th>
                                    <th class="text-center">{{trans('admin.price_bill')}}</th>
                                    <th class="text-center">{{trans('admin.total')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($BillProduct as $product)
                                    <tr>
                                        <td class="text-center">{{$product->name}}</td>
                                        <td class="text-center">{{$product->quantity}}</td>
                                        <td class="text-center">{{$product->price}}</td>
                                        <td class="text-center">{{$product->total}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive" style="clear: both;">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td class="text-center">{{trans('admin.sale_total')}}</td>
                                    @if($CustomerBill->khasm > 0)
                                        <td class="text-center">الخصم</td>
                                    @endif
                                    @if( $CustomerBill->reservation == '1' && $CustomerBill->second_pay > 0)
                                        <td class="text-center">المدفوع مسبقا</td>
                                        <td class="text-center">المدفوع حاليا</td>
                                    @else
                                        <td class="text-center">{{trans('admin.sale_pay')}}</td>
                                    @endif
                                    <td class="text-center">{{trans('admin.sale_remain')}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">{{$CustomerBill->total}}</td>
                                    @if( $CustomerBill->khasm > 0)
                                        <td class="text-center">{{$CustomerBill->khasm}}</td>
                                    @endif
                                    @if( $CustomerBill->reservation == '1' && $CustomerBill->second_pay > 0)
                                        <td class="text-center">{{$CustomerBill->first_pay}}</td>
                                        <td class="text-center">{{$CustomerBill->second_pay}}</td>
                                    @else
                                        <td class="text-center">{{$CustomerBill->pay}}</td>
                                    @endif

                                    <td class="text-center">{{$CustomerBill->remain}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive" style="clear: both;">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="text-center">الفرع الاول</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">الفرع الثاني</td>
                                </tr>
                                <tr>
                                    <td class="text-center"> شارع نعيم متفرع من شارع الجلاء - الزقازيق</td>
                                    <td class="text-center">رقم الواتس</td>
                                    <td class="text-center">شارع السلام متفرع من شارع المحافظة و شارع مجمع المصالح -
                                        الزقازيق
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"> 01091428014 - 0552348182</td>
                                    <td class="text-center">01064502658</td>
                                    <td class="text-center">01020074409 - 0552359013</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/waves.js') }}"></script>
<script>
    $(document).ready(function () {
        window.print();
    });
</script>
</body>
</html>
