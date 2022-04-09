@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">سجل الدخول و الخروج</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">سجل الدخول و الخروج</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Start home table -->
                    <div class="table-responsive">
                    <table id="myTable" class="table full-color-table full-primary-table">
                         <thead>
                            <tr>
                                <th >#</th>
                                <th >{{trans('admin.name')}}</th>
                                <th >{{trans('admin.type')}}</th>
                                <th >{{trans('admin.date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $row)
                                <tr>
                                    <td>{{ ($key+1) }}</td>
                                    <td>{{ $row->User->name }}</td>
                                    <td>{{ $row->type == 'login' ? 'دخول' : 'خروج' }}</td>
                                    <td>{{ $row->created_at->format('Y-m-d    g:i a') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
