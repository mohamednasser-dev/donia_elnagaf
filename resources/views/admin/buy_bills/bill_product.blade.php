@extends('admin_temp')
@section('styles')
    <link href="{{ asset('/css/select2.css') }}" rel="stylesheet">
    {{--    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />--}}
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_bill_product')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_bill_product')}}</li>
                <li class="breadcrumb-item"><a href="{{url('buy-bills')}}" >{{trans('admin.nav_bills')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
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
                                        <th class="center">{{trans('admin.product_id')}}</th>
                                        <th class="center">{{trans('admin.bill_id')}}</th>
                                        <th class="center">{{trans('admin.name')}}</th>
                                        <th class="center">{{trans('admin.quantity')}}</th>
                                        <th class="center">{{trans('admin.price')}}</th>
                                        <th class="center">{{trans('admin.total')}}</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bill_product as $user)
                                        <tr>
                                            <td class="text-lg-center">{{$user->Product->name}}</td>
                                            <td class="text-lg-center">{{$user->bill_id}}</td>
                                            <td class="text-lg-center">{{$user->name}}</td>
                                            <td class="text-lg-center">{{$user->quantity}}</td>
                                            <td class="text-lg-center">{{$user->price}}</td>
                                            <td class="text-lg-center">{{$user->total}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')

@endsection

