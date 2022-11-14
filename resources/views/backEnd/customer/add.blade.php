@extends('backEnd.layouts.master')
@section('customer', 'active menu-open')
@section('customer_add', 'active')
@section('title', 'Create customer')
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.customer') @lang('common.create')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ route('superadmin.manageCustomer') }}"
                                            class="btn btn-sm btn-primary btn-actions btn-create">
                                            @lang('common.customer') @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- form start -->
                            <form action="{{ route('superadmin.storeCustomer') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.basic_information') </h3>
                                        </div>
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <div class="form-group">
                                                        <label for="image"> @lang('common.customer') @lang('common.photo') <span
                                                                class="text-danger">*</span> </label>
                                                        <div>
                                                            <img src="{{ url('public/avatar/avatar.png') }}"
                                                                id="image_show" alt="Photo" width="100" height="100">
                                                        </div>
                                                        <input type="file" name="image" id="image"
                                                            class="{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                            value="{{ old('image') }}" required>
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('image') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.name') <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('name') }}" required>
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email">@lang('common.email_address') </label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            value="{{ old('email') }}">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="phone">@lang('common.mobile_no') <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="phone" id="phone"
                                                            class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                            value="{{ old('phone') }}" required>
                                                        @if ($errors->has('phone'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fathers_name"> @lang('common.father_name') </label>
                                                        <input type="text" name="fathers_name" id="fathers_name"
                                                            class="form-control {{ $errors->has('fathers_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('fathers_name') }}">
                                                        @if ($errors->has('fathers_name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('nid') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="mothers_name"> @lang('common.mother_name') </label>
                                                        <input type="text" name="mothers_name" id="mothers_name"
                                                            class="form-control {{ $errors->has('mothers_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mothers_name') }}">
                                                        @if ($errors->has('mothers_name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('mothers_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="customer_type"> @lang('common.customer_type') <span class="text-danger">*</span> </label>
                                                        <select name="customer_type" id="customer_type"
                                                            class="form-control {{ $errors->has('customer_type') ? ' is-invalid' : '' }}"
                                                            value="{{ old('customer_type') }}">
                                                        
                                                            <option value="">@lang('common.select')</option>
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

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="origin"> @lang('common.origin') <span class="text-danger">*</span> </label>
                                                        <select name="origin" id="origin"
                                                            class="form-control {{ $errors->has('origin') ? ' is-invalid' : '' }}"
                                                            value="{{ old('origin') }}">
                                                        
                                                            <option value="">@lang('common.select')</option>
                                                            <option value="Pos">@lang('common.pos')</option>
                                                            <option value="Laundry">@lang('common.laundry')</option>
                                                            <option value="Salon">@lang('common.salon')</option>

                                                        </select>
                                                        @if ($errors->has('origin'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('origin') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.additional_information') </h3>
                                        </div>
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="division_id"> @lang('common.division') <span
                                                                class="text-danger">*</span> </label>
                                                        <select name="division_id" id="division_id"
                                                            class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                            value="{{ old('division_id') }}" required>
                                                            <option value="">@lang('common.select_division')</option>
                                                            @foreach ($divisions as $division)
                                                                <option value="{{ $division->id }}">
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

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="district_id">@lang('common.district') <span
                                                                class="text-danger">*</span> </label>
                                                        <select name="district_id" id="district_id"
                                                            class="form-control select2" required>
                                                            <option value="">@lang('common.select_district') </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="thana_id">@lang('common.thana') <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="thana_id" id="thana_id"
                                                            class="form-control select2" required>
                                                            <option value="">@lang('common.select_thana') </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="address"> @lang('common.address') <span class="text-danger">*</span></label>
                                                        <input type="text" name="address" id="address"
                                                            class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }} py-5"
                                                            value="{{ old('address') }}"
                                                            autocomplete="new-address" required>
                                                        @if ($errors->has('address'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('address') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="password">Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            value="" autocomplete="new-password" required>
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="password_confirmation"> @lang('common.confirm_password') <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                                            class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                            value="" autocomplete="new-password" required>
                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="custom-label">
                                                                    <label> @lang('common.status') <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="box-body pub-stat display-inline">
                                                                    <input
                                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                        type="radio" id="active" name="status" value="1"
                                                                        @if (old('status', 1) == 1) checked @endif>
                                                                    <label for="active">@lang('common.active')</label>
                                                                    @if ($errors->has('status'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('status') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="box-body pub-stat display-inline">
                                                                    <input
                                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                        type="radio" name="status" value="0" id="inactive"
                                                                        @if (old('status', 1) == 0) checked @endif>
                                                                    <label for="inactive">@lang('common.inactive')</label>
                                                                    @if ($errors->has('status'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('status') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mrt-30">
                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="btn btn-primary save_btn">@lang('common.submit')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            $('body').on('click', '.save_btn', function() {
                var image = $('#image').val();
                if (!image) {
                    alert('Photo field is required');
                }
            });

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
                var options = '<option value="" class="agent_list">@lang('common.select')</option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name + ' </option>';
                    });
                    $('#thana_id').html(options);
                });
            })
           
        })

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
