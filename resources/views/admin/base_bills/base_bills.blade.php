@extends('admin_temp')
@section('styles')
    <link href="{{ asset('/css/select2.css') }}" rel="stylesheet">
    <style>
        #parent {
            /* can be any value */
            width: 300px;
            text-align: right;
            direction: rtl;
            position: relative;
        }
        #parent .select2-container--open + .select2-container--open {
            left: auto;
            right: 0;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_base_bills')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_base_bills')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}" >{{trans('admin.nav_home')}}</a> </li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <!-- Headings -->
             {{ Form::open( ['url' => ['base_bills'],'method'=>'post'] ) }}
                {{ csrf_field() }}
                <section id="html-headings-default" class="row match-height">
                    <div class="col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body" style="height: 85px;">
                                        <div class="card-block" style="margin-top: -40px;">
                                            <!-- This form to add new news row in database -->
                                            <div class="form-group m-t-40 row">
                                                <label for="example-text-input" class="col-md-3 col-form-label">{{trans('admin.bill_num')}}</label>
                                                <div class="col-md-3">
                                                  {{ Form::text('bill_num',$bill_num,["class"=>"form-control center" , "required" , "readonly"]) }}
                                                </div>
                                                <div class="col-md-4">
                                                  <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary">{{trans('admin.open_new_bill')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body" style="height: 85px;">
                                        <div class="card-block" style="margin-top: -40px;">
                                            <!-- This form to add new news row in database -->
                                            <div class="form-group m-t-40 row">
                                                <label for="example-text-input" class="col-md-3 col-form-label">{{trans('admin.supplier_name')}}</label>
                                                <div class="col-md-9">
                                                    <div id="parent">
                                                        @if($supplier_sales_selected != null)
                                                            {{ Form::select('supplier_id',App\Models\Supplier::where('status','active')->pluck('name','id'),$supplier_sales_selected->supplier_id
                                                              ,["class"=>"select2 form-control custom-select" ,"id"=>"cmb_supplier_id","style"=>"width: 100%; height:36px;",'placeholder'=>trans('admin.choose_supplier') ]) }}
                                                        @else
                                                            {{ Form::select('supplier_id',App\Models\Supplier::where('status','active')->pluck('name','id'),null
                                                              ,["class"=>"select2 form-control custom-select" ,"id"=>"cmb_supplier_id",'placeholder'=>trans('admin.choose_supplier') ]) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            {{ Form::close() }}
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('assets/images/icon/total2.png') }}" alt="Income"></div>
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.total')}}</h6>
                                            @if($supplier_sales_selected != null)
                                                <h2 class="m-t-0">{{$supplier_sales_selected->total}}</h2>
                                            @else
                                                <h2 class="m-t-0">0</h2>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('assets/images/icon/payed.png') }}" alt="Income"></div>
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.pay')}}</h6>
                                            @if($supplier_sales_selected != null)
                                                <h2 class="m-t-0">{{$supplier_sales_selected->pay}}</h2>
                                            @else
                                                <h2 class="m-t-0">0</h2>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('assets/images/icon/remain.png') }}" alt="Income"></div>
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.remain')}}</h6>
                                            @if($supplier_sales_selected != null)
                                                <h2 class="m-t-0">{{$supplier_sales_selected->remain}}</h2>
                                            @else
                                                <h2 class="m-t-0">0</h2>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @if($supplier_sales_selected != null)
                {{ Form::open( ['url' => ['supplier_bill_bases'],'method'=>'post'] ) }}
                {{ csrf_field() }}
                <section id="html-headings-default" class="row match-height">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card m-b-20">
                                    <input type="hidden" name="supplier_id" id=" txt_supplier_name" value="{{$supplier_sales_selected->supplier_id}}">
                                    <input type="hidden" name="supplier_sale_id" id=" txt_supplier_sale_id" value="{{$supplier_sales_selected->id}}">
                                    <div class="card-header" style='text-align:right'><strong> منتجات الفاتورة </strong>
                                        <div class="card-body parent_store" style='text-align:right' id="parent_store">
                                            <button type='button' value='Add Button' id='addButton'>
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <div class="panel" style='text-align:right'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="center">
                    <button type="submit" class="btn btn-info" style="margin:10px" >
                        {{trans('admin.public_Save')}}
                    </button>
                </div>
            {{ Form::close() }}
            @endif
            @if($supplier_bill_bases != null)
                @if(count($supplier_bill_bases) > 0)
                    <section id="html-headings-default" class="row match-height">
                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{trans('admin.supplier_bill')}}</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Start home table -->
                                    <table id="myTable" class="table full-color-table full-primary-table">
                                        <thead>
                                        <tr>
                                            <th class="text-lg-center">{{trans('admin.name')}}</th>
                                            <th class="text-lg-center">{{trans('admin.quantity')}}</th>
                                            <th class="text-lg-center">{{trans('admin.purchas_price')}}</th>
                                            <th class="text-lg-center">{{trans('admin.total')}}</th>
                                            <th class="text-lg-center">{{trans('admin.date')}}</th>
                                            <th class="text-lg-center">{{trans('admin.actions')}}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($supplier_bill_bases as $supplier_base)
                                            <tr>
                                                <td class="text-lg-center">{{$supplier_base->name}}</td>
                                                <td class="text-lg-center">{{$supplier_base->quantity}}</td>
                                                <td class="text-lg-center">{{$supplier_base->purchas_price}}</td>
                                                <td class="text-lg-center">{{$supplier_base->total}}</td>
                                                <td class="text-lg-center">{{$supplier_base->date}}</td>
                                                <td class="text-lg-center">
                                                    <form method="get" id='delete-form-{{ $supplier_base->id }}'
                                                          action="{{url('supplier_bill_bases/'.$supplier_base->id.'/delete')}}"
                                                          style='display: none;'>
                                                    {{csrf_field()}}
                                                    <!-- {{method_field('delete')}} -->
                                                    </form>
                                                    <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                                        {
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $supplier_base->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }"
                                                        class='btn btn-danger btn-circle' href=" ">
                                                        <i class="fa fa-trash" aria-hidden='true'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$supplier_bill_bases->links()}}
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var i = 0;
            $("#addButton").click(function () {
                var bases = {!! $bases!!};
                var options = '';
                $.each(bases, function (key, value) {
                    options = options + '<option value="' + value + '">' + key + '</option>';
                });
                var html = '';
                html += ' <div id="" class="form-group row">';
                html += ' <div class="col-sm-6 ">';
                html += '<select class="select2 form-control custom-select col-12 " id="base_id" name="rows[' + i + '][base_id]">' +
                        '<option selected="selected" value="">أختر المنتج الخام</option>' + options +
                        '</select></div>';
                html += "<div class='col-sm-3'><input name='rows[" + i + "][quantity]' class='form-control' type='number' min='0' value='0' placeholder='{{trans('admin.quantity')}}'></div>" ;

                html += "<div class='col-sm-3'><input name='rows[" + i + "][purchas_price]' class='form-control' type='number' min='0' alue='0' placeholder='{{trans('admin.purchas_price')}}'></div>" +
                        "</div>";
                $('#parent_store').append(html);
                i++;
            });
        });
        $(document).ready(function () {
            $(function () {
                $('.itemName2').select2({
                    placeholder: 'بحث برقم الهاتف او اسم المورد ',
                    dir: 'rtl',
                    dropdownParent: $('#parent'),
                    ajax: {
                        url: '/select2-autocomplete-ajax',
                        dataType: 'json',
                        delay: 500,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
            $(function () {
                $('.itemName').select2({
                    placeholder: 'بحث باسم المنتج الخام او الباركود',
                    dir: 'rtl',
                    dropdownParent: $('#parent'),
                    ajax: {
                        url: '/select2-autocomplete-ajax-base',
                        dataType: 'json',
                        delay: 500,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
            // For select 2
            $(".select2").select2();
            $(".ajax").select2({
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            });
        });
    </script>

@endsection

