@extends('backEnd.layouts.master')
@section('website', 'active menu-open')
@section('logo', 'active')
@section('title', 'Create Logo')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">@lang('common.welcome') !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('login') }}">@lang('common.dashborad')</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('editor/logo/manage') }}">@lang('common.logo')</a></li>
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
                            <h5>@lang('common.create')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('editor/logo/manage') }}" class="btn btn-primary btn-actions btn-create">
                            @lang('common.manage')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.add_new_logo')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('editor/logo/store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="image">@lang('common.image') ( <small class="text-danger"> Size: 400x250 px</small> ) </label>
                                                <input type="file"
                                                    class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                    value="{{ old('image') }}" accept="image/png*" name="image"
                                                    id="image">
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="type">@lang('common.image_for')</label>
                                                <select
                                                    class="form-control select2{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                                    value="{{ old('type') }}" name="type" id="type">
                                                    {{-- <option selected="selected" value="">===Image For===</option> --}}
                                                    {{-- <option value="1">White Logo</option> --}}
                                                    {{-- <option value="2">Dark Logo</option> --}}
                                                    {{-- <option value="3">Faveicon</option> --}}
                                                    <option value="4">@lang('common.sponsor')</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <div class="custom-label">
                                                    <label>@lang('common.publication_status')</label>
                                                </div>
                                                <div class="box-body pub-stat display-inline">
                                                    <input
                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                        type="radio" id="active" name="status" value="1">
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
                                                        type="radio" name="status" value="0" id="inactive">
                                                    <label for="inactive">@lang('common.inactive')</label>
                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
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
