@extends('backEnd.layouts.master')
@section('discount', 'active menu-open')
@section('promotional_discount', 'active')
@section('title', 'Promotional Discount')
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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">@lang('common.welcome') !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('login') }}">@lang('common.dashborad')</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/editor/promotional-discount/add') }}">@lang('common.promotional_discount')</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" action="{{ url('admin/promotional-discount/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.discount_information') </h3>
                                        </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="start_date"> @lang('common.date_from') <span class="text-danger">*</span> </label>
                                                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $discount->start_date??'') }}" required>
                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="end_date"> @lang('common.date_to') <span class="text-danger">*</span> </label>
                                                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $discount->end_date??'') }}" required>
                                                    @if ($errors->has('end_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('end_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="discount"> @lang('common.discount') (%) <span class="text-danger">*</span> </label>
                                                    <input type="number" step="any" name="discount" class="form-control" value="{{ old('discount', $discount->discount??0) }}" required>
                                                    @if ($errors->has('discount'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('discount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="status"> @lang('common.status') <span class="text-danger">*</span> </label>
                                                    <select name="status" id="status" class="form-control select2" required>
                                                        <option value="1" @if (old('status', $discount->status??1)==1) selected @endif> Active </option>
                                                        <option value="0" @if (old('status', $discount->status??1)==0) selected @endif> Inactive </option>
                                                    </select>
                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('status') }}</strong>
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
