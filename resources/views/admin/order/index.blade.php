@extends('admin_temp')
@section('style')
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css/colors/default-dark.css')}}" id="theme" rel="stylesheet">

@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.order')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.order')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">


                </div>
                <div class="card-body">
                    <!-- Start home table -->
                        <table id="example23" class="table display table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">{{trans('admin.customer')}}</th>
                                <th class="text-center">{{trans('admin.car_type')}}</th>
                                <th class="text-center">{{trans('admin.car_model')}}</th>


                                <th class="text-center">{{trans('admin.bill_type')}}</th>
                                <th class="text-center">{{trans('admin.status')}}</th>

                                <th class="text-center">{{trans('admin.actions')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $user)
                                <tr>
                                    <td class="text-center">{{$user->Customer->name}}</td>
                                    <td class="text-center">{{$user->car_type}}</td>
                                     <td class="text-center">{{$user->car_model}}</td>

                                    <td class="text-center">{{trans('admin.'.$user->bill_type)}} </td>
                                    <td class="text-center">{{trans('admin.'.$user->status)}}</td>


                                    <td class="text-lg-center">
                                        <a class='btn btn-raised btn-success btn-circle'
                                           href=" {{url('orders/'.$user->id.'/edit')}}">
                                            <i class="fa fa-edit"></i></a>

                                        <form method="get" id='delete-form-{{ $user->id }}'
                                              action="{{url('orders/'.$user->id.'/delete')}}"
                                              style='display: none;'>
                                        {{csrf_field()}}
                                        <!-- {{method_field('delete')}} -->
                                        </form>
                                        <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                            {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                            }else {
                                            event.preventDefault();
                                            }"
                                                class='btn btn-danger btn-circle' href=" "><i
                                                class="fa fa-trash" aria-hidden='true'>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                {{$orders->links()}}

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var id;
        $(document).on('click', '#edit', function() {
            id = $(this).data('editid');
            console.log(id);
            $.ajax({
                url: "bases/" + id,
                dataType: "json",
                success: function(html) {
                    $('#id').val(html.data.id);
                    $('#name').val(html.data.name);
                    $('#category_id').val(html.data.category_id);
                    $('#quantity').val(html.data.quantity);
                    $('#alarm_quantity').val(html.data.alarm_quantity);
                    $('#price').val(html.data.price);
                    $('#purchas_price').val(html.data.purchas_price);
                    $('#barcode').val(html.data.barcode);
                    $('#measur_unit').val(html.data.measur_unit);
                }
            })
        });
    </script>

@endsection

