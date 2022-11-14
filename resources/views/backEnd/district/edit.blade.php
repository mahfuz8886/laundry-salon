@extends('backEnd.layouts.master')
@section('area', 'active menu-open')
@section('district_manage', 'active')
@section('title', 'District Edit')
@section('content')
    <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Welcome !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/login') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/district/manage') }}">District</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="manage-button">
                        <div class="body-title">
                            <h5>@lang('common.update') @lang('common.district')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('admin/district/manage') }}" class="btn btn-primary btn-actions btn-create">
                            @lang('common.manage')
                            </a>
                            <a href="{{ url('admin/district/create') }}" class="btn btn-primary btn-actions btn-create">
                            @lang('common.create')
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
                                        <h3 class="card-title">@lang('common.update') @lang('common.district')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('admin/district/update') }}" method="POST"
                                        enctype="multipart/form-data" name="editForm">
                                        @csrf
                                        <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="division_id">@lang('common.division')</label>
                                                <select name="division_id" id="" class="form-control select2" required>
                                                    <option value="">@lang('common.select_division')</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}" @if (old('division_id',$edit_data->division_id)==$division->id) selected @endif> 
                                                            {{ $division->name }} 
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">@lang('common.name')</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name',$edit_data->name) }}" name="name" id="name">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
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
                                                        type="radio" id="active" name="status" value="1" @if (old('status', $edit_data->status)==1) checked @endif>
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
                                                        type="radio" name="status" value="0" @if (old('status', $edit_data->status)==0) checked @endif>
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
                                            <button type="submit" class="btn btn-primary">@lang('common.update')</button>
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
