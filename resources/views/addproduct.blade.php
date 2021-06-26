@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="saveproducts" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <div class="form-group d-flex pt-5">
                                    <label class="pt-2" for="productname">New Product Name:&nbsp;&nbsp;</label>
                                    <input type="text" name="productname" class="form-control mb-5 w-50"
                                        placeholder="Enter new product name" required>
                                </div>
                                <table id="dynamic_table" class="mt-3 table table-info table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>Product Code</td>
                                            <td>Color</td>
                                            <td>Size</td>
                                            <td>Quantity</td>
                                            <td>Price</td>
                                            <td class="text-center">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class="form-control" type="text" name="productcode[]" required></td>
                                            <td><input class="form-control" type="text" name="color[]" required></td>
                                            <td><input class="form-control" type="text" name="size[]" required></td>
                                            <td><input class="form-control" type="text" name="quantity[]" required></td>
                                            <td><input class="form-control" type="text" name="price[]" required></td>
                                            <td><button type="button" class="btn btn-danger d-flex"><i
                                                        class="fas fa-info pt-1"></i>&nbsp;&nbsp;Required</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <button id="addmore" type="button" class="btn btn-info"><i
                                            class="fas fa-plus-circle"></i>&nbsp;&nbsp;Add
                                        more</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success"><i
                                            class="fas fa-check"></i>&nbsp;&nbsp;Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function() {

            var adminUrl = '{{ url('saveproducts') }}';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var i = 0;

            $('#addmore').click(function() {
                i++;
                $('#dynamic_table').append('<tr id="row' + i + '"><td><input class="form-control" type="text" name="productcode[]" required></td><td><input class="form-control" type="text" name="color[]" required></td><td><input class="form-control" type="text" name="size[]" required></td><td><input class="form-control" type="text" name="quantity[]" required></td><td><input class="form-control" type="text" name="price[]" required></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger d-flex btn_remove"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Delete</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>

@endsection
