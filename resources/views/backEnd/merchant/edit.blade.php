@extends('backEnd.layouts.master')
@section('merchant', 'active menu-open')
@section('merchant_manage', 'active')
@section('title', 'Edit Merchant Profile')
@section('extracss')
    <style>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.edit')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('editor/merchant/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('editor/merchant/profile/edit') }}" method="POST" name="editForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $merchantInfo->id }}" name="hidden_id">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.business_information')</h3>
                                        </div>
                                        <div class="profile-edit mrt-30">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.company_name') </label>
                                                        <input type="text" placeholder="Trade licence no"
                                                            id="companyName"
                                                            class="form-control {{ $errors->has('companyName') ? ' is-invalid' : '' }}"
                                                            value="{{ $merchantInfo->companyName }}" name="companyName">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">@lang('common.trade_licence_no')</label>
                                                        <input type="text" placeholder="Trade licence no"
                                                            id="trade_licence_no"
                                                            class="form-control {{ $errors->has('trade_licence_no') ? ' is-invalid' : '' }}"
                                                            value="{{ old('trade_licence_no') }}" name="trade_licence_no">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.website') </label>
                                                        <input type="text" placeholder="Website link." id="website"
                                                            class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                            value="{{ old('website', $merchantInfo->website) }}"
                                                            name="website">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.facebook_page') </label>
                                                        <input type="text" placeholder="facebook page link."
                                                            id="facebook_page"
                                                            class="form-control {{ $errors->has('facebook_page') ? ' is-invalid' : '' }}"
                                                            value="{{ old('facebook_page', $merchantInfo->facebook_page) }}"
                                                            name="facebook_page">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.pickup_thana') <span
                                                                class="text-danger">*</span> </label>
                                                        <select name="pickup_thana_id" id="pickup_thana_id"
                                                            class="form-control select2">
                                                            <option value=""> Select pickup thana </option>
                                                            @foreach ($thanas as $thana)
                                                                <option value="{{ $thana->id }}"
                                                                    @if (old('pickup_thana_id', $merchantInfo->pickup_thana_id) == $thana->id) selected @endif>
                                                                    {{ $thana->name }}
                                                                    ({{ $thana->district->name }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.pickup_address') <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" placeholder="Please enter your pick location"
                                                            id="pickLocation"
                                                            class="form-control {{ $errors->has('pickLocation') ? ' is-invalid' : '' }}"
                                                            value="{{ old('pickLocation', $merchantInfo->pickLocation) }}"
                                                            name="pickLocation">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.pickup_preference')</label>
                                                        <select type="text" name="pickupPreference"
                                                            class="form-control select2">
                                                            <option value="1"
                                                                @if (old('pickupPreference', $merchantInfo->pickupPreference) == 1) selected @endif>
                                                                @lang('common.as_per_request')</option>
                                                            <option value="2"
                                                                @if (old('pickupPreference', $merchantInfo->pickupPreference) == 2) selected @endif>
                                                                @lang('common.daily')
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.personal_information')</h3>
                                        </div>
                                        <div class="profile-edit mrt-30">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.name')</label>
                                                        <input type="text" name="firstName"
                                                            value="{{ $merchantInfo->firstName }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.mobile_no')</label>
                                                        <input type="text" name="phoneNumber"
                                                            value="{{ $merchantInfo->phoneNumber }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.father_name') </label>
                                                        <input type="text" placeholder="Fathers name"
                                                            id="fathers_name"
                                                            class="form-control {{ $errors->has('fathers_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('fathers_name') }}" name="fathers_name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.mother_name') </label>
                                                        <input type="text" placeholder="Mothers name"
                                                            id="mothers_name"
                                                            class="form-control {{ $errors->has('mothers_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mothers_name') }}" name="mothers_name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.email_address')</label>
                                                        <input type="email" name="email"
                                                            value="{{ $merchantInfo->emailAddress }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.delivery_charge_commission')(%)</label>
                                                        <input type="number" step="any" name="del_commission"
                                                            value="{{ $merchantInfo->del_commission }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.cod_charge_commission')(%)</label>
                                                        <input type="number" step="any" name="cod_commission"
                                                            value="{{ $merchantInfo->cod_commission }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> @lang('common.new_password') </label>
                                                        <input type="text" name="password" value=""
                                                            class="form-control" autocomplete="new-password">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.identification_certificate') </h3>
                                        </div>
                                        <div class="profile-edit mrt-30">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p> <b>@lang('common.nid_birth_driving')</b> <span class="text-danger">*</span> </p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="nid"
                                                                    name="identification_type" value="1"
                                                                    @if (old('identification_type', $merchantInfo->identification_type) == 1) checked @endif>
                                                                <label class="form-check-label" for="nid">
                                                                    @lang('common.nid') </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="birth_certificate"
                                                                    name="identification_type" value="2"
                                                                    @if (old('identification_type', $merchantInfo->identification_type) == 2) checked @endif>
                                                                <label class="form-check-label" for="birth_certificate">
                                                                    @lang('common.birth_certificate') </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="driving_licence"
                                                                    name="identification_type" value="3"
                                                                    @if (old('identification_type', $merchantInfo->identification_type) == 3) checked @endif>
                                                                <label class="form-check-label" for="driving_licence">
                                                                    @lang('common.driving_licence') </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12 nid_part">
                                                                    <div
                                                                        class="form-group {{ $errors->has('nidnumber') ? ' is-invalid' : '' }}">
                                                                        <input class="form-control" type="text"
                                                                            name="nidnumber"
                                                                            value="{{ old('nidnumber', $merchantInfo->nidnumber) }}"
                                                                            placeholder="@lang('common.nid_number')">
                                                                        @if ($errors->has('nidnumber'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('nidnumber') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 nid_part">
                                                                    <div
                                                                        class="form-group {{ $errors->has('nid_photo') ? ' is-invalid' : '' }}">
                                                                        <label for="nid_photo"> @lang('common.nid_front_photo') <span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="nid_photo" id="nid_photo"
                                                                            accept="image/*">

                                                                        @if ($errors->has('nid_photo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('nid_photo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="nid_photo_show"
                                                                            src="{{ asset($merchantInfo->nid_photo) }}"
                                                                            alt="NID Photo">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 nid_part">
                                                                    <div
                                                                        class="form-group {{ $errors->has('nid_photo_back') ? ' is-invalid' : '' }}">
                                                                        <label for="nid_photo_back"> @lang('common.nid_back_photo')
                                                                            <span class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="nid_photo_back" id="nid_photo_back"
                                                                            accept="image/*">

                                                                        @if ($errors->has('nid_photo_back'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('nid_photo_back') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="nid_photo_back_show"
                                                                            src="{{ asset($merchantInfo->nid_photo_back) }}"
                                                                            alt="NID Photo Back">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 birth_certificate_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('birth_certificate_no') ? ' is-invalid' : '' }}">
                                                                        <input class="form-control" type="text"
                                                                            name="birth_certificate_no"
                                                                            value="{{ old('birth_certificate_no', $merchantInfo->birth_certificate_no) }}"
                                                                            placeholder="@lang('common.birth_certificate_no')">

                                                                        @if ($errors->has('birth_certificate_no'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('birth_certificate_no') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 birth_certificate_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('birth_certificate_photo') ? ' is-invalid' : '' }}">
                                                                        <label for=""> @lang('common.birth_certificate_photo') <span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="birth_certificate_photo"
                                                                            id="birth_certificate_photo" accept="image/*">

                                                                        @if ($errors->has('birth_certificate_photo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('birth_certificate_photo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="birth_certificate_photo_show"
                                                                            src="{{ asset($merchantInfo->birth_certificate_photo) }}"
                                                                            alt="Birth certificate photo">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 driving_licence_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('driving_licence_no') ? ' is-invalid' : '' }}">
                                                                        <input class="form-control" type="text"
                                                                            name="driving_licence_no"
                                                                            value="{{ old('driving_licence_no', $merchantInfo->driving_licence_no) }}"
                                                                            placeholder="@lang('common.driving_licence_no')">

                                                                        @if ($errors->has('driving_licence_no'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('driving_licence_no') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 driving_licence_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('driving_licence_photo') ? ' is-invalid' : '' }}">
                                                                        <label for=""> @lang('common.driving_licence_photo') <span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="driving_licence_photo"
                                                                            id="driving_licence_photo" accept="image/*">

                                                                        @if ($errors->has('driving_licence_photo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('driving_licence_photo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="driving_licence_photo_show"
                                                                            src="{{ asset($merchantInfo->driving_licence_photo) }}"
                                                                            alt="Driving licence photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.payment_information') </h3>
                                        </div>
                                        <div class="profile-edit mrt-30">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.default_payment')</label>
                                                        <select name="paymentMethod" id="paymentMethod"
                                                            class="custom-select form-control {{ $errors->has('paymentMethod') ? ' is-invalid' : '' }}"
                                                            value="{{ old('paymentMethod') }}"
                                                            placeholder="@lang('common.payment_method') ">
                                                            <option value="">@lang('common.payment_mode') </option>
                                                            <option value="1"
                                                                @if ($merchantInfo->paymentMethod == 1) selected @endif>
                                                                @lang('common.bank')</option>
                                                            <option value="2"
                                                                @if ($merchantInfo->paymentMethod == 2) selected @endif>
                                                                @lang('common.bkash')</option>
                                                            <option value="3"
                                                                @if ($merchantInfo->paymentMethod == 3) selected @endif>
                                                                @lang('common.nagad')</option>
                                                            <option value="4"
                                                                @if ($merchantInfo->paymentMethod == 4) selected @endif>
                                                                @lang('common.cash')</option>
                                                            <option value="5"
                                                                @if ($merchantInfo->paymentMethod == 5) selected @endif>
                                                                @lang('common.others')</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 bank_info" style="display: none;">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.bank_name') </label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('bank_name') ? ' is-invalid' : '' }}"
                                                            id="bank_name"
                                                            value="{{ old('bank_name', $merchantInfo->nameOfBank) }}"
                                                            name="bank_name" data-error="Please enter your bank name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 bank_info" style="display: none;">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.branch_name') </label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('branch_name') ? ' is-invalid' : '' }}"
                                                            id="branch_name"
                                                            value="{{ old('branch_name', $merchantInfo->bankBranch) }}"
                                                            name="branch_name" data-error="Please enter your branch name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 bank_info" style="display: none;">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.ac_holder_name') </label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('ac_holder_name') ? ' is-invalid' : '' }}"
                                                            id="ac_holder_name"
                                                            value="{{ old('ac_holder_name', $merchantInfo->bankAcHolder) }}"
                                                            name="ac_holder_name"
                                                            data-error="Please enter your A/C Holder name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 bank_info" style="display: none;">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.bank_ac_no') </label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('bank_ac_no') ? ' is-invalid' : '' }}"
                                                            id="bank_ac_no"
                                                            value="{{ old('bank_ac_no', $merchantInfo->bankAcNo) }}"
                                                            name="bank_ac_no"
                                                            data-error="Please enter your bank account no.">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 bkash_info" style="display: none;">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.enter_bkash_no') </label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('bkashNumber') ? ' is-invalid' : '' }}"
                                                            id="bkashNumber"
                                                            value="{{ old('bkashNumber', $merchantInfo->bkashNumber) }}"
                                                            name="bkashNumber"
                                                            data-error="Please enter your bkash number">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 nagad_info" style="display: none;">
                                                    <div class="form-group">
                                                        <label for=""> @lang('common.enter_nagad_no')</label>
                                                        <input type="text"
                                                            class="form-control {{ $errors->has('nogodNumber') ? ' is-invalid' : '' }}"
                                                            id="nogodNumber"
                                                            value="{{ old('nogodNumber', $merchantInfo->nogodNumber) }}"
                                                            name="nogodNumber"
                                                            data-error="Please enter your nagad number">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.others_information') </h3>
                                        </div>
                                        <div class="profile-edit mrt-30">
                                            <div class="row">
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
                                                                    @if (old('division_id', $merchantInfo->division_id) == $division->id) selected @endif>
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
                                                        <label for="thana_id">@lang('common.thana') </label>
                                                        <select name="thana_id" id="thana_id"
                                                            class="form-control select2">
                                                            <option value="">@lang('common.select_thana') </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="area_id">@lang('common.area') </label>
                                                        <select name="area_id" id="area_id"
                                                            class="form-control select2">
                                                            <option value="">@lang('common.select_area') </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.present_address')</label>
                                                        <textarea name="present_address" class="form-control">{{ $merchantInfo->present_address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('common.permanent_address')</label>
                                                        <textarea name="permanent_address" class="form-control">{{ $merchantInfo->permanent_address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-4">
                                                <input type="submit" value="@lang('common.update')"
                                                    class="btn btn-success btn-md">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- col end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
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
        function startIdentification() {
            var identification_type = $('input[name="identification_type"]:checked').val();
            if (identification_type == 1) {
                $('.nid_part').show();
                $('.birth_certificate_part').hide();
                $('.driving_licence_part').hide();
            } else if (identification_type == 2) {
                $('.nid_part').hide();
                $('.birth_certificate_part').show();
                $('.driving_licence_part').hide();
            }
        }
        $(function() {
            $('body').on('click', '.identification_type', function() {
                startIdentification();
            })
            startIdentification();

            $('body').on('change', '#paymentMethod', function() {
                var paymentMethod = $('#paymentMethod').val();
                if (paymentMethod == 1) {
                    $('.bank_info').show();
                    $('.bkash_info').hide();
                    $('.nagad_info').hide();
                } else if (paymentMethod == 2) {
                    $('.bank_info').hide();
                    $('.bkash_info').show();
                    $('.nagad_info').hide();
                } else if (paymentMethod == 3) {
                    $('.bank_info').hide();
                    $('.bkash_info').hide();
                    $('.nagad_info').show();
                } else {
                    $('.bank_info').hide();
                    $('.bkash_info').hide();
                    $('.nagad_info').hide();
                }
            })

            $('#paymentMethod').trigger('change');

            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id', $merchantInfo->district_id) }}';
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
                var selected = '{{ old('thana_id', $merchantInfo->thana_id) }}';
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
                var selected = '{{ old('area_id', $merchantInfo->area_id) }}';
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

        })
    </script>
@endsection
