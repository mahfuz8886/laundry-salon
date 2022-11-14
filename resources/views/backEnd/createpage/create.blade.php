@extends('backEnd.layouts.master')
@section('website', 'active menu-open')
@section('create_page', 'active')
@section('title', 'Create Page')
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
                        <li class="breadcrumb-item active"><a href="{{ url('editor/createpage/manage') }}">@lang('common.page')</a></li>
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
                            <h5>@lang('common.page') @lang('common.create')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('editor/createpage/manage') }}"
                                class="btn btn-primary btn-actions btn-create">
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
                                        <h3 class="card-title">@lang('common.page_information')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('editor/createpage/store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="page_area">@lang('common.page_area')</label>
                                                <select name="page_area" id="page_area"
                                                    class="form-control {{ $errors->has('page_area') ? ' is-invalid' : '' }}"
                                                    value="{{ old('page_area') }}">
                                                    <option value="">--@lang('common.select_area')--</option>
                                                    <option value="Left Area">@lang('common.left_area')</option>
                                                    {{-- <option value="Right Area">@lang('common.right_area')</option> --}}
                                                </select>
                                                @if ($errors->has('page_area'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('page_area') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="pageName">@lang('common.page_name')</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('pageName') ? ' is-invalid' : '' }}"
                                                    value="{{ old('pageName') }}" name="pageName" id="pageName">
                                                @if ($errors->has('pageName'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('pageName') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="pageName_bn">@lang('common.page_name_bn')</label>
                                                <input type="text" class="form-control {{ $errors->has('pageName_bn') ? ' is-invalid' : '' }}" value="{{ old('pageName_bn') }}" name="pageName_bn" id="pageName_bn">
                                                    @if ($errors->has('pageName_bn'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('pageName_bn') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                            <!-- form group -->

                                            <div class="form-group">
                                                <label for="title">@lang('common.title')</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                    value="{{ old('title') }}" name="title" id="title">
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="title_bn">@lang('common.title_bn')</label>
                                                <input type="text" class="form-control {{ $errors->has('title_bn') ? ' is-invalid' : '' }}" value="{{ old('title_bn') }}" name="title_bn" id="title_bn">
                                                    @if ($errors->has('title_bn'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title_bn') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="text">@lang('common.description')</label>
                                                <textarea type="text" class="summernote form-control {{ $errors->has('text') ? ' is-invalid' : '' }}"
                                                    value="{{ old('text') }}" name="text"></textarea>
                                                @if ($errors->has('text'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('text') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="text_bn">@lang('common.description_bn')</label>
                                                <textarea type="text" class="summernote form-control {{ $errors->has('text_bn') ? ' is-invalid' : '' }}" value="{{ old('text_bn') }}" name="text_bn"></textarea>
                                                    @if ($errors->has('text_bn'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('text_bn') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
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
