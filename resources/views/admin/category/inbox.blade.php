@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.inbox')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.inbox')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">


                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <table class="table full-color-table full-primary-table">
                        <thead>
                        <tr>
                            <th class="text-lg-center">{{trans('admin.username')}}</th>
                            <th class="text-lg-center">{{trans('admin.email')}}</th>
                            <th class="text-lg-center">{{trans('admin.phone')}}</th>
                            <th class="text-lg-center">{{trans('admin.message')}}</th>
                         </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $user)
                            <tr>
                                <td class="text-lg-center">{{$user->user_name}}</td>
                                <td class="text-lg-center">{{$user->email}}</td>
                                <td class="text-lg-center">{{$user->phone}}</td>
                                <td class="text-lg-center">{{$user->message}}</td>

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
                                        الغاء
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

