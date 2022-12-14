@extends('backEnd.layouts.master')
@section('area', 'active menu-open')
@section('division_manage', 'active')
@section('title', 'Division Edit')
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
                                        <h5>@lang('common.division') @lang('common.edit')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/division/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.division') @lang('common.edit')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ url('admin/division/update') }}" method="POST"
                                        enctype="multipart/form-data" name="editForm">
                                        @csrf
                                        <div class="main-body">
                                            <div class="row">
                                                <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.division')</label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ $edit_data->name }}">
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <!-- column end -->

                                                <div class="col-sm-12">
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
                                                </div>
                                                <div class="col-sm-12 mrt-15">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">@lang('common.submit')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- col end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        document.forms['editForm'].elements['status'].value = "{{ $edit_data->status }}"
    </script>
@endsection
