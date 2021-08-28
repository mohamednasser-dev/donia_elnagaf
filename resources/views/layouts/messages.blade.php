
@if(Session::has('success'))
<div class="alert alert-success">
	<p>{{ Session('success') }}</p>
</div>
@endif
@if(Session::has('danger'))
<div class="alert alert-danger">
	<p>{{ Session('danger') }}</p>
</div>
@endif

@if(Session::has('flash_message'))
    <script>
        swal("Great Job","{{Session::get('flash_message')}}", "success");
    </script>

@endif
