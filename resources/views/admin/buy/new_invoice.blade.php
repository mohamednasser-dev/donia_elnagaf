<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
    <title>Admin Pro Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
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
</head>
<body class="fix-header card-no-border fix-sidebar">
<section id="wrapper" class="error-page">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <div class="table-responsive" style="clear: both;">
                            <table class="table"  style="border: none;">
                                <tbody>
                                <tr>
                                    <td style="border: none;">الرقم :</td>
                                    <td style="border: none;">{{$CustomerBill->bill_num}}</td>
                                    <td style="border: none;"></td>
                                    <td style="border: none;"></td>
                                    <td style="border: none;" rowspan="2">
                                        <img src="{{ asset('/assets/images/logo.png') }}" alt="homepage" class="dark-logo"
                                             style="width: 200px; height: 120px;"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">تحريرا في :</td>
                                    <td class="">{{$CustomerBill->date}}</td>
                                </tr>
                                <tr>
                                    <td class="">المطلوب من العميل :</td>
                                    <td class="">{{$CustomerBill->Customer->name}}</td>
                                    <td class="">ت :{{$CustomerBill->Customer->phone}}</td>
                                </tr>
                                <tr>
                                    <td class="">العنوان :</td>
                                    <td class="">{{$CustomerBill->Customer->address}}</td>
                                </tr>
                                <tr>
                                    <td class="">اسم البائع :</td>
                                    <td class="">{{$CustomerBill->Saler_man->name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
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
                                    <td class="text-center">{{trans('admin.sale_pay')}}</td>
                                    <td class="text-center">{{trans('admin.sale_remain')}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">{{$CustomerBill->total}}</td>
                                    @if($CustomerBill->khasm > 0)
                                        <td class="text-center">{{$CustomerBill->khasm}}</td>
                                    @endif
                                    <td class="text-center">{{$CustomerBill->pay}}</td>
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
                                    <td class="text-center">الفرع الثاني</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">الفرع الاول</td>
                                </tr>
                                <tr>
                                    <td class="text-center">شارع السلام متفرع من شارع المحافظة و شارع مجمع المصالح -
                                        الزقازيق
                                    </td>
                                    <td class="text-center">رقم الواتس</td>
                                    <td class="text-center"> شارع نعيم متفرع من شارع الجلاء - الزقازيق</td>
                                </tr>
                                <tr>
                                    <td class="text-center">01020074409 - 0552359013</td>
                                    <td class="text-center">01064502658</td>
                                    <td class="text-center"> 01091428014 - 0552348182</td>
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
