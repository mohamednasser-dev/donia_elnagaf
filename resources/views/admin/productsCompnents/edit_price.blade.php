@extends('admin_temp')
@section('content')
    <div class="row page-titles" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تعديل السعر بالباركود</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">تعديل السعر بالباركود</li>
                <li class="breadcrumb-item"><a href="{{url('products')}}">{{trans('admin.nav_products')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <hr>
                    {!! Form::model(null, ['route' => ['search.products.update_price'] , 'method'=>'post' , 'files'=>true ]) !!}
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.barcode_search')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('barcode',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.price_new')}}</label>
                        <div class="col-md-10">
                            {{ Form::number('price',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="center">
                        {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

