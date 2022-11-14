@extends('backEnd.layouts.master')
@section('salon_order_section', 'active menu-open')
@section('quick_sale', 'menu-open')
@section('add_quick_sale', 'active')
@section('title', 'add Quick sale')
@section('content')
    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            @endforeach
        @endif
        {{-- start --}}
        <div class="container-fluid">
            <form action="{{ route('cart_service_store') }}" method="post">
                <div class="row">
                    {{-- left side start --}}
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <b>Add to Cart</b>
                                </div>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="">Select Branch <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="branch_id" name="branch_id" required>
                                            <option value="">@lang('common.select')</option>
                                            @foreach ($allBranch as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('branch_id') == $branch->id) selected @endif>
                                                    {{ $branch->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Customer <span>*</span> &nbsp;&nbsp;
                                            <span class="btn-sm btn-primary" id="customer-add"
                                                style="margin-top: -10px; color:white;">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </label>
                                        <select class="form-control select2" id="customer_id" name="customer_id" required>
                                            <option value="">@lang('common.select')</option>
                                            <option @if (old('customer_id') == 0) selected @endif value="0">Walking
                                                customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if (old('customer_id') == $customer->id) selected @endif>
                                                    {{ $customer->firstName . ' ' . $customer->lastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Employee <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="employee_id" name="employee_id" required>
                                            <option value="">@lang('common.select')</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    @if (old('employee_id') == $employee->id) selected @endif>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Date <span class="text-danger">*</span></label>
                                        <input type="text" name="booking_date" value="{{ date('Y-m-d') }}"
                                            class="flatDate form-control flatpickr-input" readonly="readonly">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Invoice No. <span class="text-danger">*</span></label>
                                        <input type="text" name="invoice_no" value="{{ $invoice_no }}"
                                            class="form-control" readonly="readonly" placeholder="">
                                    </div>

                                    {{-- <div class="form-group col-md-4">
                                        <label for="">Payment Method <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="" name="" required>
                                            <option value="">@lang('common.select')</option>
                                            <option value="Regular">@lang('common.regular')</option>
                                            <option value="Corporate">@lang('common.corporate')</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4" style="display: ;">
                                        <label for="">Select Bank Account <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="" name="" required>
                                            <option value="">@lang('common.select')</option>
                                            <option value="Regular">@lang('common.regular')</option>
                                            <option value="Corporate">@lang('common.corporate')</option>
                                        </select>
                                    </div> --}}

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><b>Cart Items</b></div>
                            <div class="card-body">
                                <div class="table-responsive" style="height: 650px; overflow-y: auto;">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th width="40%">Service Name</th>
                                                <th width="25%">Space</th>
                                                <th width="25%">Per Space Price</th>
                                                <th width="25%">Discount</th>
                                                <th>Total Cost</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-container">
                                            @if (old('service_id') != null && sizeof(old('service_id')) > 0)
                                                @foreach (old('service_id') as $item)
                                                    <tr class="product-item">

                                                        <td>
                                                            <div
                                                                class="form-group {{ $errors->has('service_id.' . $loop->index) ? ' is-invalid' : '' }}">
                                                                <input type="hidden" name="service_id[]" id="service_id"
                                                                    class="form-control"
                                                                    value="{{ old('service_id.' . $loop->index) }}">
                                                                @if ($errors->has('service_id'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('service_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div
                                                                class="form-group {{ $errors->has('space.' . $loop->index) ? ' is-invalid' : '' }}">
                                                                <input type="text" name="space[]" id="space"
                                                                    class="form-control"
                                                                    value="{{ old('space.' . $loop->index) }}">
                                                                @if ($errors->has('space'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('space') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div
                                                                class="form-group {{ $errors->has('price_per_space.' . $loop->index) ? ' is-invalid' : '' }}">
                                                                <input type="text" name="price_per_space[]"
                                                                    id="price_per_space" class="form-control"
                                                                    value="{{ old('price_per_space.' . $loop->index) }}">
                                                                @if ($errors->has('price_per_space'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('price_per_space') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div
                                                                class="form-group {{ $errors->has('service_discount.' . $loop->index) ? ' is-invalid' : '' }}">
                                                                <input type="number" name="service_discount[]"
                                                                    id="service_discount" class="form-control"
                                                                    value="{{ old('service_discount.' . $loop->index) }}"
                                                                    placeholder="Amt or %">
                                                                @if ($errors->has('service_discount'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('service_discount') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <td class="total-cost">0.00</td>

                                                        <td class="text-center">
                                                            <a role="button" class="btn btn-danger btn-sm btn-remove"> X
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <th class="text-right" colspan="2">Total Item(s)</th>
                                                <th colspan="2"><span id="tot_item">0</span></th>
                                            </tr>

                                            <tr>
                                                <th colspan="2" class="text-right">Total Space</th>
                                                <th id="tot_quantity" colspan="3">0</th>
                                            </tr>

                                            <tr>
                                                <th colspan="2" class="text-right"> Payment Type </th>
                                                <th id="total-" colspan="3">
                                                    <select class="form-control select2" id="payment_method"
                                                        name="payment_method" required>
                                                        <option value="1"> Cash </option>
                                                        <option value="2"> Card </option>
                                                        <option value="3"> Bkash </option>
                                                        <option value="4"> Nagad </option>
                                                        <option value="5"> Rocket </option>
                                                    </select>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th colspan="2" class="text-right"> Amount</th>
                                                <th id="total-amount" colspan="2">0.00</th>
                                            </tr>

                                            {{-- <tr>
                                                <th colspan="3" class="text-right"> Discount </th>
                                                <th colspan="3">
                                                    <input type="text" id="discount" name="discount"
                                                        value="{{ old('discount') }}" placeholder="Amt or %"
                                                        class="form-control discount" autocomplete="off">
                                                </th>
                                            </tr> --}}

                                            <tr>
                                                <th colspan="2" class="text-right"> Grand Total </th>
                                                <th colspan="2">
                                                    <input type="text" readonly id="grand_total" name="grand_total"
                                                        value="{{ old('grand_total', 0) }}"
                                                        class="form-control grand_total">
                                                </th>
                                            </tr>

                                            {{-- <tr>
                                                <th colspan="3" class="text-right"> Paid </th>
                                                <th colspan="2">
                                                    <input type="text" id="paid" name="paid"
                                                        value="{{ old('paid') }}" placeholder=""
                                                        class="form-control paid" autocomplete="off">
                                                </th>
                                            </tr> --}}

                                            {{-- <tr>
                                                <th colspan="3" class="text-right"> Due </th>
                                                <th colspan="3">
                                                    <input readonly type="text" id="due" name="due"
                                                        value="{{ old('due') }}" placeholder=""
                                                        class="form-control due" autocomplete="off">
                                                </th>
                                            </tr> --}}

                                        </tfoot>
                                    </table>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- left side end --}}

                    {{-- right side start --}}
                    <div class="col-md-5">

                        {{-- search start --}}
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <b>Filter</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for=""> Search by service name, category name </label>
                                            <input type="search" class="form-control search_info" id="search_info"
                                                name="" autofocus autocomplete="off">
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Salon Category</label>
                                            <select class="form-control select2" id="category_id" name="category_id">
                                                <option value="">@lang('common.select')</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if (old('category_id') == $category->id) selected @endif>
                                                        {{ $category->cat_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                        {{-- search end --}}

                        {{-- product result show start --}}
                        <div class="card">

                            <div class="card-header">
                                <div class="card-title">
                                    <span> <b>Products</b> </span>
                                    {{-- <a class="btn-sm btn btn-primary" id="product_add"
                                        style="color:white; margin-left: 5px;">
                                        <i class="fa fa-plus"></i>
                                    </a> --}}
                                </div>
                            </div>

                            <div id="product-list" class="row ml-4">
                                <div class="row">

                                    {{-- <div class="col-5 m-2">
                                    <div class="border border-success rounded">
                                        <div class="p-1">
                                            <div class="text-center">
                                                <b>Product Name</b> <br>
                                                <img class="" src="{{ asset('avatar/avatar.png') }}" alt=""
                                                    height="50" width="50">
                                                <div class="text-center" style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-success add_to_sale"
                                                        data-id="" id="add-to-cart">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                    {{-- <div class="col-md-11 load-more text-right mt-4 mb-2">
                                        <div class="">
                                            <button type="button" name="load_more_btn" class="btn-sm btn btn-success"
                                                data-lid="" id="load_more_btn">Load
                                                More</button>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>

                        </div>
                        {{-- product result show end --}}


                    </div>
                    {{-- right side end --}}

                </div>
                {{-- </form> --}}
        </div>
        {{-- end --}}
    </section>

    {{-- product template start --}}
    <template id="template-product">
        <tr class="product-item">

            <td>
                {{-- <div class="form-group ">
                    <input type="hidden" name="product_id[]" id="product_id" class="form-control" readonly>
                    @if ($errors->has('product_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('product_id') }}</strong>
                        </span>
                    @endif
                </div> --}}

                <div class="form-group ">
                    <input type="hidden" name="service_id[]" id="service_id" class="form-control" readonly>
                    <input type="hidden" name="category_id[]" id="category_id" class="form-control" readonly>
                    <input type="text" name="service_name[]" id="service_name" class="form-control" readonly>
                    @if ($errors->has('service_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('service_name') }}</strong>
                        </span>
                    @endif
                </div>

            </td>

            <td>
                <div class="form-group ">
                    <input type="number" name="space[]" id="space" class="form-control space" value="">
                    @if ($errors->has('space'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('space') }}</strong>
                        </span>
                    @endif
                </div>
            </td>

            <td>
                <div class="form-group ">
                    <input type="text" name="price_per_space[]" id="price_per_space"
                        class="form-control price_per_space" value="" readonly>
                    @if ($errors->has('price_per_space'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('price_per_space') }}</strong>
                        </span>
                    @endif
                </div>
            </td>

            <td>
                <div class="form-group ">
                    <input readonly type="text" name="product_discount[]" id="product_discount"
                        class="form-control product_discount" value="" placeholder="Amt or %">
                    @if ($errors->has('product_discount'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('product_discount') }}</strong>
                        </span>
                    @endif
                </div>
            </td>

            <td class="total-cost">0.00</td>

            <td class="text-center">
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>

        </tr>
    </template>
    {{-- product template end --}}


    {{-- customer add modal start --}}
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-customer">
        Launch demo modal
    </button> --}}
    <div class="modal fade" id="modal-customer" tabindex="-1" aria-labelledby="customer-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer-modal-label">Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="customer-info" enctype="multipart/form-data" name="customer-info">
                        @csrf

                        <div class="form-group">
                            <label for="firstName"> @lang('common.name') <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" type="text" id="firstName" name="firstName" value=""
                                placeholder="Enter First Name">
                        </div>

                        {{-- <div class="form-group">
                            <label for="firstName"> @lang('common.name') <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" type="text" name="firstName" value=""
                                placeholder="Enter First Name" required>
                        </div> --}}

                        <div class="form-group">
                            <label for="phoneNumber"> @lang('common.mobile_no') <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" type="number" name="phoneNumber" id="phoneNumber"
                                value="" placeholder="Enter Phone Number">
                        </div>

                        <div class="form-group">
                            <label for="customer_type"> @lang('common.customer_type') <span class="text-danger">*</span> </label>
                            <select type="text" name="customer_type" id="customer_type" class="form-control"
                                required>
                                <option value="Regular">@lang('common.regular')</option>
                                <option value="Corporate">@lang('common.corporate')</option>

                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="customer-save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- customer add modal end --}}

@endsection

@section('script')
    <script>
        // customer add modal box
        $('body').on('click', '#customer-add', function() {
            $('#modal-customer').modal('show');
        });
        $('body').on('click', '#customer-save', function() {
            storeCustomer();
        });

        function storeCustomer() {
            var formData = new FormData($('#customer-info')[0]);
            //var arr = $('#customer-info').serializeArray();
            //console.log(arr);
            $.ajax({
                type: "POST",
                url: "{{ route('customer_add_new') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        console.log(response.message);
                        $('#modal-customer').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then((result) => {
                            // $('#table').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                        console.log(response.message);
                    }
                }
            });
        }

        // product show in onload page
        // search result show
        $(document).ready(function() {
            // page load e kicu product show hobe
            load_more('', '', '');
        });

        $('body').on('keyup', '#search_info', function(e) {
            var branch_id = $('#branch_id').val();
            var search_info = $('#search_info').val();
            load_more('', search_info, branch_id);
        });

        $('body').on('change', '#search_info', function(e) {
            var branch_id = $('#branch_id').val();
            var search_info = $('#search_info').val();
            load_more('', search_info, branch_id);
        });

        $('body').on('change', '#category_id', function(e) {
            var branch_id = $('#branch_id').val();
            var search_info = Number($(this).val());
            console.log(search_info);
            load_more('', search_info, branch_id);
        });

        $('body').on('click', '#load_more_btn', function() {
            var id = $(this).data('lid');
            $('#load_more_btn').html('<b>Loading...</b>');
            var branch_id = $('#branch_id').val();
            var search_info = $('#search_info').val();
            load_more(id, search_info, branch_id);
        });

        function load_more(id = "", search_info, branch_id = "") {
            if (search_info.length > 2 || search_info.length == '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_products') }}",
                    data: {
                        search_data: search_info,
                        branch_id: branch_id,
                        id: id
                    }
                }).done(function(response) {
                    // console.log('on load product: '+response);
                    $('.load-more').remove();
                    if (id < 1) {
                        $('#product-list').html(response);
                    } else {
                        $('#product-list').append(response);
                    }

                    if (!response) {
                        $('.load-more').remove();
                    }

                });
            }
        }
        // remove product from table
        var total_product_count = 0;
        $('body').on('click', '.btn-remove', function() {
            $(this).closest('.product-item').remove();
            $('#tot_item').text(--total_product_count);
            calculate();
        });

        // add product into table
        $('body').on('click', '#add-to-cart', function() {
            var id = $(this).data("id");
            var customer_id = $('#customer_id').val();
            $.ajax({
                method: "GET",
                url: "{{ route('get_product_details') }}",
                data: {
                    id: id,
                    customer_id: customer_id
                }
            }).done(function(response) {
                console.log(response);
                if (response.success) {
                    var discount = 0;
                    var disc_price = 0;
                    var html = $('#template-product').html();
                    var item = $(html);
                    if(response.discount != 0) {
                        discount = response.discount.discount;
                        disc_price = (discount * response.data.price_per_space) / 100;
                        disc_price = disc_price.toFixed(2);
                    } else {
                        //
                    }
                    $('#tot_item').text(++total_product_count); // count variable declare in the top
                    item.find('#service_id').val(response.data.id);
                    item.find('#category_id').val(response.data.category_id);
                    item.find('#service_name').val(response.data.service_name);
                    item.find('#price_per_space').val(response.data.price_per_space);
                    item.find('#product_discount').val(Number(disc_price));
                    item.find('#space').val(1);
                    $('#product-container').append(item);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'This product is not available',
                    });
                    calculate();
                }
                calculate();
            });
        });

        /*$('body').on('keyup mouseleave change', '#discount, #paid, .quantity, .price, .product_discount', function() {
            //calculate();
        });*/
        $('body').on('keyup mouseleave change', '.space, .price_per_space', function() {
            calculate();
        });


        function calculate() {
            var total = 0;
            var total_quantity = 0;
            //var total_quantity = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = parseFloat($('.space:eq(' + i + ')').val() || 0);
                var price = parseFloat($('.price_per_space:eq(' + i + ')').val() || 0);
                var discount = parseFloat($('.product_discount:eq(' + i + ')').val() || 0);
                $('.total-cost:eq(' + i + ')').html('' + ((quantity * price) - discount).toFixed(2));

                total += (quantity * price) - discount;
                total_quantity += quantity;
            });

            var grand_total = parseFloat(total);
            $('#tot_quantity').html('' + total_quantity);
            $('#total-amount').html('' + total.toFixed(2));
            $('#grand_total').val(grand_total.toFixed(2));
            $('#due').val(due.toFixed(2));
        }


        /*function calculate() {
            var total = 0;
            var total_quantity = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = parseFloat($('.quantity:eq(' + i + ')').val() || 0);
                var price = parseFloat($('.price:eq(' + i + ')').val() || 0);
                var product_discount = $('.product_discount:eq(' + i + ')').val();
                var isProductPercentage = product_discount[product_discount.length - 1];
                if (isProductPercentage == '%') {
                    var product_percentage = parseFloat(product_discount.slice(0, -1));
                    product_discount = (product_percentage * (quantity * price)) / 100;
                }
                product_discount = parseFloat(product_discount || 0);

                $('.total-cost:eq(' + i + ')').html('' + ((quantity * price) - product_discount).toFixed(2));

                total += ((quantity * price) - product_discount);
                total_quantity += quantity;
            });
            var discount = $('#discount').val();
            var isPercentage = discount[discount.length - 1];

            if (isPercentage == '%') {
                var percentage = parseFloat(discount.slice(0, -1));
                discount = (percentage * total) / 100;
            }
            discount = parseFloat(discount || 0);
            var paid = parseFloat($('#paid').val() || 0);
            var grand_total = parseFloat(total) - discount;
            var due = (grand_total - paid);
            $('#tot_quantity').html('' + total_quantity);
            $('#total-amount').html('' + total.toFixed(2));
            $('#grand_total').val(grand_total.toFixed(2));
            $('#due').val(due.toFixed(2));
        }*/
    </script>
@endsection
