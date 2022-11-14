@extends('backEnd.layouts.master')
@section('laundry_order_section', 'active menu-open')
@section('offline_order', 'active menu-open')
@section('add_offline_order', 'active')
@section('title', 'offline order')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <h3 class="card-header">
                  Add new order
                </h3>
                <div class="card-body">
                    <form action="{{ route('superadmin.laundry.storeOrders') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="customer">Customer</label>
                                <select name="customer" class="form-control select2" id="customer" required onchange="loadAddress(this.value)">
                                    <option value="">@lang('common.choose')</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->firstName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                    <label for="category">Category</label>
                                    <select name="category" class="form-control select2" id="category" required onchange="loadProduct(this.value)">
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="product">Product</label>
                                <select name="product" class="form-control select2" id="product" required onchange="loadProductService(this.value)">
                                    <option value="">@lang('common.choose')</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="service">Service Type</label>
                                <select name="service" class="form-control select2" id="service" required>
                                    <option value="">@lang('common.choose')</option>
                                    
                                </select>
                            </div>

                            {{-- address --}}
                            <div class="form-group col-md-4">
                                <label for="shipping">Shipping Address</label>
                                <select name="shipping" class="form-control select2" id="shipping" required>
                                    <option value="">@lang('common.choose')</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="billing">Billing Address</label>
                                <select name="billing" class="form-control select2" id="billing">
                                    <option value="">@lang('common.choose')</option>
                                    
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="branch_id">Branch</label>
                                <select name="branch_id" class="form-control select2" id="branch_id" required>
                                    <option value="">@lang('common.choose')</option>
                                    @foreach($allBranch as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="pick_time">Order picked time</label>
                                <input type="datetime-local" name="pick_time" class="form-control" id="pick_time" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pick_time">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="quantity" required>
                            </div>
                            
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-5">@lang('common.submit')</button>
                    </form>
                </div>
              </div>
            
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

        function loadAddress(cid) {
            let customerId = cid;
            let options = '<option value="">@lang('common.choose')</option>';
            if(customerId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.customerAddress') }}',
                    data: {customerId},
                    success: function(data) {
                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.thana.name + ','+ element.district.name + ',' + element.district.name +' </option>';
                            });
                            $('#shipping').empty();
                            $('#billing').empty();

                            $('#shipping').append(options);
                            $('#billing').append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }

        function loadProduct(catId) {
            let categoryId = catId;
            let options = '<option value="">@lang('common.choose')</option>';
            if(categoryId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.getproduct') }}',
                    data: {categoryId},
                    success: function(data) {
                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.product_name +' </option>';
                            });

                            $('#product').empty();
                            $('#product').append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }

        function loadProductService(pid) {
            let productId = pid;
            let options = '<option value="">@lang('common.choose')</option>';
            if(productId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.getproductservice') }}',
                    data: {productId},
                    success: function(data) {
                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.service_name.service_name +' </option>';
                            });

                            $('#service').empty();
                            $('#service').append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }


    </script>
@endsection