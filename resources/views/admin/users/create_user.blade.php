@extends('admin_temp')
@section('content')
  <div class="row page-titles">
      <div class="col-md-5 align-self-center">
          <h3 class="text-themecolor">{{trans('admin.add_new_user')}}</h3>
      </div>
      <div class="col-md-7 align-self-center">
          <ol class="breadcrumb">
               <li class="breadcrumb-item">{{trans('admin.add_new_user')}}</li>
              <li class="breadcrumb-item"><a href="{{url('users')}}">{{trans('admin.nav_users')}}</a></li>
              <li class="breadcrumb-item active"><a href="{{url('home')}}" >{{trans('admin.nav_home')}}</a> </li>
          </ol>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">{{trans('admin.user_info')}}</h4>
                  <hr>          
                  {{ Form::open( ['url'  => ['users'],'method'=>'post' , 'class'=>'form'] ) }}
                  {{ csrf_field() }}
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.name')}}</label>
                        <div class="col-md-10">
                          {{ Form::text('name',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                  </div>
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.email')}}</label>
                        <div class="col-md-10">
                          {{ Form::email('email',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                  </div>
                  <div class="form-group row">
                      <label for="example-password-input" class="col-md-2 col-form-label">{{trans('admin.password')}}</label>
                        <div class="col-md-10">
                          <input class="form-control" type="password" name="password"  id="example-password-input" required>
                        </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('admin.password_confirmation')}}</label>
                      <div class="col-md-10">
                          <input class="form-control" type="password" name="password_confirmation"  id="example-password-input2" required>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('admin.permission')}}</label>
                      <div class="col-md-10">
                        <select name="role_id" required class="form-control custom-select col-12">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="center">
                          {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                  </div>
                   {{ Form::close() }}
              </div>
          </div>
      </div>
  </div>
@endsection

