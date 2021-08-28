
@include('layouts.admin_header')
@include('layouts.admin_head')
@include('sweetalert::alert')
@include('layouts.admin_sidebar')

@yield('content')
{{--@include('layouts.messages')--}}
{{--@include('layouts.errors')--}}

@include('layouts.admin_footer')
