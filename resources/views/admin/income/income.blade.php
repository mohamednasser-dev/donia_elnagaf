@extends('admin_temp')
@section('styles')
    <link href="{{ asset('/css/pages/tab-page.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_income')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.nav_income')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ Form::open( ['url' => ['income_search'],'method'=>'post'] ) }}
                            {{ csrf_field() }}
                            <h4 class="card-title">{{trans('admin.Search_area')}}</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="radio-list">
                                        <label class="custom-control custom-radio">
                                            <input id="radio4" name="selected_method" value="daily" type="radio"
                                                   <?php if ($selected_method == 'daily') echo "checked";?> class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span>{{trans('admin.daily')}}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="radio-list">
                                        <label class="custom-control custom-radio">
                                            <input id="radio4" name="selected_method" value="monthly" type="radio"
                                                   <?php if ($selected_method == 'monthly') echo "checked";?> class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span>{{trans('admin.monthly')}}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="custom-control custom-radio">
                                        <input id="radio3" name="selected_method" value="yearly" type="radio"
                                               <?php if ($selected_method == 'yearly') echo "checked";?> class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span>{{trans('admin.yearly')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        {!! Form::date('date',$today,['class'=>'form-control center']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <select id="month" name="month" class="select2 form-control custom-select"
                                                style="width: 100%">
                                            <option value="01" <?php if ($selected_month == '01') echo "selected";?> >
                                                1
                                            </option>
                                            <option value="02" <?php if ($selected_month == '02') echo "selected";?> >
                                                2
                                            </option>
                                            <option value="03" <?php if ($selected_month == '03') echo "selected";?> >
                                                3
                                            </option>
                                            <option value="04" <?php if ($selected_month == '04') echo "selected";?> >
                                                4
                                            </option>
                                            <option value="05" <?php if ($selected_month == '05') echo "selected";?> >
                                                5
                                            </option>
                                            <option value="06" <?php if ($selected_month == '06') echo "selected";?> >
                                                6
                                            </option>
                                            <option value="07" <?php if ($selected_month == '07') echo "selected";?> >
                                                7
                                            </option>
                                            <option value="08" <?php if ($selected_month == '08') echo "selected";?> >
                                                8
                                            </option>
                                            <option value="09" <?php if ($selected_month == '09') echo "selected";?> >
                                                9
                                            </option>
                                            <option value="10" <?php if ($selected_month == '10') echo "selected";?> >
                                                10
                                            </option>
                                            <option value="11" <?php if ($selected_month == '11') echo "selected";?> >
                                                11
                                            </option>
                                            <option value="12" <?php if ($selected_month == '12') echo "selected";?> >
                                                12
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <select id="year" name="year" class="select2 form-control custom-select"
                                                style="width: 100%">
                                            <option
                                                value="2020" <?php if ($selected_year == '2020') echo "selected";?> >
                                                2020
                                            </option>
                                            <option
                                                value="2021" <?php if ($selected_year == '2021') echo "selected";?> >
                                                2021
                                            </option>
                                            <option
                                                value="2022" <?php if ($selected_year == '2022') echo "selected";?> >
                                                2022
                                            </option>
                                            <option
                                                value="2023" <?php if ($selected_year == '2023') echo "selected";?> >
                                                2023
                                            </option>
                                            <option
                                                value="2024" <?php if ($selected_year == '2024') echo "selected";?> >
                                                2024
                                            </option>
                                            <option
                                                value="2025" <?php if ($selected_year == '2025') echo "selected";?> >
                                                2025
                                            </option>
                                            <option
                                                value="2026" <?php if ($selected_year == '2026') echo "selected";?> >
                                                2026
                                            </option>
                                            <option
                                                value="2027" <?php if ($selected_year == '2027') echo "selected";?> >
                                                2027
                                            </option>
                                            <option
                                                value="2028" <?php if ($selected_year == '2028') echo "selected";?> >
                                                2028
                                            </option>
                                            <option
                                                value="2029" <?php if ($selected_year == '2029') echo "selected";?> >
                                                2029
                                            </option>
                                            <option
                                                value="2030" <?php if ($selected_year == '2030') echo "selected";?> >
                                                2030
                                            </option>
                                            <option
                                                value="2031" <?php if ($selected_year == '2031') echo "selected";?> >
                                                2031
                                            </option>
                                            <option
                                                value="2032" <?php if ($selected_year == '2032') echo "selected";?> >
                                                2032
                                            </option>
                                            <option
                                                value="2033" <?php if ($selected_year == '2033') echo "selected";?> >
                                                2033
                                            </option>
                                            <option
                                                value="2034" <?php if ($selected_year == '2034') echo "selected";?> >
                                                2034
                                            </option>
                                            <option
                                                value="2035" <?php if ($selected_year == '2035') echo "selected";?> >
                                                2035
                                            </option>
                                            <option
                                                value="2036" <?php if ($selected_year == '2036') echo "selected";?> >
                                                2036
                                            </option>
                                            <option
                                                value="2037" <?php if ($selected_year == '2037') echo "selected";?> >
                                                2037
                                            </option>
                                            <option
                                                value="2038" <?php if ($selected_year == '2038') echo "selected";?> >
                                                2038
                                            </option>
                                            <option
                                                value="2039" <?php if ($selected_year == '2039') echo "selected";?> >
                                                2039
                                            </option>
                                            <option
                                                value="2040" <?php if ($selected_year == '2040') echo "selected";?> >
                                                2040
                                            </option>
                                            <option
                                                value="2041" <?php if ($selected_year == '2041') echo "selected";?> >
                                                2041
                                            </option>
                                            <option
                                                value="2042" <?php if ($selected_year == '2042') echo "selected";?> >
                                                2042
                                            </option>
                                            <option
                                                value="2043" <?php if ($selected_year == '2043') echo "selected";?> >
                                                2043
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" style="display: block; margin-top: 20px;">
                                    {{ Form::submit( trans('admin.search') ,['class'=>'btn btn-info btn-block']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="{{ asset('assets/images/icon/total2.png') }}" alt="Income"></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.nav_buy')}}</h6>
                                    <h2 class="m-t-0">{{$total_pay}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="{{ asset('assets/images/icon/total2.png') }}" alt="Income"></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">المرتجع</h6>
                                    <h2 class="m-t-0">{{$total_back}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="{{ asset('assets/images/icon/payed.png') }}" alt="Income"></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.nav_outgoing')}}</h6>
                                    <h2 class="m-t-0">{{$total_outgoing}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="{{ asset('assets/images/icon/remain.png') }}" alt="Income"></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.suppliers_accounts')}}</h6>
                                    <h2 class="m-t-0">{{$total_supplierPayment}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="{{ asset('assets/images/icon/expense.png') }}" alt="Income"></div>
                                <div class="align-self-center">
                                    <h6 class="text-muted m-t-10 m-b-0">{{trans('admin.final_safy')}}</h6>
                                    <h2 class="m-t-0">{{$remain}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="html-headings-default" class="row match-height">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home8"
                                                        role="tab"><span>{{trans('admin.nav_buy')}}<i
                                                class="ti-shopping-cart"></i></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#home_back" role="tab"><span>المرتجع<i
                                                class="ti-shopping-cart"></i></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile8"
                                                        role="tab"><span>{{trans('admin.nav_outgoing')}}<i
                                                class="ti-money"></i></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages8" role="tab"><span>{{trans('admin.suppliers_accounts')}}<i
                                                class="ti-user"></i></span></a></li>
                            </ul>
                            <!-- Tab panes -->

                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane p-20 active" id="home8" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="supplier_bases_tbl"
                                               class="table full-color-table full-primary-table">
                                            <thead>
                                            <tr>
                                                <th class="center">{{trans('admin.bill_num')}}</th>
                                                <th class="center">{{trans('admin.customer')}}</th>
                                                <th class="center">{{trans('admin.total')}}</th>
                                                <th class="center">{{trans('admin.pay')}}</th>
                                                <th class="center">{{trans('admin.remain')}}</th>
                                                <th class="center">{{trans('admin.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customer_bills as $user)
                                                <tr>
                                                    <td class="text-lg-center">{{$user->bill_num}}</td>
                                                    <td class="text-lg-center">{{$user->Customer->name}}</td>
                                                    <td class="text-lg-center">{{$user->total}}</td>
                                                    <td class="text-lg-center">{{$user->pay}}</td>
                                                    <td class="text-lg-center">{{$user->remain}}</td>
                                                    <td class="text-lg-center">{{$user->date}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$customer_bills->links()}}
                                    </div>
                                </div>
                                <div class="tab-pane p-20" id="home_back" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="supplier_bases_tbl"
                                               class="table full-color-table full-primary-table">
                                            <thead>
                                            <tr>
                                                <th class="center">{{trans('admin.bill_num')}}</th>
                                                <th class="center">{{trans('admin.customer')}}</th>
                                                <th class="center">{{trans('admin.total')}}</th>
                                                <th class="center">{{trans('admin.pay')}}</th>
                                                <th class="center">{{trans('admin.remain')}}</th>
                                                <th class="center">{{trans('admin.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($customer_bills_back as $user)
                                                <tr>
                                                    <td class="text-lg-center">{{$user->bill_num}}</td>
                                                    <td class="text-lg-center">{{$user->Customer->name}}</td>
                                                    <td class="text-lg-center">{{$user->total}}</td>
                                                    <td class="text-lg-center">{{$user->pay}}</td>
                                                    <td class="text-lg-center">{{$user->remain}}</td>
                                                    <td class="text-lg-center">{{$user->date}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$customer_bills->links()}}
                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="profile8" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table full-color-table full-primary-table">
                                            <thead>
                                            <tr>
                                                <th class="text-lg-center">{{trans('admin.name')}}</th>
                                                <th class="text-lg-center">{{trans('admin.cost')}}</th>
                                                <th class="text-lg-center">{{trans('admin.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($outgoings as $user)
                                                <tr>
                                                    <td class="text-lg-center">{{$user->name}}</td>
                                                    <td class="text-lg-center">{{$user->cost}}</td>
                                                    <td class="text-lg-center">{{$user->date}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$outgoings->links()}}
                                    </div>
                                </div>
                                <div class="tab-pane p-20" id="messages8" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table full-color-table full-primary-table">
                                            <thead>
                                            <tr>
                                                <th class="text-lg-center">{{trans('admin.bill_num')}}</th>
                                                <th class="text-lg-center">{{trans('admin.supplier_name')}}</th>
                                                <th class="text-lg-center">{{trans('admin.money')}}</th>
                                                <th class="text-lg-center">{{trans('admin.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supplierPayments as $user)
                                                <tr>
                                                    <td class="text-lg-center">{{$user->bill_num}}</td>
                                                    <td class="text-lg-center">{{$user->Supplier->name}}</td>
                                                    <td class="text-lg-center">{{$user->pay}}</td>
                                                    <td class="text-lg-center">{{$user->created_at->format('Y-m-d')}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$supplierPayments->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

