<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <style>
        body {
            font-family: 'Droid Arabic Kufi', serif !important;
            font-size: 48px;
        }
    </style>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
    <title>{{settings()->name}}</title>
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/myStyles.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/pages/dashboard1.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/pages/card-page.css') }}" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    @yield('styles')
</head>
<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">{{settings()->name}}</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->

</div>
</nav>
</header>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i
                            class="mdi mdi-home"></i><span class="hide-menu">{{trans('admin.nav_home')}}</span></a>
                </li>
                @can('buy part')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('buy/part')}}" aria-expanded="false">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">{{trans('admin.nav_buy')}}</span>
                        </a>
                    </li>
                @endcan
                @can('buy back')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('buy/back')}}" aria-expanded="false">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">{{trans('admin.nav_buy_back')}}</span>
                        </a>
                    </li>
                @endcan
                @can('categories')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('categories')}}" aria-expanded="false"><i
                                class="mdi mdi-animation"></i><span
                                class="hide-menu">{{trans('admin.categories')}}</span></a>
                    </li>
                @endcan
                @can('products')
                    <li>
                        @if(Gate::check('products') )
                            <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i
                                    class="mdi mdi-account-location"></i><span
                                    class="hide-menu">{{trans('admin.nav_products')}}</span></a>
                        @endif
                        <ul aria-expanded="false" class="collapse">
                            @can('products')
                                <li><a href="{{url('products')}}">رؤية المنتجات</a></li>
                            @endcan
                            <li><a href="{{route('edit.product.price')}} ">تعديل السعر بالباركود</a></li>
                            <li><a href="{{route('product.history')}} ">حركة المنتاجات</a></li>
                        </ul>
                    </li>
                @endcan


                @can('customers')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('customer')}}" aria-expanded="false"><i
                                class="mdi mdi-account-multiple"></i><span
                                class="hide-menu">{{trans('admin.nav_customers')}}</span></a>
                    </li>
                @endcan
                @can('suppliers')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('supplier')}}" aria-expanded="false"><i
                                class="mdi mdi-account-star-variant"></i><span
                                class="hide-menu">{{trans('admin.nav_suppliers')}}</span></a>
                    </li>
                @endcan
                <li>
                    @if(Gate::check('employees') || Gate::check('permissions'))
                        <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i
                                class="mdi mdi-account-location"></i><span
                                class="hide-menu">{{trans('admin.nav_users')}}</span></a>
                    @endif
                    <ul aria-expanded="false" class="collapse">
                        @can('employees')
                            <li><a href="{{url('users')}}">{{trans('admin.view_users')}}</a></li>
                        @endcan
                        @can('permissions')
                            <li><a href="{{url('roles')}} ">{{trans('admin.nav_permissions')}}</a></li>
                        @endcan
                        <li><a href="{{route('users.login_history')}} ">سجل الدخول و الخروج</a></li>
                        <li><a href="{{route('users.charts.branch')}}">إحصائيات الانتاجية</a></li>
                    </ul>
                </li>
                @can('Account statement')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('accounts')}}" aria-expanded="false"><i
                                class="fa fa-file-code-o"></i><span
                                class="hide-menu">{{trans('admin.nav_account_list')}}</span></a>
                    </li>
                @endcan
                @can('bills')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('buy-bills')}}" aria-expanded="false"><i
                                class="mdi mdi-file-find"></i><span
                                class="hide-menu">{{trans('admin.nav_bills')}}</span></a>
                    </li>
                @endcan
                @can('income')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('income')}}" aria-expanded="false"><i
                                class="mdi mdi-pin"></i><span class="hide-menu">{{trans('admin.nav_income')}}</span></a>
                    </li>
                @endcan
                @can('outgoings')
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('outgoing')}}" aria-expanded="false"><i
                                class="mdi mdi-square-inc-cash"></i><span
                                class="hide-menu">{{trans('admin.nav_outgoing')}}</span></a>
                    </li>
                @endcan
                <li>
                    <a class="waves-effect waves-dark" href="{{url('settings')}}" aria-expanded="false">
                        <i class="mdi mdi-settings"></i><span class="hide-menu">الإعدادات</span></a>
                    {{--                        ti-settings text-white--}}
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<div class="page-wrapper">
@include('layouts.errors')
@include('layouts.messages')
<!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-body printableArea">
                    <hr>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="">الرقم :</td>
                                        <td class="">{{$CustomerBill->bill_num}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">تحريرا في :</td>
                                        <td class="">{{$CustomerBill->date}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">المطلوب من العميل :</td>
                                        <td class="">{{$CustomerBill->Customer->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">العنوان :</td>
                                        <td class="">{{$CustomerBill->Customer->address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">اسم البائع :</td>
                                        <td class="">{{$CustomerBill->Saler_man->name}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <table class="">
                                    <tbody>
                                    <tr>
                                        <td class="">ت :</td>
                                        <td class="">{{$CustomerBill->Customer->phone}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('/assets/images/logo.png') }}" alt="homepage" class="dark-logo"
                                 style="width: 200px; height: 120px;"/>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-lg-center">{{trans('admin.product_bill')}}</th>
                                        <th class="text-lg-center">{{trans('admin.quantity_bill')}}</th>
                                        <th class="text-lg-center">{{trans('admin.price_bill')}}</th>
                                        <th class="text-lg-center">{{trans('admin.total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($BillProduct as $product)
                                        <tr>
                                            <td class="text-center">{{$product->name}}</td>
                                            <td class="text-center">{{$product->quantity}}</td>
                                            <td class="text-center">{{$product->price}}</td>
                                            <td class="text-center">{{$product->total}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td class="text-center">{{trans('admin.sale_remain')}}</td>
                                        <td class="text-center">{{trans('admin.sale_pay')}}</td>
                                        <td class="text-center">{{trans('admin.sale_total')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{$CustomerBill->remain}}</td>
                                        <td class="text-center">{{$CustomerBill->pay}}</td>
                                        <td class="text-center">{{$CustomerBill->total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-center">الفرع الثاني</td>
                                        <td class="text-center"></td>
                                        <td class="text-center">الفرع الاول</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">شارع السلام متفرع من شارع المحافظة و شارع مجمع المصالح -
                                            الزقازيق
                                        </td>
                                        <td class="text-center">رقم الواتس</td>
                                        <td class="text-center"> شارع نعيم متفرع من شارع الجلاء - الزقازيق</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">01020074409 - 0552359013</td>
                                        <td class="text-center">01064502658</td>
                                        <td class="text-center"> 01091428014 - 0552348182</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ URL::previous() }}">{{trans('admin.back')}}</a>
                    <button id="print" class="btn btn-default btn-outline" type="button"><span><i
                                class="fa fa-print"></i> {{trans('admin.print')}}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer"> © 2021 mo nasser</footer>
</div>
</div>
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('/js/waves.js') }}"></script>
<script src="{{ asset('/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('/js/custom.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/d3/d3.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/c3-master/c3.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
<script src="{{ asset('/js/dashboard1.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('/assets/plugins/toastr/toastr.js') }}"></script>
<script src="{{ asset('/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="{{ asset('/js/jquery.PrintArea.js') }}" type="text/JavaScript"></script>

<script>
    $(document).ready(function () {
        $("#print").click(function () {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>
<script src="{{ asset('/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
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
        buttons: [],
        "language": {
            "paginate": {
                "next": "{{trans('admin.next')}}",
                "previous": "{{trans('admin.befor')}}"
            },
            "search": "{{trans('admin.search')}}:",
            "lengthMenu": " ",
        },
    });


</script>
<script type="text/javascript">
    function update_branch_number(el) {
        if (el.checked) {
            var status = 1;
        } else {
            var status = 2;
        }
        $.post('{{ route('admin.update.branch') }}', {
            _token: '{{ csrf_token() }}',
            id: el.value,
            status: status
        }, function (data) {
            if (data == 1) {
                toastr.success("تم تغير الفرع بنجاح");
                location.reload();
            } else {
                toastr.error("لم يتم تغير الفرع");
            }
        });
    }
</script>
</body>
</html>

