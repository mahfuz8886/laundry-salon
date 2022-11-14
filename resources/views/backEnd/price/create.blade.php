@extends('backEnd.layouts.master')
@section('website', 'active menu-open')
@section('price', 'active')
@section('title', 'Add Price Info')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Welcome !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="#">Price</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                            <h5>Add Price Info</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('editor/price/manage') }}" class="btn btn-primary btn-actions btn-create">
                                Manage
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
                                        <h3 class="card-title">Add Price Info</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('editor/price/store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="pricetype_id">Price type</label>
                                                <select
                                                    class="form-control {{ $errors->has('pricetype_id') ? ' is-invalid' : '' }}"
                                                    value="{{ old('pricetype_id') }}" name="pricetype_id"
                                                    id="pricetype_id">

                                                    <option value="">--Select type--</option>
                                                    @foreach ($pricetype as $value)
                                                        <option value="{{ $value->id }}">{{ $value->pricetypeName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('pricetype_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('pricetype_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name') }}" name="name" id="name">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            {{-- <div class="form-group">
                                                <label for="name_bn">Name Bangla</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name_bn') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name_bn') }}" name="name_bn" id="name_bn">
                                                @if ($errors->has('name_bn'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name_bn') }}</strong>
                                                    </span>
                                                @endif
                                            </div> --}}
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                                                    value="{{ old('price') }}" name="price" id="price">
                                                @if ($errors->has('price'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            {{-- <div class="form-group">
                                                <label for="price_bn">Price Bangla</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('price_bn') ? ' is-invalid' : '' }}"
                                                    value="{{ old('price_bn') }}" name="price_bn" id="price_bn">
                                                @if ($errors->has('price_bn'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('price_bn') }}</strong>
                                                    </span>
                                                @endif
                                            </div> --}}
                                            <!-- form group -->

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
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
