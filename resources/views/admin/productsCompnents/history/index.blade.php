@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"> حركة المنتجات</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> حركة المنتجات</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">بحث بالمخزن</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ Form::open( ['route'  => ['product.filter.cat.history'],'method'=>'get'] ) }}
                                            <div class="input-group">
                                                <select name="category_id" class="form-control custom-select">
                                                    @foreach(Categories() as $row)
                                                        @if($selected_cat == $row->id)
                                                            <option value="{{$row->id}}"
                                                                    selected> {{$row->name}} </option>
                                                        @else
                                                            <option value="{{$row->id}}">{{$row->name}}</option>

                                                        @endif
                                                    @endforeach
                                                </select>
                                                <span class="input-group-btn">
                                                    <button title="بحث بالمخزن" type="submit" id="check-minutes"
                                                            class="btn waves-effect waves-light btn-success"><i
                                                            class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                            {{ Form::close() }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">الاضافة</h6>
                                            <h2 class="m-t-0">{{$add}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">البيع</h6>
                                            <h2 class="m-t-0">{{$remove}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">الباقي</h6>
                                            <h2 class="m-t-0">{{$remain}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title"> بحث بأسم المنتج</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ Form::open( ['route'  => ['product.filter.product_name.history'],'method'=>'get'] ) }}
                                            <div class="input-group">
                                                <input required type="text" name="product_name" class="form-control">
                                                <span class="input-group-btn">
                                                    <button title="بحث بأسم المنتج" type="submit" id="check-minutes"
                                                            class="btn waves-effect waves-light btn-success"><i
                                                            class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                            {{ Form::close() }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-title">المنتجات</div>
                    <!-- Start home table -->
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">{{trans('admin.product_name')}}</th>
                            <th class="text-center">{{trans('admin.quantity')}}</th>
                            <th class="text-center">{{trans('admin.category')}}</th>
                            <th class="text-center">{{trans('admin.type')}}</th>
                            <th class="text-center">{{trans('admin.notes')}}</th>
                            <th class="text-center">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $row)
                            <tr>
                                <td class="text-center">{{$row->product_name}}</td>
                                <td class="text-center">{{$row->quantity}}</td>
                                <td class="text-center">{{$row->Category->name}}</td>
                                <td class="text-center">@if($row->type == 'add') اضافة @elseif($row->type == 'remove')
                                        بيع @endif</td>
                                <td class="text-center">{{$row->notes}}</td>
                                <td class="text-center">{{$row->created_at->format('Y-m-d')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('admin.add_quantity')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['url'  => ['addQuantity'],'method'=>'post' , 'class'=>'form'] ) }}
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.quantity')}}</label>

                        {{ Form::number('quantity',null,["class"=>"form-control" ,"required", "min" => "1"]) }}
                        {{ Form::hidden('id',null,["class"=>"form-control" ,"required",'id'=>'pro-id']) }}
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
    <div id="sahb-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">سحب كمية من مخزن الى مخزن اخر</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route'  => ['product.pull.quantity'],'method'=>'post' , 'class'=>'form'] ) }}

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">{{trans('admin.quantity')}}</label>
                        {{ Form::number('quantity',null,["class"=>"form-control" ,"required", "min" => "1",'id'=>'txt_sahb_quantity']) }}
                        {{ Form::hidden('product_id',null,["class"=>"form-control" ,"required",'id'=>'txt_product_id']) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">المخزن الاخر</label>
                        {{ Form::select('category_id',App\Models\Category::where('type','product')->pluck('name','id'),old('category_id')
                                   ,["class"=>"form-control custom-select col-12 ",'id'=>'category_id' ]) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        إغلاق
                    </button>
                    {{ Form::submit( 'سحب الكمية' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [5, 'desc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
    <script>
        var id;
        $(document).on('click', '#add', function () {
            id = $(this).data('product-id');
            console.log(id);
            $('#pro-id').val(id);
        });

        $(document).on('click', '#sahb_btn', function () {
            quantity = $(this).data('quantity');
            product_id = $(this).data('product-id');
            console.log(product_id);
            $("#txt_product_id").val(product_id);
            $("#txt_sahb_quantity").val(quantity);
            $('#txt_sahb_quantity').attr('max', quantity);
        });
    </script>
@endsection

