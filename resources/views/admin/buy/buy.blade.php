@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            @if($type == 'part')
                <h3 class="text-themecolor">{{trans('admin.nav_buy')}}</h3>
            @elseif($type == 'gomla')
                <h3 class="text-themecolor">{{trans('admin.nav_buy_gomla')}}</h3>
            @elseif($type == 'back')
                <h3 class="text-themecolor">{{trans('admin.nav_buy_back')}}</h3>
            @endif
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                @if($type == 'part')
                    <li class="breadcrumb-item">{{trans('admin.nav_buy')}}</li>
                @elseif($type == 'gomla')
                    <li class="breadcrumb-item">{{trans('admin.nav_buy_gomla')}}</li>
                @elseif($type == 'back')
                    <li class="breadcrumb-item">{{trans('admin.nav_buy_back')}}</li>
                @endif
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <!-- Headings -->
            {{ Form::hidden('user_type',auth()->user()->type,["class"=>"form-control center" , "required",'id'=>'txt_user_type']) }}

            {{ Form::open( ['url' => ['cust_bills'],'method'=>'post'] ) }}
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body" style="height: 85px;">
                                    <div class="card-block" style="margin-top: -40px;">
                                        <!-- This form to add new news row in database -->
                                        <div class="form-group m-t-40 row">
                                            <label for="example-text-input"
                                                   class="col-md-2 col-form-label">{{trans('admin.bill_num')}}</label>
                                            <div class="col-md-2">
                                                {{ Form::hidden('type',$type,["class"=>"form-control center" , "required"]) }}
                                                {{ Form::text('bill_num',$bill_num,["class"=>"form-control center" , "id" => "txt_bill_num", "required" , "readonly"]) }}
                                            </div>
                                            <label for="example-text-input"
                                                   class="col-md-2 col-form-label">{{trans('admin.cust_name')}}</label>
                                            <div class="col-md-3">
                                                <div id="parent" class="input-group">
                                                    @if($customer_bills_selected != null)
                                                        {{--                                                        <select  class="itemName2 form-control" style="text-align-last: right;"--}}
                                                        {{--                                                                 name="cust_id">--}}
                                                        {{--                                                        </select>--}}
                                                        {{ Form::select('cust_id',App\Models\Customer::where('status','active')->where('branch_number',auth()->user()->branch_number)->pluck('name','id'),$customer_bills_selected->cust_id
                                                          ,["class"=>"select2 form-control custom-select" ,"id"=>"cmb_cust_id","style"=>"width: 100%; height:36px;",'placeholder'=>trans('admin.choose_cust') ]) }}

                                                    @else
                                                        {{ Form::select('cust_id',App\Models\Customer::where('status','active')->where('branch_number',auth()->user()->branch_number)->pluck('name','id'),null
                                                          ,["class"=>"select2 form-control custom-select" ,"id"=>"cmb_cust_id",'placeholder'=>trans('admin.choose_cust') ]) }}

                                                    @endif
                                                    <span class="input-group-btn">
                                                        <a href="" title="اضافة عميل جديد" data-toggle="modal"
                                                           data-target="#responsive-modal"
                                                           class="btn waves-effect waves-light btn-success"><i
                                                                class="fa fa-plus"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit"
                                                        class="btn waves-effect waves-light btn-rounded btn-outline-primary">{{trans('admin.open_new_bill')}}</button>
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
            @if($customer_bills_selected != null && $customer_bills_selected->emp_id == null)
                {{ Form::hidden('type',$type ,["class"=>"form-control" ,"required",'id'=>'txt_type']) }}
                <section id="html-headings-default" class="row match-height">
                    <div class="col-sm-12 col-md-9">
                        <div class="card col-md-12">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>{{trans('admin.products')}}</h4>
                                <div class="card-block">
                                    <!-- This form to add new news row in database -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <label>{{trans('admin.search_by_product_barcode_name')}}</label>
                                                {!! Form::text('name',null,['class'=>'form-control center','id' => 'search_product']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h3 align="center">{{trans('admin.total_data')}}<span id="total_records"></span>
                                        </h3>
                                        <table id="search_table" class="table color-table warning-table">
                                            <thead>
                                            <tr>
                                                <th class="text-lg-center">{{trans('admin.product_name')}}</th>
                                                <th class="text-lg-center">{{trans('admin.barcode')}}</th>
                                                <th class="text-lg-center">{{trans('admin.quantity')}}</th>
                                                <th class="text-lg-center">{{trans('admin.category')}}</th>
                                                <th class="text-lg-center">{{trans('admin.price')}}</th>
                                                <th class="text-lg-center">{{trans('admin.sale')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- This form to add new news row in database -->
                        <div class="card col-md-12">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>{{trans('admin.bill_procusts')}}</h4>
                                <div class="card-block">
                                    {{ Form::open( ['url' => ['bill_products/'.$customer_bills_selected->id.'/destroy_all'],'method'=>'post'] ) }}
                                    {{ Form::hidden('type',$type,["class"=>"form-control" ,"required",'id'=>'txt_type']) }}
                                    <button type="submit" class="btn btn-outline-danger btn-rounded">
                                        <i class="fa fa-trash"></i>
                                        {{trans('admin.delete_all')}}
                                    </button>
                                    {{ Form::close() }}
                                    <br>
                                    <table id="bill_product_tbl" class="table full-color-table full-primary-table">
                                        <thead>
                                        <tr>
                                            <th class="text-lg-center">{{trans('admin.product_name')}}</th>
                                            <th class="text-lg-center">{{trans('admin.category')}}</th>
                                            <th class="text-lg-center">{{trans('admin.barcode')}}</th>
                                            <th class="text-lg-center">{{trans('admin.quantity')}}</th>
                                            <th class="text-lg-center">{{trans('admin.price')}}</th>
                                            <th class="text-lg-center">{{trans('admin.total')}}</th>
                                            <th class="text-lg-center">{{trans('admin.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customer_bills_products as $product)
                                            <tr>
                                                <td class="text-lg-center">{{$product->name}}</td>
                                                <td class="text-lg-center">{{$product->Product->Category->name}}</td>
                                                <td class="text-lg-center">{{$product->Product->barcode}}</td>
                                                <td class="text-lg-center">{{$product->quantity}}</td>
                                                <td class="text-lg-center">{{$product->price}}</td>
                                                <td class="text-lg-center">{{$product->total}}</td>
                                                <td class="text-lg-center">
                                                    <form method="get" id='delete-form-{{ $product->id }}'
                                                          action="{{url('buy/'.$product->id.'/delete')}}"
                                                          style='display: none;'>
                                                    {{csrf_field()}}
                                                    {{ Form::hidden('type',$type,["class"=>"form-control" ,"required",'id'=>'txt_type']) }}
                                                    <!-- {{method_field('delete')}} -->
                                                    </form>
                                                    <button
                                                        onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                                            {
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{ $product->id }}').submit();
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>{{trans('admin.finish_bill')}}</h4>
                                {{ Form::open( ['url' => ['buy_bill_design/'.$customer_bills_selected->id.'/print'],'target' => '_blank','method'=>'post'] ) }}
                                <table class="table vm font-14">
                                    <tr>
                                        {{ Form::select('emp_id',$emps,$customer_bills_selected->emp_id
                                        ,["class"=>"select2 form-control custom-select" ,"id"=>"cmb_cust_id","style"=>"width: 100%; height:36px;","required",'placeholder'=>trans('admin.choose_emp') ]) }}
                                    </tr>
                                    <tr>
                                        <td class="col-md-5">{{trans('admin.sale_total')}}</td>
                                        <td class="col-md-7 text-right font-medium b-0"><input type="text" name="total"
                                                                                               id="lbl_total"
                                                                                               class='form-control center'
                                                                                               value="{{$customer_bills_selected->total}}"
                                                                                               readonly></td>
                                    </tr>
                                    @if(auth()->user()->type == 'admin')
                                        <tr>
                                            <td class="col-md-5">الخصم</td>
                                            <td class="col-md-7 text-right font-medium">
                                                {!! Form::number('khasm',$customer_bills_selected->khasm,['class'=>'form-control center','step' =>'0.01','id' =>'txt_khasm','max'=>$customer_bills_selected->total,'min'=>'0' ]) !!}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="col-md-5">{{trans('admin.sale_pay')}}</td>
                                        <td class="col-md-7 text-right font-medium">{!! Form::number('pay',$customer_bills_selected->pay,['class'=>'form-control center','step' =>'0.01','id' =>'txt_pay','max'=>$customer_bills_selected->total,'min'=>'0' ]) !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-5">{{trans('admin.sale_remain')}}</td>
                                        <td class="col-md-7 text-right font-medium"><input id="lbl_remain" name="remain"
                                                                                           type="text"
                                                                                           class='form-control center'
                                                                                           value="{{$customer_bills_selected->remain}}"
                                                                                           readonly></input></td>
                                    </tr>
                                </table>
                                <div class="card-body text-center">
                                    @if($type != 'back')
                                        <div class="switch">
                                            <label>
                                                <input name="reservation" type="checkbox"
                                                       @if($customer_bills_selected->reservation == '1') checked @endif ><span
                                                    class="lever switch-col-light-green"></span> الحجز </label>
                                        </div>
                                    @endif
                                    <button type="submit"
                                            class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">
                                        <i class="fa fa-print"></i>
                                        @if($customer_bills_selected->emp_id == null)
                                            {{trans('admin.public_Save')}}
                                        @else
                                            {{trans('admin.print')}}
                                        @endif
                                    </button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
    <!-- Add  modal content -->
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('admin.add_customer')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['url'  => ['customer'],'method'=>'post' , 'class'=>'form'] ) }}
                    <div class="form-group">
                        <label for="recipient-name"
                               class="control-label">{{trans('admin.name')}}</label>
                        {{ Form::text('name',null,["class"=>"form-control" ,"required"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name"
                               class="control-label">{{trans('admin.phone')}}</label>
                        {{ Form::text('phone',null,["class"=>"form-control" ,"required"]) }}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name"
                               class="control-label">{{trans('admin.address')}}</label>
                        {{ Form::text('address',null,["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                        {{trans('admin.public_Cancel')}}
                    </button>
                    {{ Form::submit( trans('admin.public_Add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <!-- /.modal -->
    @if($customer_bills_selected != null)
        {{--edit  modal --}}
        <div id="sale-modal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans('admin.add_sale')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                        </button>
                    </div>
                    {{ Form::open( ['method'=>'post' ,'route'=>'buy.store'] ) }}
                    <div class="modal-body">
                        <span id="form_output"></span>
                        {{ Form::hidden('type',$type,["class"=>"form-control" ,"required",'id'=>'txt_type']) }}
                        {{ Form::hidden('product_id',null,["class"=>"form-control" ,"required",'id'=>'txt_product_id']) }}
                        {{ Form::hidden('bill_id',$customer_bills_selected->id ,["class"=>"form-control" ,"required",'id'=>'txt_bill_id']) }}
                        <div class="form-group">
                            <label for="recipient-name"
                                   class="control-label">{{trans('admin.quantity')}}</label>
                            {{ Form::number('quantity',null,["class"=>"form-control" ,"required",'id'=>'txt_quantity','min'=>'1']) }}
                        </div>
                        <div class="form-group">
                            <label for="recipient-name"
                                   class="control-label">{{trans('admin.price')}}</label>
                            {{ Form::number('price',null,["class"=>"form-control" ,"required",'step' =>'0.01','id'=>'txt_price','min'=>'1']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                            {{trans('admin.close')}}
                        </button>
                        <input type="hidden" name="button_action" id="button_action" value="insert"/>
                        @if($type == 'back')
                            {{ Form::submit( trans('admin.back_product') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                        @else
                            {{ Form::submit( trans('admin.sale') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                        @endif
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    @if($customer_bills_selected != null)
        <script>
            var type;
            $(document).ready(function () {
                fetch_product_data();

                function fetch_product_data(query = '') {
                    type = document.getElementById("txt_type").value;
                    $.ajax({
                        url: "{{ url('live_search/products') }}",
                        method: 'GET',
                        data: {query: query, type: type},
                        dataType: 'json',
                        success: function (data) {
                            $('#search_table tbody').html(data.table_data);
                            $('#total_records').text(data.total_data);
                        }
                    });
                }

                $(document).on('keyup', '#search_product', function () {
                    var query = $(this).val();
                    fetch_product_data(query);
                });
                var product_id;
                var bill_id;
                var quantity;
                var selected_Date;
                var selected_price;
                var pay;
                var khasm;
                var remain;
                var khasmtotla;
                var total;
                var final_total;
                $(document).on('click', '#sale_btn', function () {
                    product_id = $(this).data('product-id');
                    selected_price = $(this).data('price');
                    quantity = $(this).data('quantity');
                    type = document.getElementById("txt_type").value;
                    $("#txt_product_id").val(product_id);
                    $("#txt_price").val(selected_price);
                    if (type != 'back') {
                        $('#txt_quantity').attr('max', quantity);
                    }
                });
                $(document).on('keyup', '#txt_pay', function () {
                    //To View Updated remain value afer pay on view
                    pay = document.getElementById("txt_pay").value;
                    user_type = document.getElementById("txt_user_type").value;
                    if(user_type == 'admin'){
                        khasm = document.getElementById("txt_khasm").value;
                    }else{
                        khasm = 0;
                    }

                    total = document.getElementById("lbl_total").value;
                    khasmtotla = total - khasm;
                    final_total = khasmtotla - pay;
                    $("#lbl_remain").val(final_total);
                });
                $(document).on('keyup', '#txt_khasm', function () {
                    //To View Updated remain value afer pay on view
                    pay = document.getElementById("txt_pay").value;
                    khasm = document.getElementById("txt_khasm").value;
                    total = document.getElementById("lbl_total").value;
                    khasmtotla = total - khasm;
                    final_total = khasmtotla - pay;
                    $("#lbl_remain").val(final_total);
                });
            });

        </script>
        <script type="text/javascript">
            $(function () {
                $('.itemName2').select2({
                    placeholder: '  ابحث باسم العميل او رقم جوال العميل',
                    dir: 'rtl',
                    dropdownParent: $('#parent'),
                    ajax: {
                        url: '/search_customer',
                        dataType: 'json',
                        delay: 1500,
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
        </script>
    @endif
@endsection
