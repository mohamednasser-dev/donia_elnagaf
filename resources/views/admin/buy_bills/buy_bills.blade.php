@extends('admin_temp')
@section('styles')
    <link href="{{ asset('/css/select2.css') }}" rel="stylesheet">
    {{--    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />--}}
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_bills')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_bills')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            @if(auth()->user()->type == 'admin')
                <section id="html-headings-default" class="row match-height">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{trans('admin.Search_area')}}</h4>
                                <div class="row">
                                    <div>
                                        {{ Form::open( ['url'  => ['buy-bills'],'method'=>'post' ] ) }}
                                    </div>
                                    <div class="col-md-4" style="text-align: center;">
                                        <div>
                                            <label>{{trans('admin.search_by_bill_num')}}</label>
                                            {!! Form::number('bill_num','',['class'=>'form-control center', 'min' => '1']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="text-align: center;">
                                        <div>
                                            <label>{{trans('admin.search_by_date')}}</label>
                                            {!! Form::date('date',old('date'),['class'=>'form-control center']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="text-align: center;">
                                        <div>
                                            <label>{{trans('admin.search_by_cust_name')}}</label>
                                            {{ Form::select('cust_id',App\Models\Customer::where('status','active')->where('branch_number',auth()->user()->branch_number)->pluck('name','id'),null
                                            ,["class"=>"select2 form-control custom-select" ,'placeholder'=>trans('admin.choose_cust') ]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="display: block; margin-top: 20px;">
                                        {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-info btn-block']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @elseif(auth()->user()->role_id == 2)
                <section id="html-headings-default" class="row match-height">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{trans('admin.Search_area')}}</h4>
                                <div class="row" style="justify-content: center;">
                                    {{ Form::open( ['url'  => ['buy-bills'],'method'=>'post' ] ) }}
                                    <div class="col-md-12" style="text-align: center;">
                                        <div>
                                            <label>{{trans('admin.search_by_date')}}</label>
                                            {!! Form::date('date',old('date'),['class'=>'form-control center']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="display: block; margin-top: 20px;">
                                        {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-info btn-block']) }}
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <div class="card-block">
                                <table id="supplier_bases_tbl" class="table full-color-table full-primary-table">
                                    <thead>
                                    <tr>
                                        <th class="center">{{trans('admin.bill_num')}}</th>
                                        <th class="center">نوع الفاتورة</th>
                                        <th class="center">{{trans('admin.customer')}}</th>
                                        <th class="center">{{trans('admin.total')}}</th>
                                        <th class="center">{{trans('admin.pay')}}</th>
                                        <th class="center">{{trans('admin.remain')}}</th>
                                        <th class="center">{{trans('admin.date')}}</th>
                                        <th class="center">{{trans('admin.reservation_status')}}</th>
                                        <th class="center">{{trans('admin.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customer_bills as $user)
                                        <tr>
                                            <td class="text-lg-center">{{$user->bill_num}}</td>
                                            <td class="text-lg-center">@if($user->type == 'back') فاتورة مرتجع @else
                                                    فاتورة
                                                    بيع @endif </td>
                                            <td class="text-lg-center">{{$user->Customer->name}}</td>
                                            <td class="text-lg-center">{{$user->total}}</td>
                                            <td class="text-lg-center">{{$user->pay}}</td>
                                            <td class="text-lg-center">{{$user->remain}}</td>
                                            <td class="text-lg-center">{{$user->date}}</td>
                                            <td class="text-lg-center">
                                                @if($user->type != 'back')
                                                    <div class="switch">
                                                        <label>
                                                            <input onchange="update_active(this)"
                                                                   value="{{ $user->id }}"
                                                                   type="checkbox" <?php if ($user->reservation == 1) echo "checked";?> >
                                                            <span class="lever switch-col-indigo"></span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-lg-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <div class="dropdown-menu animated lightSpeedIn"
                                                         x-placement="top-start"
                                                         style="position: absolute; transform: translate3d(0px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item"
                                                           href=" {{url('buy-bills/'.$user->id)}}">{{trans('admin.bill_procusts')}}</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a target="_blank" class="dropdown-item"
                                                           href=" {{url('buy-bills/'.$user->id.'/print')}}">{{trans('admin.print_bill')}}</a>
                                                        <a target="_blank" class="dropdown-item"
                                                           href=" {{url('buy-bills-store/'.$user->id.'/print')}}">طباعة
                                                            للمخازن</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $customer_bills->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            console.log(id);
            $.ajax({
                url: "customer/" + id,
                dataType: "json",
                success: function (html) {
                    $('#id').val(html.data.id);
                    $('#name').val(html.data.name);
                    $('#phone').val(html.data.phone);
                    $('#address').val(html.data.address);
                }
            })
        });
    </script>
    <script type="text/javascript">
        function update_active(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('buy-bills.actived') }}', {
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
