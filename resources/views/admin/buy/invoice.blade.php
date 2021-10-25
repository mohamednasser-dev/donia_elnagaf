@extends('admin_temp')
{{--@section('styles')--}}
{{--    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">--}}
{{--    <!-- Custom CSS -->--}}
{{--    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">--}}
{{--    <!-- You can change the theme colors from here -->--}}
{{--    <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">--}}
{{--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
{{--@endsection--}}
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.print_bill')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.print_bill')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <hr>
                <div class="row">
                    <div class="col-md-7">
                        <div class="table-responsive" style="clear: both;">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="">الرقم :</td>
                                    <td class="">{{$CustomerBill->bill_num}}</td>
                                </tr>
                                <tr>
                                    <td class="">تحريرا في :</td>
                                    <td class="">{{$CustomerBill->date}}</td>
                                </tr>
                                <tr>
                                    <td class="">المطلوب من العميل :</td>
                                    <td class="">{{$CustomerBill->Customer->name}}</td>
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
                    <div class="col-md-2">
                        <div >
                            <table class="">
                                <tbody>
                                <tr>
                                    <td class="">ت :</td>
                                    <td class="">{{$CustomerBill->Customer->phone}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('/assets/images/logo.png') }}" alt="homepage" class="dark-logo"
                              style="width: 200px; height: 120px;"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover">
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
                                    <td class="text-center">{{trans('admin.sale_remain')}}</td>
                                    <td class="text-center">{{trans('admin.sale_pay')}}</td>
                                    <td class="text-center">{{trans('admin.sale_total')}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">{{$CustomerBill->remain}}</td>
                                    <td class="text-center">{{$CustomerBill->pay}}</td>
                                    <td class="text-center">{{$CustomerBill->total}}</td>
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
            <div class="text-right">
                <a href="{{ URL::previous() }}">{{trans('admin.back')}}</a>
                <button id="print" class="btn btn-default btn-outline" type="button"><span><i class="fa fa-print"></i> {{trans('admin.print')}}</span>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/jquery.PrintArea.js') }}" type="text/JavaScript"></script>

    <script>
        $(document).ready(function () {
            $("#print").click(function () {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
    </script>
    <script src="{{ asset('/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
{{--    <script>--}}
{{--        window.print();--}}
{{--    </script>--}}
@endsection
