@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_outgoing')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_outgoing')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button data-toggle="modal" data-target="#responsive-modal" class="btn btn-info btn-bg">
                        {{trans('admin.add_outgoings')}}
                    </button>

                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <table id="myTable" class="table full-color-table full-primary-table">
                        <thead>
                        <tr>
                            <th class="text-lg-center">{{trans('admin.name')}}</th>
                            <th class="text-lg-center">{{trans('admin.cost')}}</th>
                            <th class="text-lg-center">{{trans('admin.date')}}</th>
                            <th class="text-lg-center">{{trans('admin.employee')}}</th>
                            <th class="text-lg-center">{{trans('admin.public_delete')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($outgoings as $user)
                            <tr>
                                <td class="text-lg-center">{{$user->name}}</td>
                                <td class="text-lg-center">{{$user->cost}}</td>
                                <td class="text-lg-center">{{$user->date}}</td>
                                <td class="text-lg-center">{{$user->employee->name}}</td>
                                <td class="text-lg-center">
                                    <form method="get" id='delete-form-{{ $user->id }}'
                                          action="{{url('outgoing/'.$user->id.'/delete')}}"
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
                {{$outgoings->links()}}

                <!-- sample modal content -->
                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{trans('admin.add_outgoings')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ Form::open( ['url'  => ['outgoing'],'method'=>'post' , 'class'=>'form'] ) }}
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.outgoing_name')}}</label>
                                        {{ Form::text('name',null,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.cost')}}</label>
                                        {{ Form::number('cost',null,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.date')}}</label>
                                        {{ Form::date('date',$today,["class"=>"form-control" ,"required"]) }}
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
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
@endsection

