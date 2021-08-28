@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.categories')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.categories')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button  alt="default" data-toggle="modal" data-target="#responsive-modal" class="btn btn-info btn-bg" >
                    {{trans('admin.add_category')}}
                    </button>

                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <table class="table full-color-table full-primary-table">
                        <thead>
                        <tr>
                            <th class="text-lg-center">{{trans('admin.category_name')}}</th>
                            <th class="text-lg-center">{{trans('admin.actions')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $user)
                            <tr>
                                <td class="text-lg-center">{{$user->name}}</td>
                                <td class="text-lg-center">
                                    <form method="get" id='delete-form-{{ $user->id }}'
                                          action="{{url('categories/'.$user->id.'/delete')}}"
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
                {{$categories->links()}}

                <!-- sample modal content -->
                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{trans('admin.add_category')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ Form::open( ['url'  => ['categories'],'method'=>'post' , 'class'=>'form'] ) }}
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">{{trans('admin.category_name')}}</label>
                                            {{ Form::text('name',null,["class"=>"form-control" ,"required"]) }}
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="message-text" class="control-label">{{trans('admin.type')}}</label>--}}
{{--                                            {{ Form::select('type', ['base'=>(trans('admin.base')) ,--}}
{{--                                                                    'product'=>(trans('admin.product'))]--}}
{{--                                                                    , old('type'), ['class'=>' custom-select col-12 form-control',null]) }}--}}

{{--                                        </div>--}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                                        {{trans('admin.close')}}
                                    </button>
                                    {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </div>

            </div>
        </div>
    </div>
@endsection

