@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_permissions')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_permissions')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{url('roles/create')}} "
                       class="btn btn-info btn-bg">{{trans('admin.add_new_role')}}</a>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <div class="table-responsive">
                    <table id="myTable" class="table full-color-table full-primary-table">
                         <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th width="10%">{{trans('admin.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{ ($key+1) + ($roles->currentPage() - 1)*$roles->perPage() }}</td>
                                    <td>{{ $role->name}}</td>
                                    <td class="text-lg-center">
                                        <a  class="btn btn-success btn-circle" id="edit" href="{{route( 'roles.edit' , $role->id )}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                {{$roles->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection
