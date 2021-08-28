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
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <h3 style="text-align: center">كشف حساب للعميل
                    <b>{{$customer_account->first()->Customer->name}} </b></h3>
                <h5 style="text-align: center">من{{$from}} الى {{$to}} </h5>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both; text-align: center;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="center">{{trans('admin.date')}}</th>
                                    <th class="center">{{trans('admin.remain')}}</th>
                                    <th class="center">{{trans('admin.pay')}}</th>
                                    <th class="center">{{trans('admin.total')}}</th>
                                    <th class="center">{{trans('admin.bill_num')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer_account as $user)
                                    <tr style="text-align: center">

                                        <td class="text-lg-center">{{$user->date}}</td>
                                        <td class="text-lg-center">{{$user->remain}}</td>
                                        <td class="text-lg-center">{{$user->pay}}</td>
                                        <td class="text-lg-center">{{$user->total}}</td>
                                        <td class="text-lg-center">{{$user->bill_num}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull m-t-30 " style="text-align: center">
                            <p>{{trans('admin.sale_total')}}  {{$customer_account->sum('total')}}</p>
                            <p>{{trans('admin.sale_pay')}}  {{$customer_account->sum('pay')}}</p>
                            <hr>
                            <h3><b>{{trans('admin.sale_remain')}}</b>  {{$customer_account->sum('remain')}}</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="text-left">
                <button id="print" class="btn btn-success" type="button"> <i class="fa fa-print"></i>{{trans('admin.print')}}</button>
             </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/jquery.PrintArea.js') }}" type="text/JavaScript"></script>
    <script>
        $(document).ready(function() {
            $("#print").click(function() {
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
@endsection

