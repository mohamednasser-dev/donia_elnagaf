@extends('admin_temp')
@section('style')
@endsection
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
    <!-- /.card-header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <div class="row">
                    <div class="col-md-5">
{{--                         <img src="{{ asset('/assets/images/bill_images/bill_header.png') }}" alt="homepage" class="dark-logo" style="width: 200px; height: 100px;"/>--}}
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <img src="{{ asset('/assets/images/logo.png') }}" alt="homepage" class="dark-logo" style="width: 200px; height: 120px;"/>
                        </div>
                        <div class="row center" style="margin-right: 40px;">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-dark">{{trans('admin.bill')}}</button>
                        </div>
                    </div>
                    <div class="col-md-4 center">
{{--                        <img src="{{ asset('/assets/images/bill_images/bill_phones.png') }}" alt="homepage" class="dark-logo" style="width: 200px; height: 70px;"/>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3><p class="m-t-10"><b>{{trans('admin.bill_date')}}</b></i>{{$CustomerBill->date}}</p></h3>
                    </div>
                    <div class="col-md-6">
                        <h3><span class="pull-right"><b class="text-danger">{{trans('admin.NO_bill')}}{{$CustomerBill->bill_num}}</b></span></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3><p class="m-t-10"><b>{{trans('admin.mrs')}}</b></i>{{$CustomerBill->Customer->name}}</p></h3>
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
            <div class="text-left">
                <a id="print" class="btn btn-success" href=" {{url('buy_bill_design_last/'.$CustomerBill->id.'/print')}}" target="_blank">
                    <i class="fa fa-print"></i>{{trans('admin.print')}}
                </a>

                <a href="{{ URL::previous() }}">{{trans('admin.back')}}</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('/js/jquery.PrintArea.js') }}" type="text/JavaScript"></script>
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $("#print").click(function() {--}}
{{--            var mode = 'iframe'; //popup--}}
{{--            var close = mode == "popup";--}}
{{--            var options = {--}}
{{--                mode: mode,--}}
{{--                popClose: close--}}
{{--            };--}}
{{--            $("div.printableArea").printArea(options);--}}
{{--        });--}}
{{--    });--}}
{{--    </script>--}}
@endsection

