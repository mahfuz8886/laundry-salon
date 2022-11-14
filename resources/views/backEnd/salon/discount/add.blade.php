@extends('backEnd.layouts.master')
@section('discount_section', 'active menu-open')
@section('laundry_discount', 'menu-open')
@section('add_ldiscount', 'active')
@section('title', 'add discount')
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
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <b>@lang('common.add_discount')</b>
                </div>
                <div class="card-body">
                    <form action="{{ route('superadmin.salon.storeDiscount') }}" method="POST">
                      @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="customerType">Customer Type</label>
                                <select class="form-control" id="customerType" name="customer_type" required>
                                    <option value="">@lang('common.select')</option>
                                    <option value="Regular">@lang('common.regular')</option>
                                    <option value="Corporate">@lang('common.corporate')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="users">Customers</label>
                                <select class="form-control select2" name="customer_id" id="customers" required>
                                  <option value="">@lang('common.select')</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="service">Service</label>
                            <select name="service[]" multiple class="form-control select2" id="service" required>
                                <option value="">@lang('common.select')</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="discount">Discount %</label>
                            <input type="number" name="discount" class="form-control" id="discount">
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="status">status</label>
                          <select name="status" class="form-control" id="status" required>
                              <option value="">@lang('common.select')</option>
                              <option value="1">@lang('common.active')</option>
                              <option value="0">@lang('common.inactive')</option>
                          </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4">@lang('common.submit')</button>
                      </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(function() {
            $('body').on('click', '.save_btn', function() {
                var image = $('#image').val();
                if (!image) {
                    alert('Photo field is required');
                }
            });

            // Get customer
            $('body').on('change', '#customerType', function() {
                var userType = $('#customerType').val();
                var options = '<option value=""> Select user </option>';

                $.ajax({
                    method: "POST",
                    url: "{{ route('getCustomers') }}",
                    data: {
                        'type': userType
                    },
                }).done(function(response) {
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.firstName +
                            ' </option>';
                    });
                    $('#customers').html(options);
                });
            })

            // Get service
            $('body').on('change', '#product', function() {
                var productId = $('#product').val();
                var options = '<option value="" class="agent_list">@lang('common.select')</option>';
                // console.log(productId);
                $.ajax({
                    method: "POST",
                    url: "{{ route('getServices') }}",
                    data: {
                        'product_id': productId
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.service_name.service_name + ' </option>';
                    });
                    $('#service').html(options);
                });
            })
           
        })

    </script>
@endsection