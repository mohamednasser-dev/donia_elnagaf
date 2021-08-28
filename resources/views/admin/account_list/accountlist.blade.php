@extends('admin_temp')
@section('styles')
    <link href="{{ asset('/css/select2.css') }}" rel="stylesheet">
    {{--    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />--}}
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_account_list')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_account_list')}}</li>
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
                        <div class="card-body">
                            <h4 class="card-title">{{trans('admin.Search_area')}}</h4>
                            <div class="row">
                                <div>


                                    {{ Form::open( ['url'  => ['accounts'],'method'=>'post' ] ) }}
                                    {{ csrf_field() }}
                                </div>


                                <div class="col-md-4">
                                    <div>
                                        <label>{{trans('admin.search_form_date')}}</label>
                                        {!! Form::date('fromdate',old('date'),['class'=>'form-control center','required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label>{{trans('admin.search_to_date')}}</label>
                                        {!! Form::date('todate',old('date'),['class'=>'form-control center','required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label>{{trans('admin.search_by_cust_name')}}</label>
                                        {{ Form::select('cust_id',App\Models\Customer::pluck('name','id'),null
                                        ,["class"=>"select2 form-control custom-select" ,'placeholder'=>trans('admin.choose_cust') ,'required' ]) }}
                                    </div>
                                </div>
                                <div class="col-md-12" style="display: block; margin-top: 20px;" >

                                    {{ Form::submit( trans('admin.print') ,['class'=>'btn btn-info btn-block']) }}
                                    {{ Form::close() }}
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

