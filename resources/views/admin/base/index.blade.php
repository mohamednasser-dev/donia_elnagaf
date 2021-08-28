@extends('admin_temp')
@section('style')
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css/colors/default-dark.css')}}" id="theme" rel="stylesheet">

@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.bases')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.bases')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button alt="default" data-toggle="modal" data-target="#responsive-modal"
                            class="btn btn-info btn-bg">
                        {{trans('admin.add_bases')}}
                    </button>

                </div>
                <div class="card-body">
                    <!-- Start home table -->
                        <table id="example23" class="table display table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">{{trans('admin.name')}}</th>
                                <th class="text-center">{{trans('admin.category')}}</th>
                                <th class="text-center">{{trans('admin.quantity')}}</th>
{{--                                <th class="text-center">{{trans('admin.alarm_quantity')}}</th>--}}
                                <th class="text-center">{{trans('admin.price')}}</th>
                                <th class="text-center">{{trans('admin.purchas_price')}}</th>
                                <th class="text-center">{{trans('admin.barcode')}}</th>
                                <th class="text-center">{{trans('admin.measur_unit')}}</th>
                                <th class="text-center">{{trans('admin.employee')}}</th>
                                <th class="text-center">{{trans('admin.actions')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($bases as $user)
                                <tr>
                                    <td class="text-center">{{$user->name}}</td>
                                    <td class="text-center">{{$user->Category->name}}</td>
                                    <td class="text-center">{{$user->quantity}}</td>
{{--                                    <td class="text-center">{{$user->alarm_quantity}}</td>--}}
                                    <td class="text-center">{{$user->price}}</td>
                                    <td class="text-center">{{$user->purchas_price}}</td>
                                    <td class="text-center">{{$user->barcode}}</td>
                                    <td class="text-center">{{$user->measur_unit}}</td>
                                    <td class="text-center">{{$user->employee->name}}</td>


                                    <td class="text-lg-center">
                                        <a class='btn btn-raised btn-success btn-circle'
                                           href=" {{url('bases/'.$user->id.'/edit')}}"
                                           data-editid="{{$user->id}}" id="edit"
                                           alt="default" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-edit"></i></a>

                                        <form method="get" id='delete-form-{{ $user->id }}'
                                              action="{{url('bases/'.$user->id.'/delete')}}"
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
                {{$bases->links()}}

                <!-- Add  modal content -->
                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{trans('admin.add_bases')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ Form::open( ['url'  => ['bases'],'method'=>'post' , 'class'=>'form'] ) }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.name')}}</label>
                                        {{ Form::text('name',null,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text"
                                               class="control-label">{{trans('admin.category')}}</label>
                                        {{ Form::select('category_id',App\Models\Category::where('type','base')->pluck('name','id'),old('category_id')
                    ,["class"=>"form-control custom-select col-12 " ]) }}


                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.quantity')}}</label>
                                        {{ Form::number('quantity',0,["class"=>"form-control" ,"required",]) }}
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="recipient-name"--}}
{{--                                               class="control-label">{{trans('admin.alarm_quantity')}}</label>--}}
{{--                                        {{ Form::number('alarm_quantity',1,["class"=>"form-control" ]) }}--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.price')}}</label>
                                        {{ Form::number('price',null,["class"=>"form-control" ,"required",]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.purchas_price')}}</label>
                                        {{ Form::number('purchas_price',null,["class"=>"form-control" ,"required",]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.barcode')}}</label>
                                        {{ Form::text('barcode',null,["class"=>"form-control" ,"required",]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.measur_unit')}}</label>
                                        {{ Form::text('measur_unit',null,["class"=>"form-control" ,"required",]) }}
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

                    <!-- /.modal -->
                    {{--edit  modal --}}
                    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{trans('admin.edit_base')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ Form::open( ['url'  => ['editbases'],'method'=>'post' , 'class'=>'form'] ) }}
                                    {{ csrf_field() }}
                                    {{ Form::hidden('id',null,["class"=>"form-control" ,"required",'id'=>'id']) }}

                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.name')}}</label>
                                        {{ Form::text('name',null,["class"=>"form-control" ,"required",'id'=>'name']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">{{trans('admin.category')}}</label>
                                        {{ Form::select('category_id',App\Models\Category::where('type','base')->pluck('name','id'),old('category_id')
                    ,["class"=>"form-control custom-select col-12 ",'id'=>'category_id' ]) }}


                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.quantity')}}</label>
                                        {{ Form::number('quantity',0,["class"=>"form-control" ,"required",'id'=>'quantity']) }}
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="recipient-name"--}}
{{--                                               class="control-label">{{trans('admin.alarm_quantity')}}</label>--}}
{{--                                        {{ Form::number('alarm_quantity',1,["class"=>"form-control" ,"required",'id'=>'alarm_quantity']) }}--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.price')}}</label>
                                        {{ Form::number('price',null,["class"=>"form-control" ,"required",'id'=>'price']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.purchas_price')}}</label>
                                        {{ Form::number('purchas_price',null,["class"=>"form-control" ,"required",'id'=>'purchas_price']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.barcode')}}</label>
                                        {{ Form::text('barcode',null,["class"=>"form-control" ,"required",'id'=>'barcode']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.measur_unit')}}</label>
                                        {{ Form::text('measur_unit',null,["class"=>"form-control" ,"required",'id'=>'measur_unit']) }}
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


                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var id;
        $(document).on('click', '#edit', function() {
            id = $(this).data('editid');
            console.log(id);
            $.ajax({
                url: "bases/" + id,
                dataType: "json",
                success: function(html) {
                    $('#id').val(html.data.id);
                    $('#name').val(html.data.name);
                    $('#category_id').val(html.data.category_id);
                    $('#quantity').val(html.data.quantity);
                    // $('#alarm_quantity').val(html.data.alarm_quantity);
                    $('#price').val(html.data.price);
                    $('#purchas_price').val(html.data.purchas_price);
                    $('#barcode').val(html.data.barcode);
                    $('#measur_unit').val(html.data.measur_unit);
                }
            })
        });
    </script>

@endsection

