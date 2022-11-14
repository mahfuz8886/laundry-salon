@extends('frontEnd.layouts.master')
@section('title', 'Register')
@section('style')
    <style>
        label {
            font-weight: 600;
        }

        .contact-wthree-do .form-control {
            padding: 5px 10px;
        }

        #nid_photo_show,
        #nid_photo_back_show,
        #birth_certificate_photo_show,
        #driving_licence_photo_show {
            width: 100%;
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 5px;
            height: 204px;
            width: 324px;
        }
    </style>
@endsection

@section('content')
    {{-- error showing area --}}
    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">&times;</button>
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if ($msg)
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">&times;</button>
            {{ $msg }}
        </div>
    @endif --}}
    {{-- error showing area --}}

    <div class="contact py-5">

        <div class="container pb-xl-5 pb-lg-3">
            <div class="row">
                <div class="col-md-12 mt-lg-0 mt-5">
                    <div class="register-page" style="max-width: 700px;min-height:400px;margin:auto">
                        <div class="form-wrapper">
                            @if (!$verify_code)
                                <form action="{{ url('merchant/register') }}" method="GET" class="contact-wthree-do">
                                    @csrf
                                    <h3 class="text-center"> @lang('common.registration') </h3><br>

                                    @if(!$phoneNumber)
                                    <div class="form-content">
                                        <h4>Register by mobile number</h4>
                                        <p>Provide valid mobile number. We will sent OTP code to given number to verify you.</p>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input class="form-control contact-formquickTechls {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}" type="number" value="{{old('phoneNumber')}}" placeholder="Phone Number" name="phoneNumber" required="">
                                                        @if ($errors->has('phoneNumber'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-cont-quicktech btn-block mt-2">SUBMIT</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    @endif

                                    @if($phoneNumber)

                                    <div class="form-content">
                                        <h4>Verify mobile number</h4>
                                        <p>Enter OTP code send to your given number.</p>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input class="form-control" type="hidden" name="mobile_no" value="{{ $phoneNumber }}">
                                                    <input class="form-control contact-formquickTechls {{ $errors->has('verify_code') ? ' is-invalid' : '' }}" type="text" value="{{old('verify_code')}}" placeholder="OTP code" name="verify_code" required="">
                                                        @if ($errors->has('verify_code'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('verify_code') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-cont-quicktech btn-block mt-2">SUBMIT</button>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    @endif

                                    {{-- <div class="form-group">
                                        <div class="row">
                                            @if (!$phoneNumber)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phoneNumber"> @lang('common.enter_mobile_no')<span
                                                                class="text-danger">*</span> </label>
                                                        <input
                                                            class="form-control  {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                            type="text"
                                                            name="phoneNumber" value="{{ old('phoneNumber') }}">

                                                        @if ($errors->has('phoneNumber'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($phoneNumber)
                                                <div class="col-md-6">
                                                    <label>@lang('common.enter_verify_code') <span class="text-danger">*</span> </label>
                                                    <input class="form-control" type="hidden" name="mobile_no"
                                                        value="{{ $phoneNumber }}">
                                                    <input class="form-control" type="verify"
                                                         name="verify_code">
                                                </div>
                                            @endif

                                            <div class="col-md-6 text-text">
                                                <button type="submit" class="btn btn-success mt-4">
                                                    @lang('common.submit')
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                </form>
                            @endif

                            @if ($verify_code && Session::get('merchant_id') && $form_show)
                                <form action="{{ url('auth/merchant/register') }}" method="POST" class="contact-wthree-do"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h3 class="text-center">@lang('common.registration')</h3><br>
                                    <div class="form-group">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('firstName') ? ' is-invalid' : '' }}">
                                                    <label for="firstName"> @lang('common.name') <span class="text-danger">*</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="firstName"
                                                        value="{{ old('firstName') }}">

                                                    @if ($errors->has('firstName'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('firstName') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber"> @lang('common.mobile_no')<span
                                                            class="text-danger">*</span> </label>
                                                    <input readonly
                                                        class="form-control  {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                        type="text" name="phoneNumber"
                                                        value="{{ old('phoneNumber', request()->get('mobile_no')) }}">

                                                    @if ($errors->has('phoneNumber'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="logo"> @lang('common.image') </label>
                                                    <input class="form-control" type="file" name="logo">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('emailAddress') ? ' is-invalid' : '' }}">
                                                    <label for="emailAddress"> @lang('common.email_address') </label>
                                                    <input class="form-control" type="text" name="emailAddress"
                                                        value="{{ old('emailAddress') }}">

                                                    @if ($errors->has('emailAddress'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('emailAddress') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('customer_type') ? ' is-invalid' : '' }}">
                                                    <label for="customer_type"> @lang('common.customer_type') </label>
                                                    <select type="text" name="customer_type" id="customer_type"
                                                        class="form-control" required>
                                                        <option value="Regular">@lang('common.regular')</option>
                                                        <option value="Corporate">@lang('common.corporate')</option>
                                                        
                                                    </select>

                                                    @if ($errors->has('customer_type'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('customer_type') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('division_id') ? ' is-invalid' : '' }}">
                                                    <label for="division_id"> @lang('common.division') <span class="text-danger">*</span>
                                                    </label>
                                                    <select type="text" name="division_id" id="division_id"
                                                        class="form-control" required>
                                                        <option value=""> @lang('common.select_division') </option>
                                                        @foreach ($divisions as $key => $division)
                                                            <option value="{{ $division->id }}">{{ $division->name }}
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
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('district_id') ? ' is-invalid' : '' }}">
                                                    <label for="district_id"> @lang('common.district') <span
                                                            class="text-danger">*</span> </label>
                                                    <select type="text" name="district_id" id="district_id"
                                                        class="form-control" required>
                                                        <option value=""> @lang('common.select_district') </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('thana_id') ? ' is-invalid' : '' }}">
                                                    <label for="thana_id"> @lang('common.thana') <span
                                                        class="text-danger">*</span></label>
                                                    <select type="text" name="thana_id" id="thana_id"
                                                        class="form-control" required>
                                                        <option value=""> @lang('common.select_thana') </option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('address') ? ' is-invalid' : '' }}">
                                                    <label for="address">@lang('common.address')<span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text" name="address" class="form-control" required>

                                                    @if ($errors->has('address'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                                    <label for="password"> @lang('common.password') <span class="text-danger">*</span>
                                                    </label>
                                                    <input class="form-control" type="text" name="password"
                                                        value="{{ old('password') }}">

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('confirmed') ? ' is-invalid' : '' }}">
                                                    <label for="confirmed"> @lang('common.confirm_password') <span
                                                            class="text-danger">*</span> </label>
                                                    <input class="form-control" type="text" name="confirmed"
                                                        value="{{ old('confirmed') }}">

                                                    @if ($errors->has('confirmed'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('confirmed') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-12 text-text">
                                                <button type="submit" class="btn btn-success mt-4">
                                                    @lang('common.submit')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{ asset('public/backEnd/') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        // NID Photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo").change(function() {
                readURL(this);
            });
        })
        // NID Photo Back Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_back_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo_back").change(function() {
                readURL(this);
            });
        })
        // Birth certificate photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#birth_certificate_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#birth_certificate_photo").change(function() {
                readURL(this);
            });
        })
        // Driving licence photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#driving_licence_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#driving_licence_photo").change(function() {
                readURL(this);
            });
        })
    </script>
    <script>
        $(function() {
            $('.select2').select2();
            $('body').on('click', '.identification_type', function() {
                var identification_type = $('input[name="identification_type"]:checked').val();
                if (identification_type == 1) {
                    $('.nid_part').show();
                    $('.birth_certificate_part').hide();
                    $('.driving_licence_part').hide();
                } else if (identification_type == 2) {
                    $('.nid_part').hide();
                    $('.birth_certificate_part').show();
                    $('.driving_licence_part').hide();
                } else {
                    $('.nid_part').hide();
                    $('.birth_certificate_part').hide();
                    $('.driving_licence_part').show();
                }
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

            })

        })
    </script>
@endsection
