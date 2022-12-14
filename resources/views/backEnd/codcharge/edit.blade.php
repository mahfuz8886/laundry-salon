@extends('backEnd.layouts.master')
@section('cod_charge', 'active menu-open')
@section('cod_charge_manage', 'active')
@section('title', 'Codcharge Edit')
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
                                        <h5>Codcharge Edit</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/codcharge/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            Manage
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Cod charge Edit</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ url('admin/codcharge/update') }}" method="POST"
                                        enctype="multipart/form-data" name="editForm">
                                        @csrf
                                        <div class="main-body">
                                            <div class="row">
                                                <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="codcharge">Cod charge (%)</label>
                                                        <input type="text" name="codcharge" id="codcharge"
                                                            class="form-control {{ $errors->has('codcharge') ? ' is-invalid' : '' }}"
                                                            value="{{ $edit_data->codcharge }}">
                                                        @if ($errors->has('codcharge'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('codcharge') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <!-- column end -->

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="custom-label">
                                                            <label>Publication Status</label>
                                                        </div>
                                                        <div class="box-body pub-stat display-inline">
                                                            <input
                                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                type="radio" id="active" name="status" value="1">
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
                                                                type="radio" name="status" value="0" id="inactive">
                                                            <label for="inactive">Inactive</label>
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
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
