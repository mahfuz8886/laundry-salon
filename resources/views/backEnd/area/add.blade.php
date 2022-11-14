@extends('backEnd.layouts.master')
@section('area', 'active menu-open')
@section('area_manage', 'active')
@section('title', 'area Add')
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
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/area/manage') }}">Area</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                            <h5>@lang('common.area') @lang('common.create')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('admin/area/manage') }}" class="btn btn-primary btn-actions btn-create">
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
                            <div class="col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.area') @lang('common.add') </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('admin/area/save') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="division_id">@lang('common.division') <span class="text-danger">*</span> </label>
                                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                                        <option value=""> @lang('common.select_division') </option>
                                                        @foreach ($divisions as $division)
                                                            <option value="{{ $division->id }}"> {{ $division->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="district_id">@lang('common.district') <span class="text-danger">*</span> </label>
                                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                                        <option value="">@lang('common.select_district') </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="thana_id">@lang('common.thana')  <span class="text-danger">*</span> </label>
                                                    <select name="thana_id" id="thana_id" class="form-control select2" required>
                                                        <option value="">@lang('common.select_thana') </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="coverage"> @lang('common.coverage')  <span class="text-danger">*</span> </label>
                                                    <select name="coverage" id="coverage" class="form-control select2" required>
                                                        <option value="1" @if (old('coverage')==1) selected @endif> @lang('common.yes') </option>
                                                        <option value="0" @if (old('coverage')==0) selected @endif> @lang('common.no') </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="delivery_type"> @lang('common.delivery_type')  <span class="text-danger">*</span> </label>
                                                    <select name="delivery_type" id="delivery_type" class="form-control select2" required>
                                                        <option value="1" @if (old('delivery_type')==1) selected @endif> @lang('common.home_delivery') </option>
                                                        <option value="2" @if (old('delivery_type')==2) selected @endif> @lang('common.point_delivery') </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pickup"> @lang('common.pickup')  <span class="text-danger">*</span> </label>
                                                    <select name="pickup" id="pickup" class="form-control select2" required>
                                                        <option value="1" @if (old('pickup')==1) selected @endif> @lang('common.yes') </option>
                                                        <option value="0" @if (old('pickup')==0) selected @endif> @lang('common.no') </option>
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group col-md-12">
                                                    <label for="thana_id">Thana  <span class="text-danger">*</span> </label>
                                                    <select name="thana_id" id="thana_id" class="form-control" required>
                                                        <option value="">Select Thana </option>
                                                        @foreach ($thanas as $thana)
                                                            <option value="{{ $thana->id }}"> {{ $thana->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                {{-- <div class="form-group col-md-6">
                                                    <label for="pickupman_id"> Pickupman </label>
                                                    <select name="pickupman_id" id="pickupman_id" class="form-control">
                                                        <option value="">Select Pickupman </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="deliverymen_id"> Deliveryman </label>
                                                    <select name="deliverymen_id" id="deliverymen_id" class="form-control">
                                                        <option value="">Select Deliverymen </option>
                                                    </select>
                                                </div> --}}
                                                <div class="form-group col-md-12">
                                                    <label for="name"> @lang('common.name')  <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                        value="{{ old('name') }}" name="name" id="name" required>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="custom-label">
                                                        <label> @lang('common.publication_status')  <span class="text-danger"> * </span> </label>
                                                    </div>
                                                    <div class="box-body pub-stat display-inline">
                                                        <input
                                                            class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                            type="radio" id="active" name="status" value="1" @if (old('status',1)==1) checked @endif>
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
                                                            type="radio" name="status" value="0" id="inactive @if (old('status')==0) checked @endif">
                                                        <label for="inactive">@lang('common.inactive')</label>
                                                        @if ($errors->has('status'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
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

@section('script')
    <script>
        $(function(){
            // Get District
            $('body').on('change', '#division_id', function(){
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {'division_id':division_id},
                }).done(function( response ) {
                    // console.log(response);
                    response.forEach(function(item,i){
                        options += '<option value="'+item.id+'"> '+item.name+' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
            //Get Thana
            $('body').on('change', '#district_id', function(){
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select Thana </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {'district_id':district_id},
                }).done(function( response ) {
                    // console.log(response);
                    response.forEach(function(item,i){
                        options += '<option value="'+item.id+'"> '+item.name+' </option>';
                    });
                    $('#thana_id').html(options);
                });
            })
            // Get Deliveryman & Pickupman
            $('body').on('change', '#thana_id', function(){
                var thana_id = $('#thana_id').val();
                var deliverymans = '<option value=""> Select Deliveryman </option>';
                var pickupmans = '<option value=""> Select Pickupman </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_deliverymen_pickupman') }}",
                    data: {'thana_id':thana_id},
                }).done(function( response ) {
                    // console.log(response.deliverymens);
                    var deliveryman_data = response.deliverymens;
                    var pickupman_data = response.pickupmens;
                    if(deliveryman_data){
                        deliveryman_data.forEach(function(item,i){
                            deliverymans += '<option value="'+item.id+'"> '+item.name+' - '+item.phone+' </option>';
                        });
                    }
                    if(pickupman_data){
                        pickupman_data.forEach(function(item,i){
                            pickupmans += '<option value="'+item.id+'"> '+item.name+' - '+item.phone+' </option>';
                        });
                    }
                    $('#deliverymen_id').html(deliverymans);
                    $('#pickupman_id').html(pickupmans);
                });
            })
        })

    </script>
@endsection