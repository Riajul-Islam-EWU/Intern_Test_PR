@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="pt-2">{{ __('Products table') }}</div>
                        <a class="btn btn-info" href="{{ url('/addproduct') }}">
                            {!! '<i
                            class="fas fa-plus-circle"></i>&nbsp;&nbsp;Add
                        new product' !!}
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="mt-3 table table-warning table-hover table-bordered yajra-datatable">
                            <thead>
                                <tr id="">
                                    <td>ID</td>
                                    <td>Product ID</td>
                                    <td>Product Code</td>
                                    <td>Color</td>
                                    <td>Size</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product_id',
                        name: 'product_id'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'size',
                        name: 'size'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });
    </script>

    <script type="text/javascript">
        $('table').on('click', '.delete', function() {
            event.preventDefault();
            let tr = $(this).parent().parent();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                url: $(this).attr('href'),
                type: 'get',
                success: function(response) {
                    tr.remove();
                }
            });
        })
    </script>
@endsection
