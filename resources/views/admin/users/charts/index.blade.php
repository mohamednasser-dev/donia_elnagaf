
@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">إحصائيات الانتاجية</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">إحصائيات الانتاجية</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <a href="{{route('users.charts.branch',1)}}">
                    <div class="d-flex">
                        <div class="stats">
                            <h2 class="text-white">الفرع الاول</h2>
                            <h6 class="text-white"></h6>
                        </div>
                        <div class="stats-icon text-right ml-auto"><i class="mdi mdi-rocket display-5 op-3 text-dark"></i></div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <a href="{{route('users.charts.branch',2)}}">
                    <div class="d-flex">
                        <div class="stats">
                            <h2 class="text-white">الفرع الثاني</h2>
                            <h6 class="text-white"></h6>
                        </div>
                        <div class="stats-icon text-right ml-auto"><i class="mdi mdi-account-location display-5 op-3 text-dark"></i></div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
