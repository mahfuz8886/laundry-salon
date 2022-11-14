@extends('backEnd.layouts.master')
@section('user', 'active menu-open')
@section('user_add', 'active')
@section('title', 'Create User')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>Create User</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('superadmin/user/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            Manage User
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- form start -->
                            <form action="{{ url('superadmin/user/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Add a new user</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="name">Name <span class="text-danger">*</span>
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

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="username">Username <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="username" id="username"
                                                            class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                            value="{{ old('username') }}" required>
                                                        @if ($errors->has('username'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('username') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            value="{{ old('email') }}" required>
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="phone">Phone <span class="text-danger">*</span>
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
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="designation">Designation <span
                                                                class="text-danger">*</span> </label>
                                                        <input type="text" name="designation" id="designation"
                                                            class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                                            value="{{ old('designation') }}" required>
                                                        @if ($errors->has('designation'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('designation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="password">Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            required>
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="password">Confirm Password <span
                                                                class="text-danger">*</span> </label>
                                                        <input type="password" name="password_confirmation" id="password"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="branch_id">Branch <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="branch_id[]" id="branch_id"
                                                            class="form-control select2 {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                                                            required multiple>
                                                            @php
                                                            $branches = App\Hub::where('status', 1)->get();
                                                            @endphp
                                                            <option value="">@lang('common.choose')</option>
                                                            @foreach ($branches as $value)
                                                                <option value="{{ $value->id }}">
                                                                    {{ $value->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('branch_id'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('branch_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="image">Image <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="file" name="image" id="image"
                                                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                            value="{{ old('image') }}" required>
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('image') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="custom-label">
                                                            <label>Publication Status <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                        <div class="box-body pub-stat display-inline">
                                                            <input
                                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                type="radio" id="active" name="status"
                                                                value="1">
                                                            <label for="active">Active</label>
                                                            @if ($errors->has('status'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="box-body pub-stat display-inline">
                                                            <input
                                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                type="radio" name="status" value="0"
                                                                id="inactive">
                                                            <label for="inactive">Inactive</label>
                                                            @if ($errors->has('status'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Permissions
                                            </h3>
                                        </div>
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>
                                                        <input type="checkbox" class="flat-green" id="checkAll"> Check
                                                        All
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header bg-light">
                                                        Dashboard
                                                        <a class="card-link pull-right" data-toggle="collapse"
                                                            href="#dashboard">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div id="dashboard" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input dashboard"
                                                                        name="permission[]" value="dashboard"
                                                                        id="dashboard">
                                                                    Dashboard
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header bg-light">
                                                        Website
                                                        <a class="card-link pull-right" data-toggle="collapse"
                                                            href="#website">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div id="website" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="website"
                                                                        id="website">
                                                                    Website
                                                                </label>
                                                            </div>
                                                            {{-- <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="terms_condition"
                                                                        id="terms_condition">
                                                                    Terms & Condition
                                                                </label>
                                                            </div> --}}
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="setting"
                                                                        id="setting">
                                                                    Setting
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="logo"
                                                                        id="logo">
                                                                    Logo
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="logo_add"
                                                                        id="logo_add">
                                                                    logo_add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="logo_edit"
                                                                        id="logo_edit">
                                                                    Logo edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="logo_delete"
                                                                        id="logo_delete">
                                                                    Logo delete
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="slider"
                                                                        id="slider">
                                                                    Slider
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="slider_add"
                                                                        id="slider_add">
                                                                    Slider add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="slider_edit"
                                                                        id="slider_edit">
                                                                    Slider edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="slider_delete"
                                                                        id="slider_delete">
                                                                    Slider delete
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="slogan"
                                                                        id="slogan">
                                                                    Slogan
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="feature"
                                                                        id="feature">
                                                                    Feature
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="feature_add"
                                                                        id="feature_add">
                                                                    Feature add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="feature_edit"
                                                                        id="feature_edit">
                                                                    Feature edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="feature_delete"
                                                                        id="feature_delete">
                                                                    Feature delete
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="hub_area"
                                                                        id="hub_area">
                                                                    Hub area
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="hub_area_add"
                                                                        id="hub_area_add">
                                                                    Hub area add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="hub_area_edit"
                                                                        id="hub_area_edit">
                                                                    Hub area edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="hub_area_delete"
                                                                        id="hub_area_delete">
                                                                    Hub area delete
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="service"
                                                                        id="service">
                                                                    Service
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="service_add"
                                                                        id="service_add">
                                                                    Service add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="service_edit"
                                                                        id="service_edit">
                                                                    Service edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="service_delete"
                                                                        id="service_delete">
                                                                    Service delete
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="create_page"
                                                                        id="create_page">
                                                                    Create page
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="create_page_add"
                                                                        id="create_page_add">
                                                                    Create page add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="create_page_edit"
                                                                        id="create_page_edit">
                                                                    Create page edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input website"
                                                                        name="permission[]" value="create_page_delete"
                                                                        id="create_page_delete">
                                                                    Create page delete
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header bg-light">
                                                        Panel User
                                                        <a class="card-link pull-right" data-toggle="collapse"
                                                            href="#panel_user">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div id="panel_user" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input panel_user"
                                                                        name="permission[]" value="panel_user"
                                                                        id="panel_user">
                                                                    Panel User
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input panel_user"
                                                                        name="permission[]" value="user_add"
                                                                        id="user_add">
                                                                    User add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input panel_user"
                                                                        name="permission[]" value="user_edit"
                                                                        id="user_edit">
                                                                    User edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input panel_user"
                                                                        name="permission[]" value="user_delete"
                                                                        id="user_delete">
                                                                    User delete
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header bg-light">
                                                        Bulk SMS
                                                        <a class="card-link pull-right" data-toggle="collapse"
                                                            href="#bulk_sms">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div id="bulk_sms" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input bulk_sms"
                                                                        name="permission[]" value="bulk_sms"
                                                                        id="bulk_sms">
                                                                    Bulk SMS
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input bulk_sms"
                                                                        name="permission[]" value="send_sms"
                                                                        id="send_sms">
                                                                    Send SMS
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input bulk_sms"
                                                                        name="permission[]" value="sms_balance"
                                                                        id="sms_balance">
                                                                    SMS Balance
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header bg-light">
                                                        Merchant
                                                        <a class="card-link pull-right" data-toggle="collapse"
                                                            href="#merchant">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div id="merchant" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input merchant"
                                                                        name="permission[]" value="merchant"
                                                                        id="merchant">
                                                                    Merchant
                                                                </label>
                                                            </div>

                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input merchant"
                                                                        name="permission[]" value="merchant_add"
                                                                        id="merchant_add">
                                                                    Merchant add
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input merchant"
                                                                        name="permission[]" value="merchant_edit"
                                                                        id="merchant_edit">
                                                                    Merchant edit
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                        class="form-check-input merchant"
                                                                        name="permission[]" value="merchant_delete"
                                                                        id="merchant_delete">
                                                                    Merchant delete
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                Delivery Charge
                                                <a class="card-link pull-right" data-toggle="collapse"
                                                    href="#delivery_charge">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="delivery_charge" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox"
                                                                class="form-check-input delivery_charge"
                                                                name="permission[]" value="delivery_charge"
                                                                id="delivery_charge">
                                                            Delivery charge
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox"
                                                                class="form-check-input delivery_charge"
                                                                name="permission[]" value="delivery_charge_edit"
                                                                id="delivery_charge_edit">
                                                            Delivery charge edit
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                Discount
                                                <a class="card-link pull-right" data-toggle="collapse" href="#discount">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="discount" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input discount"
                                                                name="permission[]" value="discount_edit"
                                                                id="discount_edit">
                                                            Discount
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input discount"
                                                                name="permission[]" value="promotional_discount_add"
                                                                id="promotional_discount_add">
                                                            Promotional Discount add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input discount"
                                                                name="permission[]" value="promotional_discount_edit"
                                                                id="promotional_discount_edit">
                                                            Promotional Discount edit
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                Area Panel
                                                <a class="card-link pull-right" data-toggle="collapse"
                                                    href="#area_panel">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="area_panel" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="area_panel" id="area_panel">
                                                            Area Panel
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="division" id="division">
                                                            Division
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="division_add"
                                                                id="division_add">
                                                            Division add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="division_edit"
                                                                id="division_edit">
                                                            Division edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="division_delete"
                                                                id="division_delete">
                                                            Division delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="district" id="district">
                                                            District
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="district_add"
                                                                id="district_add">
                                                            District add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="district_edit"
                                                                id="district_edit">
                                                            District edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="district_delete"
                                                                id="district_delete">
                                                            District delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="thana" id="thana">
                                                            Thana
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="thana_add" id="thana_add">
                                                            Thana add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="thana_edit" id="thana_edit">
                                                            Thana edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="thana_delete"
                                                                id="thana_delete">
                                                            Thana delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="area" id="area">
                                                            Area
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="area_add" id="area_add">
                                                            Area add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="area_edit" id="area_edit">
                                                            Area edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input area_panel"
                                                                name="permission[]" value="area_delete" id="area_delete">
                                                            Area delete
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                HR
                                                <a class="card-link pull-right" data-toggle="collapse" href="#hr">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="hr" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="hr" id="hr">
                                                            HR
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="department" id="department">
                                                            Department
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="department_add"
                                                                id="department_add">
                                                            Department add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="department_edit"
                                                                id="department_edit">
                                                            Department edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="department_delete"
                                                                id="department_delete">
                                                            Department delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="employee" id="employee">
                                                            Employee
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="employee_add"
                                                                id="employee_add">
                                                            Employee add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="employee_edit"
                                                                id="employee_edit">
                                                            Employee edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="employee_delete"
                                                                id="employee_delete">
                                                            Employee delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="agent" id="agent">
                                                            Agent
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="agent_add" id="agent_add">
                                                            Agent add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="agent_edit" id="agent_edit">
                                                            Agent edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="agent_delete"
                                                                id="agent_delete">
                                                            Agent delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="pickupman" id="pickupman">
                                                            Pickupman
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="pickupman_add"
                                                                id="pickupman_add">
                                                            Pickupman add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="pickupman_edit"
                                                                id="pickupman_edit">
                                                            Pickupman edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="pickupman_delete"
                                                                id="pickupman_delete">
                                                            Pickupman delete
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="deliveryman" id="deliveryman">
                                                            Deliveryman
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="deliveryman_add"
                                                                id="deliveryman_add">
                                                            Deliveryman add
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="deliveryman_edit"
                                                                id="deliveryman_edit">
                                                            Deliveryman edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input hr"
                                                                name="permission[]" value="deliveryman_delete"
                                                                id="deliveryman_delete">
                                                            Deliveryman delete
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                Parcel Manage
                                                <a class="card-link pull-right" data-toggle="collapse"
                                                    href="#parcel_manage">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="parcel_manage" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input parcel_manage"
                                                                name="permission[]" value="parcel_manage"
                                                                id="parcel_manage">
                                                            Parcel manage
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input parcel_manage"
                                                                name="permission[]" value="parcel_create"
                                                                id="parcel_create">
                                                            Parcel create
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input parcel_manage"
                                                                name="permission[]" value="parcel_edit" id="parcel_edit">
                                                            Parcel edit
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input parcel_manage"
                                                                name="permission[]" value="multiple_parcel_pick"
                                                                id="multiple_parcel_pick">
                                                            Multiple parcel pick
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header bg-light">
                                                Payment
                                                <a class="card-link pull-right" data-toggle="collapse" href="#payment">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="payment" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input payment"
                                                                name="permission[]" value="payment" id="payment">
                                                            Payment
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input payment"
                                                                name="permission[]" value="payment_to_merchant"
                                                                id="payment_to_merchant">
                                                            Payment to merchant
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input payment"
                                                                name="permission[]" value="payment_to_pickupman"
                                                                id="payment_to_pickupman">
                                                            Payment to Pickupman
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input payment"
                                                                name="permission[]" value="payment_to_deliveryman"
                                                                id="payment_to_deliveryman">
                                                            Payment to Deliveryman
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                Report
                                                <a class="card-link pull-right" data-toggle="collapse" href="#report">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div id="report" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input report"
                                                                name="permission[]" value="report" id="report">
                                                            Report
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input report"
                                                                name="permission[]" value="summary_report"
                                                                id="summary_report">
                                                            Summary Report
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input report"
                                                                name="permission[]" value="merchant_based_report"
                                                                id="merchant_based_report">
                                                            Merchant Based Report
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input report"
                                                                name="permission[]" value="pickupman_based_report"
                                                                id="pickupman_based_report">
                                                            Pickupman Based Report
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input report"
                                                                name="permission[]" value="deliveryman_based_report"
                                                                id="deliveryman_based_report">
                                                            Deliveryman Based Report
                                                        </label>
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
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
