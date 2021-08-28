@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.edit_role')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.edit_role')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('roles')}}">{{trans('admin.nav_permissions')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <form action="{{ route('roles.update_permission', $role->id) }}" method="POST">
        <div class="row">
            @csrf
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label" for="name">{{trans('admin.role_name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="{{trans('admin.name')}}" id="name" name="name" class="form-control" value="{{ $role->name }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-12">
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h5 class="m-b-0 text-white">{{trans('admin.nav_permissions')}}</h5>
                    </div>
                    <br>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-from-label" for="banner"></label>
                            <div class="col-md-8">
                                @foreach($permissions as $permission)
                                <div class="row">
                                    <div class="col-md-10">
                                        @if(app()->getLocale() == 'en')
                                            <label class="col-from-label">{{ $permission->name }}</label>
                                        @elseif(app()->getLocale() == 'ar')
                                            <label class="col-from-label">{{ $permission->name_ar }}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{$permission->name}}" @php if(in_array($permission->id , $r_permissions)) echo "checked"; @endphp>
                                                <span class="lever switch-col-indigo"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                           </div>  
                        </div>
                        <div class="center">
                            <button type="submit" class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">{{trans('admin.public_Edit')}}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection