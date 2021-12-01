<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}">
    <title>Admin Pro Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/css/pages/error-pages.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fix-header card-no-border fix-sidebar">
<section id="wrapper" class="error-page">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">{{trans('admin.product_name')}}</th>
                                    <th class="text-center">{{trans('admin.quantity')}}</th>
                                    <th class="text-center">{{trans('admin.gomla_price')}}</th>
                                    <th class="text-center">{{trans('admin.buy_price')}}</th>
                                    <th class="text-center">{{trans('admin.barcode')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $user)
                                    <tr>
                                        <td class="text-center">{{$user->name}}</td>
                                        <td class="text-center">{{$user->quantity}}</td>
                                        <td class="text-center">{{$user->gomla_price}}</td>
                                        <td class="text-center">{{$user->selling_price}}</td>
                                        <td class="text-center">{{$user->barcode}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/waves.js') }}"></script>
<script>
    $(document).ready(function () {
        window.print();
    });
</script>
</body>
</html>
