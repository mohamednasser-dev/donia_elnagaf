@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_close_year')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_close_year')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- .row -->
                    <div class="row">
                        <!-- .col -->
                        <div class="col-md-6">
                            <h3 class="box-title">{{trans('admin.nav_outgoing')}}</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" width="150">{{trans('admin.close_total')}}</th>
                                        <th>{{$data['total_outGoings']}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.close_outgoings')}}</code> </td>
                                        <td>{{$data['outgoing']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.close_supplier')}}</code> </td>
                                        <td>{{$data['supplier_payment']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <!-- .col -->
                        <div class="col-md-6">
                            <h3 class="box-title">{{trans('admin.nav_buy')}}</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">{{trans('admin.close_total')}}</th>
                                        <th>{{$data['total_bills_cost']}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.pay')}}</code> </td>
                                        <td class="text-muted">{{$data['total_payed']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.remain')}}</code> </td>
                                        <td class="text-primary">{{$data['total_remain']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12 m-t-40 m-b-40">
                            <hr> 
                        </div>
                    </div>
  
                    <div class="row">
                        <!-- .col -->
                        <div class="col-md-6">
                            <h3 class="box-title">{{trans('admin.nav_bases')}}</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" width="150">{{trans('admin.close_total')}}</th>
                                        <th>{{$data['total_bases']}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.in_stock')}}</code> </td>
                                        <td>{{$data['base_now_quantity']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.pay_in_bills')}}</code> </td>
                                        <td>{{$data['base_out_quantity']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <!-- .col -->
                        <div class="col-md-6">
                            <h3 class="box-title">{{trans('admin.nav_products')}}</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">{{trans('admin.close_total')}}</th>
                                        <th>{{$data['total_outGoings']}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.in_stock')}}</code> </td>
                                        <td class="text-muted">{{$data['products_now_quantity']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap"> <code>{{trans('admin.products_out_quantity')}}</code> </td>
                                        <td class="text-primary">{{$data['total_outGoings']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12 m-t-40 m-b-40">
                            <hr> 
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
@endsection

