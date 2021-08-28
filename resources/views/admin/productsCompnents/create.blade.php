@extends('admin_temp')
@section('content')
    <div class="row page-titles" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.add_product')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.add_product')}}</li>
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
                    {{ Form::open( ['url' => ['products'],'method'=>'post',  'class'=>'form' , 'files'=>true] ) }}
                    {{ csrf_field() }}
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.product_name')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('name',old('name'),["class"=>"form-control" ,"required",'placeholder'=>trans('admin.name')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.quantity')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('quantity',old('quantity'),["class"=>"form-control" ,"required",'placeholder'=>trans('admin.quantity')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.barcode')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('barcode',old('barcode'),["class"=>"form-control" ,"required",'placeholder'=>trans('admin.barcode')]) }}
                            {{--{{ Form::hidden('quantity',0,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.barcode')]) }}--}}
                        </div>
                    </div>
{{--                    <div class="form-group m-t-40 row">--}}
{{--                        <label for="example-text-input"--}}
{{--                               class="col-md-2 col-form-label">{{trans('admin.alarm_quantity')}}</label>--}}
{{--                        <div class="col-md-10">--}}
{{--                            {{ Form::number('alarm_quantity',old('alarm_quantity'),["class"=>"form-control" ,"required",'placeholder'=>trans('admin.alarm_quantity')]) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {{ Form::hidden('price',0,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.price')]) }}
                    {{ Form::hidden('total_cost',0,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.price')]) }}
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.gomla_price')}}</label>
                        <div class="col-md-10">
                            {{ Form::number('gomla_price',old('gomla_percent'),["class"=>"form-control" ,"required",'placeholder'=>trans('admin.gomla_price')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.buy_price')}}</label>
                        <div class="col-md-10">
                            {{ Form::number('selling_price',old('part_percent'),["class"=>"form-control" ,"required",'placeholder'=>trans('admin.buy_price')]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.category')}}</label>
                        <div class="col-md-10">
                            {{ Form::select('category_id',App\Models\Category::where('type','product')->pluck('name','id'),old('category_id')
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
{{--                    <div class="card m-b-20">--}}
{{--                        <div class="card-header" style='text-align:right'><strong> مكونات المنتج </strong>--}}
{{--                            <div class="card-body parent" style='text-align:right' id="parent">--}}
{{--                                <button type='button' value='Add Button' id='addButton'>--}}
{{--                                    <i class="fa fa-plus"></i></button>--}}
{{--                                <div class="panel" style='text-align:right'>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="center">
                        {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var i = 0;

            $("#addButton").click(function () {
                var bases = {!! $bases!!};
                var options = '';
                $.each(bases, function (key, value) {
                    console.log(key);
                    options = options + '<option value="' + value + '">' + key + '</option>';
                });
                var html = '';

                html += ' <div id="" class="form-group row">';
                html += ' <div class="col-sm-6 ">';
                //error here
                    html += '<select class="form-control custom-select col-12 " id="base_id" name="rows[' + i + '][base_id]">' +
                    '<option selected="selected" value="">اختر الماده الخام</option>' + options +

                    '</select></div>';

                html += "<div class='col-sm-6'><input name='rows[" + i + "][quantity]' class='form-control' type='number' step ='0.01' value='0' min='0' placeholder='الكمية'></div>" +
                    "</div>";
                $('#parent').append(html);

                i++;
            });
        });
    </script>
@endsection
