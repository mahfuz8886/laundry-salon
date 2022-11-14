@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('title', 'Parcel Edit')
@section('style')
    <style>
        .fraud-search input {
            padding: 5px !important;
        }

        .addpercel-inner select {
            height: 35px !important;
        }

        h6 {
            font-weight: bold;
            padding: 5px 0px;
        }
    </style>
@endsection
@section('content')
    <section class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row addpercel-inner">
                        <div class="col-sm-12">
                            <div class="addpercel-top">
                                <h3> @lang('common.edit_parcel') </h3>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="fraud-search">
                                <form action="{{ url('merchant/update/parcel') }}" method="POST" name="editForm">
                                    @csrf
                                    <input type="hidden" value="{{ $parceledit->id }}" name="hidden_id">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6> @lang('common.parcel_information') </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control invoiceNo {{ $errors->has('invoiceNo') ? ' is-invalid' : '' }}"
                                                    value="{{ old('invoiceNo', $parceledit->invoiceNo) }}"
                                                    name="invoiceNo" placeholder="@lang('common.invoiceNo')">
                                                @if ($errors->has('invoiceNo'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('invoiceNo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select name="weight_id"
                                                    class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                    id="weight_id" required>
                                                    @foreach ($weights as $weight)
                                                        <option value="{{ $weight->id }}"
                                                            @if (old('weight_id', $parceledit->weight->id ?? '') == $weight->value) selected @endif>
                                                            {{ $weight->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('weight_id'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('weight_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="number" step="any"
                                                    class="form-control productPrice {{ $errors->has('productPrice') ? ' is-invalid' : '' }}"
                                                    value="{{ old('productPrice', $parceledit->cod) }}"
                                                    name="productPrice" placeholder="@lang('common.total_cash_collection')" required>
                                                @if ($errors->has('productPrice'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('productPrice') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6> @lang('common.customer_information') </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $parceledit->recipientName) }}" name="name"
                                                    placeholder="@lang('common.name') *">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="number"
                                                    class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phonenumber', $parceledit->recipientPhone) }}"
                                                    name="phonenumber" placeholder="@lang('common.mobile_no') *">
                                                @if ($errors->has('phonenumber'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" name="address" id="address" class="form-control" placeholder="@lang('common.customer_address')" autocomplete="off" />
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6> @lang('common.delivery_address') </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select name="division_id" class="form-control select2 division_id"
                                                    id="division_id" required>
                                                    <option value="">@lang('common.division') *</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}"
                                                            @if (old('division_id', $parceledit->division_id) == $division->id) selected @endif>
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
                                                <select name="district_id" class="form-control select2 district_id"
                                                    id="district_id" required>
                                                    <option value="">@lang('common.district') *</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select name="thana_id" class="form-control select2 thana_id" id="thana_id"
                                                    required>
                                                    <option value="">@lang('common.thana') *</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select name="area_id" class="form-control select2 area_id" id="area_id">
                                                    <option value="">@lang('common.area') </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" name="delivery_address" id="delivery_address"
                                                    value="{{ $parceledit->delivery_address }}" list="address_list"
                                                    class="form-control" placeholder="@lang('common.delivery_address') *"
                                                    autocomplete="new-password" required />
                                                <datalist id="address_list">
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <textarea type="text" name="note" class="form-control" placeholder="@lang('common.note')" rows="1">{{ old('note', $parceledit->note) }}</textarea>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-sm-12">
                                            <h6> @lang('common.pickup_address') </h6>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <select name="pickup_thana_id"
                                                    class="form-control select2 pickup_thana_id" id="pickup_thana_id"
                                                    required>
                                                    <option value="">@lang('common.select_pickup_thana') *</option>
                                                    @foreach ($pickup_thanas as $pickup_thana)
                                                        <option value="{{ $pickup_thana->id }}"
                                                            @if (old('pickup_thana_id', $parceledit->pickup_thana_id) == $pickup_thana->id) selected @endif>
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
                                            <div class="form-group">
                                                <textarea name="pickLocation" id="pickLocation" class="form-control" rows="3">{{ old('pickLocation', $parceledit->pickLocation) }}</textarea>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!--form input field-->
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div
                                                class="form-group d-flex flex-row justify-content-center align-items-center">
                                                <button type="submit"
                                                    class="form-control w-50">@lang('common.submit')</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-lg-1 col-md-1 col-sm-0"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="parcel-details-instance">
                                <h2>@lang('common.delivery_charge_details')</h2>
                                <div class="content calculate_result">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            @lang('common.delivery_charge')
                                        </div>
                                        <div class="col-sm-5 text-right">
                                            <span id="pdeliverycharge">
                                                {{ number_format($parceledit->deliveryCharge, 2) }} </span> Tk
                                        </div>
                                    </div>
                                    <!-- row end -->
                                    <div class="row">
                                        <div class="col-sm-7">
                                            @lang('common.cod_charge')
                                        </div>
                                        <div class="col-sm-5 text-right">
                                            <span id="pcodecharge">{{ number_format($parceledit->codCharge, 2) }}</span>
                                            Tk
                                        </div>
                                    </div>
                                    <!-- row end -->
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <b>@lang('common.total_charge')</b>
                                        </div>
                                        <div class="col-sm-5 text-right">
                                            <b><span
                                                    id="total_charge">{{ number_format($parceledit->deliveryCharge + $parceledit->codCharge, 2) }}</span>
                                                Tk</b>
                                        </div>
                                    </div>
                                    <!-- row end -->
                                    <div class="row total-bar">
                                        <div class="col-sm-12">
                                            <p class="text-center">@lang('common.note') : <span
                                                    class="">@lang('common.order_msg')</span></p>
                                        </div>
                                    </div>
                                    <!-- row end -->
                                </div>
                            </div>
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
            $('body').on('change paste keyup', '.productPrice, .weight_id, #thana_id', function() {
                getparcelCharge();
            })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                console.log(weight_id);

                if (weight_id && productPrice && thana_id) {
                    console.log(weight_id);
                    $.ajax({
                        method: "GET",
                        url: "{{ url('cost/calculate') }}",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id
                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('#pdeliverycharge').html(response.pdeliverycharge)
                            $('#pcodecharge').html(response.pcodecharge)
                            $('#total_charge').html(response.total_charge)
                        } else {
                            alert(response.message);
                            $('#pdeliverycharge').html(0.00)
                            $('#pcodecharge').html(0.00)
                            $('#total_charge').html(0.00)
                        }

                    });
                }

            }
        })
    </script>
    <script>
        $(function() {
            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id', $parceledit->district_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (item.id == selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                    $('#district_id').trigger('change');
                });
            })
            $('#division_id').trigger('change');
            // Get Thana 
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select thana </option>';
                var selected = '{{ old('thana_id', $parceledit->thana_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area 
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                var selected = '{{ old('area_id', $parceledit->area_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#area_id').html(options);
                });
            })
            $('#thana_id').trigger('change');
            $('.ptype').trigger('change');
            $('.weight').trigger('keyup');
        })
    </script>

@endsection
