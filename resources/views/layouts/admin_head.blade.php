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
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
{{--                    <a class="navbar-brand" href="index.html">--}}
{{--                        <span>--}}
{{--                            <img src="{{ asset('/assets/images/side_bar_image.png') }}" alt="homepage" class="dark-logo" style="width: 200px; height: 45px;"/>--}}
{{--                        </span>--}}
{{--                    </a>--}}
                </div>
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                                            href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    <li class="nav-item"><a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark"
                                            href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    @if(auth()->user()->type == 'admin')
                        <li class="nav-item dropdown">
                            <div class="switch nav-link dropdown-toggle waves-effect waves-dark">
                                <label>الفرع الاول
                                    <input type="checkbox" onchange="update_branch_number(this)"
                                           @if(auth()->user()->branch_number == 1) checked @endif name="branch_number"><span
                                        class="lever switch-col-indigo"></span>
                                    الفرع الثاني
                                </label>
                            </div>

                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"><img
                                src="{{ asset('/assets/images/users/1.jpg') }}" alt="user" class="profile-pic"/></a>
                        <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="{{ asset('/assets/images/users/1.jpg') }}"
                                                                alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{Auth::user()->name}}</h4>
                                            <p class="text-muted">{{Auth::user()->email}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('viewprofile',Auth::user()->id)}}"><i class="ti-user"></i>الملف الشخصي</a></li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="fa fa-power-off" href="{{ route('logout_user') }}">
                                        {{trans('admin.logout')}}
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
