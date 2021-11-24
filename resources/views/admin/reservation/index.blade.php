@extends('admin_temp')
@section('styles')
    <link href="{{ asset('/css/select2.css') }}" rel="stylesheet">
    {{--    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />--}}
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_bills')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_bills')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <div class="card-block">
                                <table id="supplier_bases_tbl" class="table full-color-table full-primary-table">
                                    <thead>
                                    <tr>
                                        <th class="center">{{trans('admin.bill_num')}}</th>
                                        <th class="center">{{trans('admin.customer')}}</th>
                                        <th class="center">{{trans('admin.total')}}</th>
                                        <th class="center">{{trans('admin.pay')}}</th>
                                        <th class="center">{{trans('admin.remain')}}</th>
                                        <th class="center">{{trans('admin.date')}}</th>
                                        <th class="center">{{trans('admin.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customer_bills as $user)
                                        <tr>
                                            <td class="text-lg-center">{{$user->bill_num}}</td>
                                            <td class="text-lg-center">{{$user->Customer->name}}</td>
                                            <td class="text-lg-center">{{$user->total}}</td>
                                            <td class="text-lg-center">{{$user->pay}}</td>
                                            <td class="text-lg-center">{{$user->remain}}</td>
                                            <td class="text-lg-center">{{$user->date}}</td>
                                            <td class="text-lg-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <div class="dropdown-menu animated lightSpeedIn" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item" href=" {{url('buy-bills/'.$user->id)}}">{{trans('admin.bill_procusts')}}</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" class="dropdown-item" href=" {{url('buy-bills/'.$user->id.'/print')}}">{{trans('admin.print_bill')}}</a>
                                                        <a target="_blank" class="dropdown-item" href=" {{url('buy-bills-store/'.$user->id.'/print')}}">طباعة للمخازن</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $customer_bills->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
