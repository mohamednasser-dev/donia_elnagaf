@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.supplier_account')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.supplier_account')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('supplier')}}" >{{trans('admin.nav_suppliers')}}</a> </li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}" >{{trans('admin.nav_home')}}</a> </li>
            </ol>
        </div>
    </div>
        <!-- /.card-header -->
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <!-- Headings -->
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-8">
                    <div class="card col-md-12">
                        <div class="card-body" style="height: 85px;">
                            <div class="card-block" style="margin-top: -40px;">
                                <!-- This form to add new news row in database -->
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-3 col-form-label">{{trans('admin.supplier_name')}}</label>
                                    <div class="col-md-9">
                                      {{ Form::text('name',$supplier->name,["class"=>"form-control" ,"required" , "readonly"]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="{{ asset('assets/images/icon/total2.png') }}" alt="Income"></div>
                                        <div class="align-self-center">
                                            <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.total')}}</h6>
                                            <h2 class="m-t-0">{{$total}}</h2>
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
                                            <h2 class="m-t-0">{{$pay}}</h2>
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
                                            <h2 class="m-t-0">{{$remain}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-body center">
                            <h5 class="center">{{trans('admin.old_payment')}}</h5>
                            {{ Form::open( ['url'  => ['supplier_manula_bill'],'method'=>'post' , 'class'=>'form'] ) }}
                                {{ csrf_field() }}
                                {{ Form::hidden('supplier_id',$supplier->id,["class"=>"form-control" ,"required"]) }}
                                <div class="card-block">
                                    <div class="row col-md-12" >
                                        <div>
                                            <label>{{trans('admin.money')}}</label>
                                            {!! Form::text('remain',null,['class'=>'form-control center']) !!}
                                        </div>
                                    </div>
                                    <div class="row col-md-12" >
                                        <div>
                                            <label>{{trans('admin.notes')}}</label>
                                            {!! Form::text('notes',null ,['class'=>'form-control center' ]) !!}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row col-md-12" >
                                        <button type="submit" class="btn btn-rounded btn-block btn-success">{{trans('admin.public_Save')}}</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </section>
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body center">
                            <div class="card-block">    
                                <table id="myTable" class="table full-color-table full-primary-table">
                                    <thead>
                                        <tr>
                                            <th class="text-lg-center">{{trans('admin.bill_num')}}</th>
                                            <th class="text-lg-center">{{trans('admin.total')}}</th>
                                            <th class="text-lg-center">{{trans('admin.pay')}}</th>
                                            <th class="text-lg-center">{{trans('admin.remain')}}</th>
                                            <th class="text-lg-center">{{trans('admin.date')}}</th>
                                            <th class="text-lg-center">{{trans('admin.notes')}}</th>
                                            <th class="text-lg-center">{{trans('admin.actions')}}</th>
                                            <th class="text-lg-center">{{trans('admin.bill_details')}}</th>
                                            <th class="text-lg-center">{{trans('admin.public_delete')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($supplierSale as $supplierBill)
                                            <tr>
                                                <td class="text-lg-center">{{$supplierBill->bill_num}}</td>
                                                <td class="text-lg-center">{{$supplierBill->total}}</td>
                                                <td class="text-lg-center">{{$supplierBill->pay}}</td>
                                                <td class="text-lg-center">{{$supplierBill->remain}}</td>
                                                <td class="text-lg-center">{{$supplierBill->date}}</td>
                                                <td class="text-lg-center">{{$supplierBill->notes}}</td>
                                                <td class="text-lg-center">
                                                    @if($supplierBill->remain != 0)
                                                        <a class='btn btn-raised btn-success btn-sml'
                                                           data-bill-id="{{$supplierBill->id}}" data-bill-remain="{{$supplierBill->remain}}" id="payment"
                                                           alt="default" data-toggle="modal" data-target="#edit-modal">{{trans('admin.payment')}}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-lg-center">
                                                    @if($supplierBill->bill_num > 0 )
                                                        <a  class="btn btn-secondary btn-circle" href=" {{url('supplier/'.$supplierBill->id.'/show_bill')}}">
                                                            <i class="fa fa-eye"></i> 
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-lg-center">
                                                    @if($supplierBill->bill_num > 0 )
                                                    @else
                                                        <form method="get" id='delete-form-{{ $supplierBill->id }}'
                                                              action="{{url('supplier_payment/'.$supplierBill->id.'/delete')}}"
                                                              style='display: none;'>
                                                            {{csrf_field()}}
                                                            <!-- {{method_field('delete')}} -->
                                                        </form>
                                                        <button onclick="
                                                            if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                                            {
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $supplierBill->id }}').submit();
                                                            }else {
                                                                event.preventDefault();
                                                            }"
                                                            class='btn btn-danger btn-circle' href=" ">
                                                            <i class="fa fa-trash" aria-hidden='true'></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> 
                                {{$supplierSale->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.modal -->
    {{--edit  modal --}}
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('admin.payment')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                 {{ Form::open( ['url'  => ['supplier_payment'],'method'=>'post' , 'class'=>'form'] ) }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{ Form::hidden('bill_id',null,["class"=>"form-control" ,"required",'id'=>'txt_bill_id']) }}
                        {{ Form::hidden('supplier_id',$supplier->id,["class"=>"form-control" ,"required"]) }}
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">{{trans('admin.money')}}</label>
                            {{ Form::number('money',null,["class"=>"form-control center" ,"required",'id'=>'txt_money','min'=> '1','max'=> '']) }}
                        </div>
                        
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">{{trans('admin.notes')}}</label>
                            {{ Form::text('notes',null,["class"=>"form-control center" ,'id'=>'notes']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ Form::submit( trans('admin.payment') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> {{trans('admin.close')}} </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var id;
        $(document).on('click', '#payment', function() {
            $("#txt_bill_id").val($(this).data('bill-id'));
            console.log($(this).data('bill-id'));
            $("#txt_money").val($(this).data('bill-remain'));
            $('#txt_money').attr('max', $(this).data('bill-remain'));
        });
    </script>
@endsection

