    <aside class="left-sidebar">
            <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li>
                        <a class="waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">{{trans('admin.nav_home')}}</span></a>
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
                            <a class="waves-effect waves-dark" href="{{url('categories')}}" aria-expanded="false"><i class="mdi mdi-animation"></i><span class="hide-menu">{{trans('admin.categories')}}</span></a>
                        </li>
                    @endcan
                    @can('products')
                        <li>
                            @if(Gate::check('products') )
                                <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-account-location"></i><span class="hide-menu">{{trans('admin.nav_products')}}</span></a>
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
                            <a class="waves-effect waves-dark" href="{{url('customer')}}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">{{trans('admin.nav_customers')}}</span></a>
                        </li>
                    @endcan
                    @can('suppliers')
                        <li>
                            <a class="waves-effect waves-dark" href="{{url('supplier')}}" aria-expanded="false"><i class="mdi mdi-account-star-variant"></i><span class="hide-menu">{{trans('admin.nav_suppliers')}}</span></a>
                        </li>
                    @endcan
                    <li>
                        @if(Gate::check('employees') || Gate::check('permissions'))
                            <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-account-location"></i><span class="hide-menu">{{trans('admin.nav_users')}}</span></a>
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
                            <a class="waves-effect waves-dark" href="{{url('accounts')}}" aria-expanded="false"><i class="fa fa-file-code-o"></i><span class="hide-menu">{{trans('admin.nav_account_list')}}</span></a>
                        </li>
                    @endcan
                    @can('bills')
                        <li>
                            <a class="waves-effect waves-dark" href="{{url('buy-bills')}}" aria-expanded="false"><i class="mdi mdi-file-find"></i><span class="hide-menu">{{trans('admin.nav_bills')}}</span></a>
                        </li>
                    @endcan
                    @can('income')
                        <li>
                            <a class="waves-effect waves-dark" href="{{url('income')}}" aria-expanded="false"><i class="mdi mdi-pin"></i><span class="hide-menu">{{trans('admin.nav_income')}}</span></a>
                        </li>
                    @endcan
                    @can('outgoings')
                        <li>
                            <a class="waves-effect waves-dark" href="{{url('outgoing')}}" aria-expanded="false"><i class="mdi mdi-square-inc-cash"></i><span class="hide-menu">{{trans('admin.nav_outgoing')}}</span></a>
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
