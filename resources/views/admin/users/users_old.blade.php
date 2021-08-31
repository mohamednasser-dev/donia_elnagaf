



<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <a href="{{url('users/create')}} "
               class="btn btn-info btn-bg">{{trans('admin.add_new_user')}}</a>
        </div>
        <div class="card-body">
            <!-- Start home table -->
            <table id="myTable" class="table full-color-table full-primary-table">
                <thead>
                <tr>
                    <th class="text-lg-center">{{trans('admin.name')}}</th>
                    <th class="text-lg-center">{{trans('admin.email')}}</th>
                    <th class="text-lg-center">{{trans('admin.active')}}</th>
                    <th class="text-lg-center">{{trans('admin.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-lg-center">{{$user->name}}</td>
                        <td class="text-lg-center">{{$user->email}}</td>
                        <td class="text-lg-center">
                            <div class="switch">
                                <label>
                                    <input onchange="update_active(this)" value="{{ $user->id }}" type="checkbox" <?php if($user->status == 'active') echo "checked";?> >
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                        </td>
                        <td class="text-lg-center">
                            <a  class="btn btn-success btn-circle" href=" {{url('users/'.$user->id.'/edit')}}">
                                <i class="fa fa-edit"></i>
                            </a>
                        <!--
                                    <form method="get" id='delete-form-{{ $user->id }}'
                                          action="{{url('users/'.$user->id.'/delete')}}"
                                          style='display: none;'>
                                        {{csrf_field()}}
                        {{method_field('delete')}}
                            </form>
                            <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                        {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                        }else {
                                            event.preventDefault();
                                        }"
                                        class='btn btn-danger btn-circle' href=" ">
                                        <i class="fa fa-trash" aria-hidden='true'></i>
                                    </button>
                                    -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
