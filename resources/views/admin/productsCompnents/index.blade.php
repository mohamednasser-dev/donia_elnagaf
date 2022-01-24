@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_products')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_products')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label"></label>
                            <br>
                            <a href="{{url('products/create')}}"
                               class="btn btn-info btn-bg">
                                {{trans('admin.add_product')}}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">بحث بالاسم</label>
                            {{ Form::open( ['route'  => ['product.filter.name'],'method'=>'get'] ) }}
                            <div class="input-group">
                                {{ Form::hidden('category_id',$selected_cat,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.name')]) }}
                                {{ Form::text('search',null,["class"=>"form-control" ,"required",'placeholder'=>trans('admin.name')]) }}
                                <span class="input-group-btn">
                                    <button title="بحث بالاسم" type="submit" id="check-minutes" class="btn waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">بحث بالمخزن</label>
                            {{ Form::open( ['route'  => ['product.filter.cat'],'method'=>'get'] ) }}
                            <div class="input-group">
                                <select name="category_id" class="form-control custom-select">
                                    @foreach(Categories() as $row)
                                        @if($selected_cat == $row->id)
                                            <option value="{{$row->id}}" selected > {{$row->name}} </option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>

                                        @endif
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button title="بحث بالمخزن" type="submit" id="check-minutes" class="btn waves-effect waves-light btn-success"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <table id="table-8344"
                           class="tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle">
                        <thead>
                        <tr>
                            <th class="text-center">{{trans('admin.product_name')}}</th>
                            <th class="text-center">{{trans('admin.quantity')}}</th>
                            <th class="text-center">{{trans('admin.gomla_price')}}</th>
                            <th class="text-center">{{trans('admin.buy_price')}}</th>
                            <th class="text-center">{{trans('admin.barcode')}}</th>
                            <th class="text-center">{{trans('admin.category')}}</th>
                            <th class="text-center">{{trans('admin.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $user)
                            <tr>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->quantity}}</td>
                                <td class="text-center">{{$user->gomla_price}}</td>
                                <td class="text-center">{{$user->selling_price}}</td>
                                <td class="text-center">{{$user->barcode}}</td>
                                <td class="text-center">{{$user->category->name}}</td>
                                <td class="text-lg-center">
                                    <a class='btn btn-raised btn-success btn-circle' title="اضافه منتج جديد بنفس بيانات المنتج المختار"
                                       href="{{route('products.create_duplicate',$user->id)}}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a class='btn btn-raised btn-info btn-circle' title="سحب كمية الى مخزن اخر"
                                       href="" data-toggle="modal" data-target="#sahb-modal"
                                       data-product-id="{{$user->id}}" data-quantity="{{$user->quantity}}"
                                       data-cat="{{$user->category_id}}" id="sahb_btn">
                                        <i class="fa fa-mail-reply-all"></i>
                                    </a>
                                    <a class='btn btn-raised btn-warning btn-circle'
                                       href=" {{url('products/'.$user->id.'/edit')}}"
                                       data-editid="{{$user->id}}" id="edit"><i class="fa fa-edit"></i></a>
                                    <a class='btn btn-raised btn-primary btn-circle' href="javascript:void(this)"
                                       data-product-id="{{$user->id}}" id="add"
                                       data-toggle="modal" data-target="#responsive-modal"><i
                                            class="fa fa-arrow-circle-down fa-arrow-circle-down"></i></a>

                                    <form method="get" id='delete-form-{{ $user->id }}'
                                          action="{{url('products/'.$user->id.'/delete')}}"
                                          style='display: none;'>
                                    {{csrf_field()}}
                                    <!-- {{method_field('delete')}} -->
                                    </form>
                                    <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                        {
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $user->id }}').submit();
                                        }else {
                                        event.preventDefault();
                                        }"
                                            class='btn btn-danger btn-circle' href=" "><i
                                            class="fa fa-trash" aria-hidden='true'>
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $products->appends(request()->input())->links()}}

                </div>
            </div>
        </div>
    </div>

    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('admin.add_quantity')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['url'  => ['addQuantity'],'method'=>'post' , 'class'=>'form'] ) }}
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.quantity')}}</label>

                        {{ Form::number('quantity',null,["class"=>"form-control" ,"required", "min" => "1"]) }}
                        {{ Form::hidden('id',null,["class"=>"form-control" ,"required",'id'=>'pro-id']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        Close
                    </button>
                    {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
    <div id="sahb-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">سحب كمية من مخزن الى مخزن اخر</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route'  => ['product.pull.quantity'],'method'=>'post' , 'class'=>'form'] ) }}
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.quantity')}}</label>
                        {{ Form::number('quantity',null,["class"=>"form-control" ,"required", "min" => "1",'id'=>'txt_sahb_quantity']) }}
                        {{ Form::hidden('product_id',null,["class"=>"form-control" ,"required",'id'=>'txt_product_id']) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">المخزن الاخر</label>
                        {{ Form::select('category_id',App\Models\Category::where('type','product')->pluck('name','id'),old('category_id')
                                   ,["class"=>"form-control custom-select col-12 ",'id'=>'category_id' ]) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        إغلاق
                    </button>
                    {{ Form::submit( 'سحب الكمية' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var id;
        $(document).on('click', '#add', function () {
            id = $(this).data('product-id');
            $('#pro-id').val(id);
        });
        $(document).on('click', '#sahb_btn', function () {
            quantity = $(this).data('quantity');
            product_id = $(this).data('product-id');
            $("#txt_product_id").val(product_id);
            $("#txt_sahb_quantity").val(quantity);
            $('#txt_sahb_quantity').attr('max', quantity);
        });
    </script>
@endsection

