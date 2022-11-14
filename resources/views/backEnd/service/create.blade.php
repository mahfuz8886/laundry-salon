@extends('backEnd.layouts.master')
@section('website', 'active menu-open')
@section('service', 'active')
@section('title', 'Create Service Info')
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
                        <li class="breadcrumb-item active"><a href="{{ url('editor/service/manage') }}">@lang('common.service')</a></li>
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
                            <h5>@lang('common.create_service_information')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('editor/service/manage') }}" class="btn btn-primary btn-actions btn-create">
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
                                        <h3 class="card-title">@lang('common.add_service')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('editor/service/store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">

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
                                                <label for="description_bn">@lang('common.description_bn')</label>
                                                <textarea type="text" class="summernote form-control {{ $errors->has('description_bn') ? ' is-invalid' : '' }}" value="{{ old('description_bn') }}" name="description_bn"></textarea>
                                                @if ($errors->has('description_bn'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description_bn') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="image">@lang('common.image')</label>
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
