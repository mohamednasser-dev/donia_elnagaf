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
                        <div class="card-header">
                            <a target="_blank" href="{{url('buy-bills/'.$id.'/print')}}" class="btn btn-info">
                                <i class="fa fa-print"></i>  طباعة الفاتورة </a>
                            <a target="_blank" href="{{url('buy-bills-store/'.$id.'/print')}}" class="btn btn-warning">
                                <i class="fa fa-print"></i>  طباعة فاتورة للمخازن </a>
                        </div>
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
                                        <th class="center">{{trans('admin.actions')}}</th>
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
                                            <td class="text-lg-center">
                                                <a class='btn btn-raised btn-success btn-circle' href=""
                                                   data-quantity="{{$user->quantity}}" data-price="{{$user->price}}"
                                                   data-toggle="modal" data-target="#edit-modal"
                                                   data-editid="{{$user->id}}" id="edit_btn"><i class="fa fa-edit"></i></a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
{{--    modal--}}
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">تعديل المنتج بالفاتورة</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                {{ Form::open( ['method'=>'post' ,'route'=>'buy-bills.edit_product'] ) }}
                <div class="modal-body">
                    <span id="form_output"></span>
                    {{ Form::hidden('product_id',null,["class"=>"form-control" ,"required",'id'=>'txt_product_id']) }}
                    <div class="form-group">
                        <label for="recipient-name"
                               class="control-label">{{trans('admin.quantity')}}</label>
                        {{ Form::number('quantity',null,["class"=>"form-control" ,"required",'id'=>'txt_quantity','min'=>'0']) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name"
                               class="control-label">{{trans('admin.price')}}</label>
                        {{ Form::number('price',null,["class"=>"form-control" ,"required",'step' =>'0.01','id'=>'txt_price','min'=>'0']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        {{trans('admin.close')}}
                    </button>
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    $(document).on('click', '#edit_btn', function() {
        quantity = $(this).data('quantity');
        price = $(this).data('price');
        editid = $(this).data('editid');
        $("#txt_product_id").val(editid);
        $("#txt_price").val(price);
        $("#txt_quantity").val(quantity);
    });
    </script>
@endsection

