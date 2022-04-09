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
                <li class="breadcrumb-item">{{trans('admin.bill_details')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('supplier/'.$supplier_id.'/account')}}" >{{trans('admin.supplier_account')}}</a> </li>
                <li class="breadcrumb-item active"><a href="{{url('supplier')}}" >{{trans('admin.nav_suppliers')}}</a> </li>
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
                                <div class="table-responsive">
                                <table id="myTable" class="table full-color-table full-primary-table">
                                    <thead>
                                    <tr>
                                        <th class="text-lg-center">{{trans('admin.name')}}</th>
                                        <th class="text-lg-center">{{trans('admin.quantity')}}</th>
                                        <th class="text-lg-center">{{trans('admin.purchas_price')}}</th>
                                        <th class="text-lg-center">{{trans('admin.total')}}</th>
                                        <th class="text-lg-center">{{trans('admin.date')}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($bill_bases as $supplier_base)
                                        <tr>
                                            <td class="text-lg-center">{{$supplier_base->name}}</td>
                                            <td class="text-lg-center">{{$supplier_base->quantity}}</td>
                                            <td class="text-lg-center">{{$supplier_base->purchas_price}}</td>
                                            <td class="text-lg-center">{{$supplier_base->total}}</td>
                                            <td class="text-lg-center">{{$supplier_base->date}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$bill_bases->links()}}
                                </div>
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

