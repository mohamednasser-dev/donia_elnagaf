
@extends('admin_temp')
@section('content')
    {{--Main Menu--}}
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_home')}}</h3>
        </div>
    </div>
{{--    <div class="row">--}}
{{--    	<div class="col-lg-3">--}}
{{--            <div class="card bg-success text-white">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="d-flex">--}}
{{--                        <div class="stats">--}}
{{--                            <h1 class="text-white">{{$bases}}</h1>--}}
{{--                            <h6 class="text-white">{{trans('admin.total_base')}}</h6>--}}
{{--                        </div>--}}
{{--                        <div class="stats-icon text-right ml-auto"><i class="mdi mdi-scale display-5 op-3 text-dark"></i></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3">--}}
{{--            <div class="card bg-warning text-white">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="d-flex">--}}
{{--                        <div class="stats">--}}
{{--                            <h1 class="text-white">{{$products}}</h1>--}}
{{--                            <h6 class="text-white">{{trans('admin.total_product')}}</h6>--}}
{{--                        </div>--}}
{{--                        <div class="stats-icon text-right ml-auto"><i class="mdi mdi-rocket display-5 op-3 text-dark"></i></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3">--}}
{{--            <div class="card bg-primary text-white">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="d-flex">--}}
{{--                        <div class="stats">--}}
{{--                            <h1 class="text-white">{{$emps}}</h1>--}}
{{--                            <h6 class="text-white">{{trans('admin.total_emp')}}</h6>--}}
{{--                        </div>--}}
{{--                        <div class="stats-icon text-right ml-auto"><i class="mdi mdi-account-location display-5 op-3 text-dark"></i></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3">--}}
{{--            <div class="card bg-info text-white">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="d-flex">--}}
{{--                        <div class="stats">--}}
{{--                            <h1 class="text-white">{{$bills}}</h1>--}}
{{--                            <h6 class="text-white">{{trans('admin.total_sales')}}</h6>--}}
{{--                        </div>--}}
{{--                        <div class="stats-icon text-right ml-auto"><i class="mdi mdi-chart-areaspline display-5 op-3 text-dark"></i></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

@endsection
