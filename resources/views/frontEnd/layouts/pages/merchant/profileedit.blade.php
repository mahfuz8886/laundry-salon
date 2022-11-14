@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('setting', 'active')
@section('title', 'Dashboard')
@section('style')
    <style>
        .identification_type_photo {
            padding: 2px;
            border-radius: 3px;
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

        p {
            font-weight: bold;
        }

        .select2 {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="profile-edit mrt-30">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav class="custom-tab-menu">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#companyinformation">
                            @lang('common.company_information')
                        </a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#ownerinformation"> @lang('common.owner_information')</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#pickupmethod"> @lang('common.pickup_method')</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#paymentmethod"> @lang('common.payment_method')</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#bankaccount"> @lang('common.bank_account')</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#otheraccount"> @lang('common.other_account')</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="{{ url('merchant/profile/edit') }}" method="POST" name="editForm"
                    enctype="multipart/form-data">
                    @csrf
                    @php
                        $merchantInfo = App\Merchant::find(Session::get('merchantId'));
                    @endphp
                    <div class="tab-content customt-tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="companyinformation" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="title">@lang('common.business_information')</p>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="form-group">
                                                <label for="logo"> Logo Size(150x150) <span class="text-danger">*</span>
                                                </label>
                                                <div>
                                                    <img src="{{ $merchantInfo->logo ? asset($merchantInfo->logo) : url('public/avatar/avatar.png') }}"
                                                        id="logo_show" alt="Photo" width="100" height="100">
                                                </div>
                                                <input type="file" name="logo" id="logo"
                                                    class="{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                                                    value="{{ old('logo') }}">
                                                @if ($errors->has('logo'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('logo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p>@lang('common.company_name')</p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <p><strong>{{ $merchantInfo->companyName }}</strong></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.trade_licence_no') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input type="text" name="trade_licence_no"
                                                value="{{ $merchantInfo->trade_licence_no }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.website') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input type="text" name="website" value="{{ $merchantInfo->website }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.facebook_page') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input type="text" name="facebook_page"
                                                value="{{ $merchantInfo->facebook_page }}" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p></p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8"><input type="submit"
                                                value="@lang('common.update')" class="common-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ownerinformation" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="title">@lang('common.owner_information')</p>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p>@lang('common.name') <span class="text-danger">*</span> </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">

                                            <input type="text" name="firstName"
                                                value="{{ $merchantInfo->firstName }} {{ $merchantInfo->lastName }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p>@lang('common.mobile_no') <span class="text-danger">*</span></p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input readonly type="text" name="phoneNumber"
                                                value="{{ $merchantInfo->phoneNumber }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p>@lang('common.other_mobile_no')</p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8"><input type="text"
                                                name="otherphoneNumber" value="{{ $merchantInfo->otherphoneNumber }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p>@lang('common.email_address')</p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input type="text" name="emailAddress"
                                                value="{{ $merchantInfo->emailAddress }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p> <b>@lang('common.nid_birth_driving')</b> <span class="text-danger">*</span> </p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check-inline">
                                                        <label for="nid" class="form-check-label">
                                                            <input type="radio" id="nid"
                                                                class="form-check-input identification_type"
                                                                name="identification_type" value="1"
                                                                @if (old('identification_type', $merchantInfo->identification_type) == 1) checked @endif>
                                                            @lang('common.nid')
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="birth_certificate" class="form-check-label">
                                                            <input type="radio" id="birth_certificate"
                                                                class="form-check-input identification_type"
                                                                name="identification_type" value="2"
                                                                @if (old('identification_type', $merchantInfo->identification_type) == 2) checked @endif>
                                                            @lang('common.birth_certificate')
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label for="driving_licence" class="form-check-label">
                                                            <input type="radio" id="driving_licence"
                                                                class="form-check-input identification_type"
                                                                name="identification_type" value="3"
                                                                @if (old('identification_type', $merchantInfo->identification_type) == 3) checked @endif>
                                                            @lang('common.driving_licence')
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 nid_part">
                                                    <div
                                                        class="form-group {{ $errors->has('nidnumber') ? ' is-invalid' : '' }}">
                                                        <input class="form-control" type="text" name="nidnumber"
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
                                                        <label for="nid_photo"> @lang('common.nid_front_photo') </label>
                                                        <input class="form-control" type="file" name="nid_photo"
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
                                                        class="form-group {{ $errors->has('nid_photo') ? ' is-invalid' : '' }}">
                                                        <label for="nid_photo_back">
                                                            @lang('common.nid_back_photo') </label>
                                                        <input class="form-control" type="file" name="nid_photo_back"
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
                                                <div class="col-md-12 birth_certificate_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('birth_certificate_no') ? ' is-invalid' : '' }}">
                                                        <label for="birth_certificate_no"> @lang('common.birth_certificate_no') </label>
                                                        <input class="form-control" type="text"
                                                            name="birth_certificate_no"
                                                            value="{{ old('birth_certificate_no', $merchantInfo->birth_certificate_no) }}"
                                                            placeholder="Birth Certificate No.">

                                                        @if ($errors->has('birth_certificate_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('birth_certificate_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 birth_certificate_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('birth_certificate_photo') ? ' is-invalid' : '' }}">
                                                        <label for="birth_certificate_photo"> @lang('common.birth_certificate_photo')
                                                        </label>
                                                        <input class="form-control" type="file"
                                                            name="birth_certificate_photo" accept="image/*">

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
                                                <div class="col-md-12 driving_licence_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('driving_licence_no') ? ' is-invalid' : '' }}">
                                                        <label for="driving_licence_no"> @lang('common.driving_licence_no') </label>
                                                        <input class="form-control" type="text"
                                                            name="driving_licence_no"
                                                            value="{{ old('driving_licence_no', $merchantInfo->driving_licence_no) }}"
                                                            placeholder="Driving Licence No.">

                                                        @if ($errors->has('driving_licence_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('driving_licence_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 driving_licence_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('driving_licence_photo') ? ' is-invalid' : '' }}">
                                                        <label for="driving_licence_photo"> @lang('common.driving_licence_photo') </label>
                                                        <input class="form-control" type="file"
                                                            name="driving_licence_photo" accept="image/*">

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

                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.father_name') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input type="text" name="fathers_name"
                                                value="{{ $merchantInfo->fathers_name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.mother_name')</p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <input type="text" name="mothers_name"
                                                value="{{ $merchantInfo->mothers_name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.division') <span class="text-danger">*</span> </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <select type="text" name="division_id" id="division_id"
                                                class="form-control" required>
                                                <option value=""> Select division </option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        @if (old('division_id', $merchantInfo->division_id) == $division->id) selected @endif>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.district') <span class="text-danger">*</span> </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <select type="text" name="district_id" id="district_id"
                                                class="form-control" required>
                                                <option value=""> Select district </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.thana') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <select type="text" name="thana_id" id="thana_id" class="form-control">
                                                <option value=""> Select thana </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.area') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <select type="text" name="area_id" id="area_id" class="form-control">
                                                <option value=""> Select area </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.present_address') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <textarea name="present_address" id="" class="form-control" rows="2">{{ $merchantInfo->present_address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p> @lang('common.permanent_address') </p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8">
                                            <textarea name="permanent_address" id="" class="form-control" rows="2">{{ $merchantInfo->permanent_address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <p></p>
                                        </div>
                                        <div class="col-lg-6 col-md-8 col-sm-8"><input type="submit"
                                                value="@lang('common.update')" class="common-btn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pickupmethod" role="tabpanel">
                            <p class="title">@lang('common.pickup_method')</p>
                            {{-- <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.address')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8">
                                    <textarea name="mAdress" class="form-control">{{ $merchantInfo->mAdress }}</textarea>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p> @lang('common.select_pickup_thana') </p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8">
                                    <select type="text" name="pickup_thana_id" class="form-control select2">
                                        <option value=""> Select pickup thana </option>
                                        @foreach ($pickup_thanas as $key => $pickup_thana)
                                            <option value="{{ $pickup_thana->id }}"
                                                @if (old('pickup_thana_id', $merchantInfo->pickup_thana_id) == $pickup_thana->id) selected @endif>
                                                {{ $pickup_thana->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.pickup_address')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8">
                                    <textarea name="pickLocation" class="form-control">{{ $merchantInfo->pickLocation }}</textarea>
                                </div>
                            </div>
                            <!-- form-group end -->

                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.pickup_preference')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8">
                                    <select type="text" name="pickupPreference" class="form-control select2">
                                        <option value="1" @if (old('pickupPreference', $merchantInfo->pickupPreference) == 1) selected @endif>As Per
                                            Request</option>
                                        <option value="2" @if (old('pickupPreference', $merchantInfo->pickupPreference) == 2) selected @endif>Daily
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p></p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="submit" value="@lang('common.update')"
                                        class="common-btn"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="paymentmethod" role="tabpanel">
                            <p class="title">@lang('common.payment_method')</p>
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.default_payment')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8">
                                    <select name="paymentMethod" class="form-control">
                                        <option value="4" @if ($merchantInfo->payoption == 4) selected @endif>Cash
                                        </option>
                                        <option value="1" @if ($merchantInfo->payoption == 1) selected @endif>Bank
                                        </option>
                                        <option value="2" @if ($merchantInfo->payoption == 2) selected @endif>Bkash
                                        </option>
                                        <option value="3" @if ($merchantInfo->payoption == 3) selected @endif>Nogod
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.withdrawal')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8">
                                    <select name="withdrawal" class="form-control">
                                        <option value="1" @if ($merchantInfo->withdrawal == 1) selected @endif>
                                            @lang('common.as_per_request')
                                        </option>
                                        <option value="2" @if ($merchantInfo->withdrawal == 2) selected @endif>
                                            @lang('common.daily')
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p></p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="submit" value="@lang('common.update')"
                                        class="common-btn"></div>
                            </div>
                            <!-- form group end -->
                        </div>
                        <div class="tab-pane fade " id="bankaccount" role="tabpanel">
                            <p class="title">@lang('common.bank_account')</p>
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.bank_name')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="nameOfBank"
                                        value="{{ $merchantInfo->nameOfBank }}" class="form-control"></div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.branch_name')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="bankBranch"
                                        value="{{ $merchantInfo->bankBranch }}" class="form-control"></div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.ac_holder_name')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="bankAcHolder"
                                        value="{{ $merchantInfo->bankAcHolder }}" class="form-control"></div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.bank_ac_no')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="bankAcNo"
                                        value="{{ $merchantInfo->bankAcNo }}" class="form-control"></div>
                            </div>
                            <!-- form-group end -->
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p></p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="submit" value="@lang('common.update')"
                                        class="common-btn"></div>
                            </div>
                            <!-- form-group end -->
                        </div>
                        <div class="tab-pane fade " id="otheraccount" role="tabpanel">
                            <p class="title">@lang('common.other_account')</p>
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.bkash')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="bkashNumber"
                                        value="{{ $merchantInfo->bkashNumber }}" class="form-control"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.rocket')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="roketNumber"
                                        value="{{ $merchantInfo->roketNumber }}" class="form-control"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <p>@lang('common.nagad')</p>
                                </div>
                                <div class="col-lg-6 col-md-8 col-sm-8"><input type="text" name="nogodNumber"
                                        value="{{ $merchantInfo->nogodNumber }}" class="form-control"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <p></p>
                                </div>
                                <div class="col-sm-3"><input type="submit" value="@lang('common.update')"
                                        class="common-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- row end -->
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        // Logo preview
        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#logo").change(function() {
                readURL(this);
            });
        });

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
            $('body').on('click', '.identification_type', function() {
                startIdentification();
            })
            startIdentification();

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
            $('#thana_id').trigger('change');

        })

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
            } else {
                $('.nid_part').hide();
                $('.birth_certificate_part').hide();
                $('.driving_licence_part').show();
            }
        }
    </script>
@endsection
