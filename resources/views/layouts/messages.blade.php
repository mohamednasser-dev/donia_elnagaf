
@if(Session::has('success'))
    <div class="col-lg-12 col-md-12">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-success"><i class="fa fa-check-circle"></i> </h3>{{ Session('success') }}
        </div>
    </div>
@endif
@if(Session::has('danger'))
    <div class="col-lg-12 col-md-12">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span> </button>
{{--            <i class="fa fa-check-circle"></i>--}}
            <h3 class="text-success"> </h3>{{ Session('danger') }}
        </div>
    </div>
@endif

@if(Session::has('flash_message'))
    <script>
        swal("Great Job","{{Session::get('flash_message')}}", "success");
    </script>

@endif
