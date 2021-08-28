<table id="bill_product_tbl" class="table full-color-table full-primary-table">
    <thead>
        <tr>
            <th class="text-lg-center">{{trans('admin.product_name')}}</th>
            <th class="text-lg-center">{{trans('admin.barcode')}}</th>
            <th class="text-lg-center">{{trans('admin.quantity')}}</th>
            <th class="text-lg-center">{{trans('admin.price')}}</th>
            <th class="text-lg-center">{{trans('admin.total')}}</th>
            <th class="text-lg-center">{{trans('admin.actions')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customer_bills_products as $product)
        <tr>
            <td class="text-lg-center">{{$product->name}}</td>
            <td class="text-lg-center">{{$product->Product->barcode}}</td>
            <td class="text-lg-center">{{$product->quantity}}</td>
            <td class="text-lg-center">{{$product->price}}</td>
            <td class="text-lg-center">{{$product->total}}</td>
            <td class="text-lg-center">
                <form method="get" id='delete-form-{{ $product->id }}'
                    action="{{url('buy/'.$product->id.'/delete')}}"
                    style='display: none;'>
                    {{csrf_field()}}
                    <!-- {{method_field('delete')}} -->
                </form>
                <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                    {
                    event.preventDefault();
                    document.getElementById('delete-form-{{ $product->id }}').submit();
                    }else {
                    event.preventDefault();
                    }"
                        class='btn btn-danger btn-circle' href=" ">
                        <i class="fa fa-trash" aria-hidden='true'></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> 