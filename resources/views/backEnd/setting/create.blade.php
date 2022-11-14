@extends('backEnd.layouts.master')
@section('website', 'active menu-open')
@section('setting', 'active')
@section('title', 'Setting')
@section('style')
    <style>
        .logo img{
            margin: 10px 0px;
            padding: 3px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
    </style>
@endsection

@section('content')

    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $error }}
        </div>
    @endforeach
    @endif


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">@lang('common.welcome') !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('login') }}">@lang('common.dashborad')</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/editor/setting/create') }}">@lang('common.settings')</a></li>
                        <li class="breadcrumb-item active">@lang('common.create')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="manage-button">
                        <div class="body-title">
                            <h5> @lang('common.settings') </h5>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form start -->
            <form role="form" action="{{ url('editor/setting/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.setting_information') </h3>
                                        </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.company_name') </label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $setting->name??'') }}">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.mobile_no') </label>
                                                    <input type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $setting->mobile_no??'') }}" class="form-control">
                                                    @if ($errors->has('mobile_no'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mobile_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.email_address') </label>
                                                    <input type="text" name="email" id="email" value="{{ old('email', $setting->email??'') }}" class="form-control">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.website') </label>
                                                    <input type="text" name="web" id="web" value="{{ old('web', $setting->web??'') }}" class="form-control">
                                                    @if ($errors->has('web'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('web') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.address') </label>
                                                    <textarea name="address" id="address" class="form-control" rows="5">{!! old('address', $setting->address??'') !!}</textarea>
                                                    @if ($errors->has('address'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.address_bn') </label>
                                                    <textarea name="address_bn" id="address_bn" class="form-control" rows="5">{!! old('address_bn', $setting->address_bn??'') !!}</textarea>
                                                    @if ($errors->has('address_bn'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('address_bn') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.logo_upload') </h3>
                                        </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    {{-- <label for="logo"> @lang('common.logo') </label> --}}
                                                    @if ($setting->logo)
                                                        <div class="logo">
                                                            <img src="{{ asset($setting->logo) }}" height="100" width="100" alt="Logo">
                                                        </div>
                                                    @endif
                                                    
                                                    <input type="file" name="logo" id="logo" value="" class="form-control">
                                                    @if ($errors->has('logo'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('logo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.social_information') </h3>
                                        </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.facebook') </label>
                                                    <input type="text" name="facebook" id="facebook" value="{{ old('facebook', $setting->facebook??'') }}" class="form-control">
                                                    @if ($errors->has('facebook'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('facebook') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.twitter') </label>
                                                    <input type="text" name="twitter" id="twitter" value="{{ old('twitter', $setting->twitter??'') }}" class="form-control">
                                                    @if ($errors->has('twitter'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('twitter') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.google_plus') </label>
                                                    <input type="text" name="google_plus" id="google_plus" value="{{ old('google_plus', $setting->google_plus??'') }}" class="form-control">
                                                    @if ($errors->has('google_plus'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('google_plus') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> @lang('common.instagram') </label>
                                                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $setting->instagram??'') }}" class="form-control">
                                                    @if ($errors->has('instagram'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('instagram') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary"> @lang('common.submit') </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
