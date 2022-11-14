@extends('backEnd.layouts.master')
@section('laundry_order_section', 'active menu-open')
@section('offline_order', 'active menu-open')
@section('add_offline_order', 'active')
@section('title', 'offline order')
@section('content')

@section('extracss')
    <style>
        .product-name {
            font-size: 13px;
            text-align: center;
            height: 60px !important;
        }
        .product_img {
            height: 65px;
            text-align: center;
        }
        .product_btn {
            margin-top: 5px;
            height: 30px;
        }
    </style>
@endsection
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
            <form action="{{ route('superadmin.quick_laundry_sale') }}" method="post">
                @csrf
                {{-- upper start --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <b> Add to Cart </b>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-md-2">
                                        <label for="">Select Branch <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="branch_id" name="branch_id" required>
                                            @foreach ($allBranch as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('branch_id', Session::get('default_branch')) == $branch->id) selected @endif>
                                                    {{ $branch->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Customer <span>*</span> &nbsp;&nbsp;
                                            <span class="btn-sm btn-primary" id="customer-add"
                                                style="margin-top: -10px; color:white;">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </label>
                                        <select class="form-control select2" id="customer_id" name="customer_id" required>
                                            {{-- <option value="">@lang('common.select')</option> --}}
                                            {{-- <option @if (old('customer_id') == 0) selected @endif value="0">Walking
                                                customer</option> --}}
                                                <option @if (Session::get('customer_id') == 0) selected @endif value="0">Walking Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if (Session::get('customer_id') == $customer->id) selected @endif>
                                                    {{ $customer->firstName . ' ' . $customer->lastName }}
                                                    {{ $customer->customer_type == 'Corporate' ? ' (Corporate)' : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
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

                                    <div class="form-group col-md-2">
                                        <label for="">Date <span class="text-danger">*</span></label>
                                        <input type="text" name="booking_date" value="{{ date('Y-m-d') }}"
                                            class="flatDate form-control flatpickr-input" readonly="readonly">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Invoice No. <span class="text-danger">*</span></label>
                                        <input type="text" name="invoice_no" value="{{ $invoice_no }}"
                                            class="form-control" readonly="readonly" placeholder="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- upper end --}}


                <div class="row">
                    {{-- left side start --}}
                    <div class="col-md-7">

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <span><b>Cart Items</b></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height: 650px; overflow-y: auto;">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th width="60%">Service Name</th>
                                                <th width="15%">Quantity</th>
                                                <th width="20%">Unit Price</th>
                                                {{-- <th width="25%">Discount</th> --}}
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
                                                        <option value="4"> Rocket </option>
                                                    </select>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th colspan="2" class="text-right"> Amount</th>
                                                <th id="total-amount" colspan="2">0.00</th>
                                            </tr>

                                            <tr>
                                                <th colspan="2" class="text-right"> Grand Total </th>
                                                <th colspan="2">
                                                    <input type="text" readonly id="grand_total" name="grand_total"
                                                        value="{{ old('grand_total', 0) }}"
                                                        class="form-control grand_total">
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </form>
                    {{-- left side end --}}

                    {{-- right side start --}}
                    <div class="col-md-5">

                        {{-- product result show start --}}
                        <div class="card">

                            <div class="card-header">
                                <div class="card-title">
                                    <span> <b>Items</b> </span>
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
                                </div>
                            </div>

                            <div class="">
                                <div class="px-3" id="product-list">

                                    <div class="row">

                                        {{-- <div class="col-md-4 mb-3">
                                            <div class="border border-success rounded" style="height: 175px;">
                                                <div class="p-1">
                                                    <div class="product-name">
                                                        <b>Product Name Name Product</b> - Service Name
                                                     </div>
                                                    <div class="">
                                                        <div class="product_img">
                                                            <img class="" src="{{ asset('public/avatar/avatar.png') }}"
                                                            alt="" height="60" width="80">
                                                        </div>
                                                        <div class="text-center product_btn">
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
    
                                        {{-- <div class="col-md-4">
                                            <div class="border border-success rounded">
                                                <div class="p-1">
                                                    <div class="text-center">
                                                         <div>
                                                            <b>Product Name - Service Name</b>
                                                         </div>
                                                        <img class="" src="{{ asset('public/avatar/avatar.png') }}"
                                                            alt="" height="50" width="50">
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
                                        </div>
    
                                        <div class="col-md-4">
                                            <div class="border border-success rounded">
                                                <div class="p-1">
                                                    <div class="text-center">
                                                         <div>
                                                            <b>Product Name - Service Name</b>
                                                         </div>
                                                        <img class="" src="{{ asset('public/avatar/avatar.png') }}"
                                                            alt="" height="50" width="50">
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

                                    </div>

                                    {{-- <div class="row mb-3">
                                        <div class="col-md-4">
                                            <div class="border border-success rounded">
                                                <div class="p-1">
                                                    <div class="text-center">
                                                         <div>
                                                            <b>Product Name - Service Name</b>
                                                         </div>
                                                        <img class="" src="{{ asset('public/avatar/avatar.png') }}"
                                                            alt="" height="50" width="50">
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
                                        </div>
    
                                        <div class="col-md-4">
                                            <div class="border border-success rounded">
                                                <div class="p-1">
                                                    <div class="text-center">
                                                         <div>
                                                            <b>Product Name - Service Name</b>
                                                         </div>
                                                        <img class="" src="{{ asset('public/avatar/avatar.png') }}"
                                                            alt="" height="50" width="50">
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
                                        </div>
    
                                        <div class="col-md-4">
                                            <div class="border border-success rounded">
                                                <div class="p-1">
                                                    <div class="text-center">
                                                         <div>
                                                            <b>Product Name - Service Name</b>
                                                         </div>
                                                        <img class="" src="{{ asset('public/avatar/avatar.png') }}"
                                                            alt="" height="50" width="50">
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
                                        </div>
                                    </div> --}}
                                    

                                    {{-- <div class="col-md-6">
                                        <div class="border border-success rounded">
                                            <div class="shadow bg-body rounded p-1">
                                                <div class="text-center">
                                                    <b>Product Name</b> <br>
                                                    <img class="rounded" src="{{ asset('public/avatar/avatar.png') }}"
                                                        alt="" height="50" width="50">
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

                                    {{-- <div class="row">
                                        <div class="col-md-11 load-more text-center mt-4 mb-2">
                                            <div class="">
                                                <button type="button" name="load_more_btn" class="btn-sm btn btn-link"
                                                    data-lid="5" id="load_more_btn">Load
                                                    More</button>
                                            </div>
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
                <div class="form-group ">
                    <input type="hidden" name="service_id[]" id="service_id" class="form-control" readonly>
                    <input type="hidden" name="product_id[]" id="product_id" class="form-control" readonly>
                    <input type="text" name="service_name[]" id="service_name" class="form-control">
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

            {{-- <td>
                <div class="form-group ">
                    <input type="text" name="product_discount[]" id="product_discount"
                        class="form-control product_discount" value="" placeholder="Amt or %">
                    @if ($errors->has('product_discount'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('product_discount') }}</strong>
                        </span>
                    @endif
                </div>
            </td> --}}

            <td class="total-cost">0.00</td>

            <td class="text-center">
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>

        </tr>
    </template>
    {{-- product template end --}}


    {{-- customer add modal start --}}
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
            var branch_id = $('#branch_id').val();
            var customer_id = $('#customer_id').val();
            var cust_id = (customer_id==0) ? '' : '{{ Session::get('customer_id') }}';
            console.log('cust_id');
            console.log(cust_id);
            load_more(branch_id, '', cust_id, '');
            //load_more(branch_id, '', '', '');
        });

        $('body').on('keyup', '#search_info', function(e) {
            var branch_id = $('#branch_id').val();
            var customer_id = $('#customer_id').val();
            var search_info = $('#search_info').val();
            load_more(branch_id, search_info, customer_id, '');
        });

        $('body').on('change', '#search_info, #customer_id, #branch_id', function(e) {
            var branch_id = $('#branch_id').val();
            var customer_id = $('#customer_id').val();
            var search_info = $('#search_info').val();
            load_more(branch_id, search_info, customer_id, '');
        });

        $('body').on('click', '#load_more_btn', function() {
            var id = $(this).data('lid');
            $('#load_more_btn').html('<b>Loading...</b>');
            var branch_id = $('#branch_id').val();
            var customer_id = $('#customer_id').val();
            var search_info = $('#search_info').val();
            load_more(branch_id, search_info, branch_id, id);
        });

        $('body').on('change', '#customer_id', function(e) {
            var branch_id = $('#branch_id').val();
            var customer_id = $(this).val();
            //var customer_id = $('#customer_id').val();
            console.log(customer_id);
            //var search_info = $('#search_info').val();
            load_more(branch_id, '', customer_id, '');
            $.ajax({
                    method: "GET",
                    url: "{{ route('setCustomerIdInSession') }}",
                    data: {
                        customer_id: customer_id
                    }
                }).done(function(response) {
                     console.log(response);
                     location.reload();
                     load_more(branch_id, '', customer_id, '');
                });
            // location.reload();
            // load_more(branch_id, '', customer_id, '');
        });

        function load_more(branch_id, search_info = "", customer_id = "", id = "") {
            if (search_info.length > 2 || search_info.length == '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('superadmin.laundry.getLaundryProduct') }}",
                    data: {
                        branch_id: branch_id,
                        search_data: search_info,
                        customer_id: customer_id,
                        id: id
                    }
                }).done(function(response) {
                     console.log('response');
                     console.log(response);
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
            console.log(id);
            $.ajax({
                method: "GET",
                url: "{{ route('superadmin.get_londry_products_det') }}",
                data: {
                    id: id,
                    customer_id: customer_id
                }
            }).done(function(response) {
                //console.log(response);
                if(response.data) {
                    var html = $('#template-product').html();
                    var item = $(html);
                    $('#tot_item').text(++total_product_count); // count variable declare in the top
                    var service;
                    var product_id;
                    var service_id;
                    if(response.customer) {
                        product_id = response.data.product_id;
                        service_id = response.data.service_id;
                    } else {
                        product_id = response.data.laundry_product_id;
                        service_id = response.data.laundry_service_id;
                    }
                    service = response.data.product.product_name + ' - ' + response.data.service_name.service_name;
                    item.find('#service_name').val(service);
                    item.find('#product_id').val(product_id);
                    item.find('#service_id').val(service_id);
                    item.find('#price_per_space').val(response.data.amount);
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

            $('.product-item').each(function(i, obj) {
                var quantity = parseFloat($('.space:eq(' + i + ')').val() || 0);
                var price = parseFloat($('.price_per_space:eq(' + i + ')').val() || 0);
                $('.total-cost:eq(' + i + ')').html('' + (quantity * price).toFixed(2));

                total += (quantity * price);
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
