@extends('admin_temp')
@section('content')
    <div class="row page-titles" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.edit_product')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.edit_product')}}</li>
                <li class="breadcrumb-item"><a href="{{url('products')}}">{{trans('admin.nav_products')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('admin.product_info')}}</h4>
                    <hr>
                    {!! Form::model($product, ['route' => ['products.update',$product->id] , 'method'=>'put' , 'files'=>true ]) !!}
                    {{ csrf_field() }}

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.product_name')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('name',$product->name,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.name')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.quantity')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('quantity',$product->quantity,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.quantity')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.barcode')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('barcode',$product->barcode,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.barcode')]) }}
                        </div>
                    </div>
                    {{ Form::hidden('price',0,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.price')]) }}
                    {{ Form::hidden('total_cost',$product->total_cost,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.price')]) }}

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.gomla_price')}}</label>
                        <div class="col-md-10">
                            {{ Form::number('gomla_price',$product->gomla_price,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.gomla_percent')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.buy_price')}}</label>
                        <div class="col-md-10">
                            {{ Form::number('selling_price',$product->selling_price,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.buy_price')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.category')}}</label>
                        <div class="col-md-10">
                            {{ Form::select('category_id',App\Models\Category::where('type','product')->pluck('name','id'),$product->category_id
                                               ,["class"=>"form-control custom-select col-12 ",'id'=>'category_id' ]) }}

                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.image')}}</label>
                        <div class="col-md-10">
                            {{ Form::file('image',array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <div class="col-md-10">
                            <img src="{{url($product->image)}}" width="150px" height="150px">
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

