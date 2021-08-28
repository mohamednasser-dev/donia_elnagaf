@extends('admin_temp')
@section('content')
    <div class="row page-titles" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.order')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.order')}}</li>
                <li class="breadcrumb-item"><a href="{{url('orders')}}">{{trans('admin.order')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('admin.order')}}</h4>
                    <hr>
                    {!! Form::model($order, ['route' => ['orders.update',$order->id] , 'method'=>'put' , 'files'=>true ]) !!}
                    {{ csrf_field() }}
                    <div class="form-group" style="text-decoration-color: #0A0A0A">
                        <label for="recipient-name" class="control-label">{{trans('admin.customer')}}</label>
                        {!! Form::text('cust_id',  $order->Customer->name, ['class'=>'form-control','readonly']) !!}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.car_type')}}</label>
                        {{ Form::text('car_type',$order->car_type,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.car_model')}}</label>
                        {{ Form::text('car_model',$order->car_model,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.in_color')}}</label>
                        {{ Form::text('in_color',$order->in_color,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.out_color')}}</label>
                        {{ Form::text('out_color',$order->out_color,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.double_thread_color')}}</label>
                        {{ Form::text('double_thread_color',$order->double_thread_color,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.design_type')}}</label>
                        {!! Form::text('design_type',   trans('admin.'.$order->design_type), ['class'=>'form-control','readonly']) !!}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.recieved_date')}}</label>
                        {{ Form::date('recieved_date',$order->recieved_date,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.created_at')}}</label>
                        {{ Form::date('created_at',$order->created_at,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.special_request')}}</label>
                        {{ Form::text('special_request',$order->special_request,["class"=>"form-control" ,"readonly"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.chaire_image')}}</label><br>
                        <img src="{{url('uploads/orders/'.$order->chaire_image)}}" width="150px" height="150px"></div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.sofa_image')}}</label><br>
                        <img src="{{url('uploads/orders/'.$order->sofa_image)}}" width="150px" height="150px"></div>
                    <div class="form-group" style="text-decoration-color: #0A0A0A">
                        <label for="recipient-name" class="control-label">{{trans('admin.bill_type')}}</label>
                        {!! Form::text('bill_type',  trans('admin.'.$order->bill_type), ['class'=>'form-control','readonly']) !!}
                    </div>
                    <div class="form-group" style="text-decoration-color: #0A0A0A">
                        <label for="recipient-name" class="control-label">{{trans('admin.status')}}</label>
                        {!! Form::select('status', ['sent'=>(trans('admin.sent')),
                'recieved'=>(trans('admin.recieved')),'done'=>(trans('admin.done')) ]
                        , $order->status, ['class'=>'form-control','required']) !!}
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
@section('scripts')
@endsection
