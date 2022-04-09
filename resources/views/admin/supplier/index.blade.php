@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_suppliers')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_suppliers')}}</li>
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
                        {{trans('admin.add_supplier')}}
                    </button>
                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <div class="table-responsive">
                    <table id="example23"
                           class="tablesaw table-striped table-hover table-bordered table tablesaw-columntoggle">
                        <thead>
                        <tr>
                            <th class="text-center">{{trans('admin.name')}}</th>
                            <th class="text-center">{{trans('admin.phone')}}</th>
                            <th class="text-center">{{trans('admin.address')}}</th>
                            <th class="text-center">{{trans('admin.employee')}}</th>
                            <th class="text-center">{{trans('admin.actions')}}</th>
                            <th class="text-center">{{trans('admin.public_delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supllier as $sup)
                            <tr>
                                <td class="text-center">{{$sup->name}}</td>
                                <td class="text-center">{{$sup->phone}}</td>
                                <td class="text-center">{{$sup->address}}</td>
                                <td class="text-center">{{$sup->employee->name}}</td>
                                <td class="text-lg-center">
                                    <a class='btn btn-raised btn-primary btn-sml'
                                       href="{{url('supplier/'.$sup->id.'/account')}}">
                                       {{trans('admin.supplier_account')}}
                                    </a>
                                    <a class='btn btn-raised btn-success btn-circle'
                                       href=" {{url('supplier/'.$sup->id.'/edit')}}"
                                       data-editid="{{$sup->id}}" id="edit"
                                       alt="default" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-edit"></i>
                                   </a>
                                </td>
                                <td class="text-lg-center">
                                    @if(count($sup->SupplierSale) == 0)
                                        <form method="get" id='delete-form-{{ $sup->id }}'
                                              action="{{url('supplier/'.$sup->id.'/delete')}}"
                                              style='display: none;'>
                                            {{csrf_field()}}
                                            <!-- {{method_field('delete')}} -->
                                        </form>
                                        <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                            {
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $sup->id }}').submit();
                                            }else {
                                                event.preventDefault();
                                            }"
                                            class='btn btn-danger btn-circle' href=" ">
                                            <i class="fa fa-trash" aria-hidden='true'></i>
                                        </button>
                                    @else
                                        <div class="switch">
                                            <label>
                                                <input onchange="update_active(this)" value="{{ $sup->id }}" type="checkbox" <?php if($sup->status == 'active') echo "checked";?> >
                                                <span class="lever switch-col-indigo"></span>
                                            </label>
                                        </div>
                                    @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                {{$supllier->links()}}
                <!-- Add  modal content -->
                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{trans('admin.add_supplier')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ Form::open( ['url'  => ['supplier'],'method'=>'post' , 'class'=>'form'] ) }}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.name')}}</label>
                                        {{ Form::text('name',null,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.phone')}}</label>
                                        {{ Form::number('phone',null,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.address')}}</label>
                                        {{ Form::text('address',null,["class"=>"form-control" ,"required"]) }}
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
                                    <h4 class="modal-title">{{trans('admin.edit_sipllier')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ Form::open( ['url'  => ['editsupplier'],'method'=>'post' , 'class'=>'form'] ) }}
                                    {{ csrf_field() }}
                                    {{ Form::hidden('id',null,["class"=>"form-control" ,"required",'id'=>'id']) }}

                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.name')}}</label>
                                        {{ Form::text('name',null,["class"=>"form-control" ,"required",'id'=>'name']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.phone')}}</label>
                                        {{ Form::number('phone',null,["class"=>"form-control" ,"required",'id'=>'phone']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="control-label">{{trans('admin.address')}}</label>
                                        {{ Form::text('address',null,["class"=>"form-control" ,"required",'id'=>'address']) }}
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
                url: "supplier/" + id,
                dataType: "json",
                success: function(html) {
                    $('#id').val(html.data.id);
                    $('#name').val(html.data.name);
                    $('#phone').val(html.data.phone);
                    $('#address').val(html.data.address);
                }
            })
        });
    </script>
    <script type="text/javascript">
      function update_active(el){
            if(el.checked){
                var status = 'active';
            }
            else{
                var status = 'unactive';
            }
            $.post('{{ route('supplier.actived') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    console.log('daaa = '.data);
                    toastr.success("{{trans('admin.statuschanged')}}");
                }
                else{
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
  </script>
@endsection

