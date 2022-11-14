@extends('backEnd.layouts.master')
@section('parcel', 'active menu-open')
@section('parcel_add', 'active')
@section('title', 'Create Parcel')
@section('content')
    <!-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0 text-dark">Welcome !! {{ auth::user()->name }}</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/login') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{ url('editor/parcel/pending') }}">Parcel</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="manage-button">
                        <div class="body-title">
                            <h5>@lang('common.parcel') @lang('common.create')</h5>
                        </div>
                        <div class="quick-button">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.parcel_info')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('editor/parcel/store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="merchantId">@lang('common.merchant') <span
                                                                    class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2{{ $errors->has('merchantId') ? ' is-invalid' : '' }}"
                                                                value="{{ old('merchantId') }}" name="merchantId"
                                                                id="merchantId">
                                                                <option value="">@lang('common.select')</option>

                                                                @foreach ($merchants as $value)
                                                                    <option value="{{ $value->id }}"
                                                                        @if (old('merchantId') == $value->id) selected @endif>
                                                                        {{ $value->companyName }}
                                                                        ({{ $value->phoneNumber }})
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('merchantId'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('merchantId') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="weight_id"> @lang('common.weight') <span
                                                                    class="text-danger">*</span></label>
                                                            <select
                                                                class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                                value="{{ old('weight_id') }}" name="weight_id"
                                                                id="weight_id">
                                                                {{-- <option value="">@lang('common.select')</option> --}}

                                                                @foreach ($weights as $weight)
                                                                    <option value="{{ $weight->id }}"
                                                                        @if (old('weight_id') == $weight->id) selected @endif>
                                                                        {{ $weight->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('merchantId'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('merchantId') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="productPrice"> @lang('common.total_cash_collection') <span
                                                                        class="text-danger">*</span> </label>
                                                                <input type="number" step="any"
                                                                    class="form-control productPrice" id="productPrice"
                                                                    name="productPrice" placeholder="Enter Cash Collection">
                                                            </div>
                                                        </div>

                                                        <!-- form group -->
                                                        <div class="form-group col-md-6">
                                                            <label for="name"> @lang('common.customer_name') <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                value="{{ old('name') }}" name="name" id="name"
                                                                placeholder="Recipient Name" required>
                                                            @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="phonenumber"> @lang('common.mobile_no') <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                                value="{{ old('phonenumber') }}" name="phonenumber"
                                                                id="phonenumber" placeholder="Phone Number" required>
                                                            @if ($errors->has('phonenumber'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('phonenumber') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="division_id"> @lang('common.division') <span
                                                                        class="text-danger">*</span> </label>
                                                                <select name="division_id" id="division_id"
                                                                    class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('division_id') }}" required>
                                                                    <option value="">@lang('common.select_division')</option>
                                                                    @foreach ($divisions as $division)
                                                                        <option value="{{ $division->id }}"
                                                                            @if (old('division_id') == $division->id) selected @endif>
                                                                            {{ $division->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('division_id'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('division_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="district_id">@lang('common.district') <span
                                                                        class="text-danger">*</span> </label>
                                                                <select name="district_id" id="district_id"
                                                                    class="form-control select2" required>
                                                                    <option value="">@lang('common.select_district') </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="thana_id">@lang('common.thana') <span
                                                                        class="text-danger">*</span> </label>
                                                                <select name="thana_id" id="thana_id"
                                                                    class="form-control select2" required>
                                                                    <option value="">@lang('common.select_thana') </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="area_id">@lang('common.area') </label>
                                                                <select name="area_id" id="area_id"
                                                                    class="form-control select2">
                                                                    <option value="">@lang('common.select') </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="delivery_address"> @lang('common.delivery_address') (maximum 500
                                                                characters) <span class="text-danger">*</span></label>
                                                            <textarea type="text" class="form-control {{ $errors->has('delivery_address') ? ' is-invalid' : '' }}"
                                                                name="delivery_address" placeholder="Delivery Address">{{ old('delivery_address') }}</textarea>


                                                            @if ($errors->has('delivery_address'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('delivery_address') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <!-- form group -->
                                                        <div class="form-group col-md-6">
                                                            <label for="note">@lang('common.note') (maximum 300
                                                                characters)</label>
                                                            <textarea type="text" class="form-control {{ $errors->has('note') ? ' is-invalid' : '' }}"
                                                                value="{{ old('note') }}" name="note" placeholder="Note Optional">{{ old('note') }}</textarea>
                                                            @if ($errors->has('note'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('note') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        {{-- <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="pickup_thana_id"> @lang('common.pickup_thana') <span
                                                                        class="text-danger">*</span> </label>
                                                                <select name="pickup_thana_id" id="pickup_thana_id"
                                                                    class="form-control select2 {{ $errors->has('pickup_thana_id') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('pickup_thana_id') }}" required>
                                                                    <option value="">@lang('common.select')</option>
                                                                    @foreach ($pickup_thanas as $pickup_thana)
                                                                        <option value="{{ $pickup_thana->id }}"
                                                                            @if (old('pickup_thana_id') == $pickup_thana->id) selected @endif>
                                                                            {{ $pickup_thana->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('pickup_thana_id'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('pickup_thana_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="form-group col-md-12">
                                                            <label for="pickLocation"> @lang('common.pickup_address') <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="text"
                                                                class="form-control {{ $errors->has('pickLocation') ? ' is-invalid' : '' }}"
                                                                value="{{ old('pickLocation') }}" name="pickLocation"
                                                                id="pickLocation" placeholder="Enter Pickup Location"
                                                                required>
                                                            @if ($errors->has('pickLocation'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('pickLocation') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <div class="card">
                                                        <div class="card-header bg-dark text-center">
                                                            @lang('common.delivery_charge_details')
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th> @lang('common.delivery_charge')</th>
                                                                    <td class="text-right">
                                                                        <span class="delivery_charge"> 0.00 </span> tk.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> @lang('common.cod_charge')</th>
                                                                    <td class="text-right">
                                                                        <span class="cod_charge"> 0.00 </span> tk.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> @lang('common.total_charge')</th>
                                                                    <th class="text-right">
                                                                        <span class="total_charge"> 0.00 </span> tk.
                                                                    </th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">@lang('common.submit')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            $('body').on('change paste keyup', '.productPrice, .weight_id, #thana_id, #merchantId', function() {
                getparcelCharge();
            })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                var merchantId = $('#merchantId').val();

                if (weight_id && productPrice && thana_id && merchantId) {
                    $.ajax({
                        method: "GET",
                        url: "{{ url('cost/calculate') }}",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'merchantId': merchantId
                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('.delivery_charge').html(response.pdeliverycharge)
                            $('.cod_charge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                        } else {
                            alert(response.message);
                            $('.delivery_charge').html(0.00)
                            $('.cod_charge').html(0.00)
                            $('.total_charge').html(0.00)
                        }

                    });
                }

            }
        })
    </script>
    <script>
        $(function() {
            // Get Merchant details 
            $('body').on('change', '#merchantId', function() {
                var merchantId = $('#merchantId').val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_merchant_details') }}",
                    data: {
                        'merchantId': merchantId
                    },
                }).done(function(response) {
                    // console.log(response.pickLocation);
                    if (response.pickLocation) {
                        $('#pickLocation').val(response.pickLocation);
                    }
                })
            })
            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select thana </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#area_id').html(options);
                });

                // Get Thana Agent 
                var agents = '';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_agents') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        agents +=
                            '<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="agents[]" value="' +
                            item.id + '">' + item.name + ' - ' + item.phone +
                            '</label></div>';
                    });
                    $('#agent_list').html(agents);
                });
            })
        })
    </script>
@endsection
