@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_users')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_users')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{url('users/create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add_new_user')}}</a>
    </div>
    <br>
    <div class="row">
        @foreach($users as $user)
            <div class="col-lg-3 col-xlg-3">
                <div class="card">
                    <div class="card-body little-profile text-center">
                        <div class="pro-img m-t-20"><img src="{{$user->image}}" alt="user"></div>
                        <h3 class="m-b-0">{{$user->name}}</h3>
                        <ul class="list-inline soc-pro m-t-30">
                            <li><a title="تعديل" href="{{url('users/'.$user->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                            <li><a title="التفاصيل" href="{{route('users.details',$user->id)}}"><i class="fa fa-eye"></i></a></li>
                            <li><a title="حذف" onclick="return confirm('{{trans('admin.are_y_sure_delete')}}')"
                                   href="{{route('users.delete',$user->id)}}"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function update_active(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'unactive';
            }
            $.post('{{ route('users.actived') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    toastr.success("{{trans('admin.statuschanged')}}");
                } else {
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
    </script>
@endsection
