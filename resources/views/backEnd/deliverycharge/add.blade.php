@extends('backEnd.layouts.master')
@section('delivery_charge', 'active menu-open')
@section('delivery_charge_add', 'active')
@section('title', 'Delivery Charge Add')
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
                                        <h5>Add</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/deliverycharge/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            Manage
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Category Add Instructions</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ url('admin/deliverycharge/save') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="delivery_charge_head_id"> Delivery Charge Head </label>
                                                        <select name="delivery_charge_head_id" id="delivery_charge_head_id" class="form-control">
                                                            @foreach ($delivery_charge_heads as $delivery_charge_head)
                                                                <option value="{{ $delivery_charge_head->id }}" @if (old('delivery_charge_head_id')) selected @endif>
                                                                    {{ $delivery_charge_head->name }} ({{ $delivery_charge_head->service_time }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('delivery_charge_head_id'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('delivery_charge_head_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="subtitle"> Weight (name) </label>
                                                        <input type="text" name="weight" id="weight"
                                                            class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}"
                                                            value="{{ old('weight') }}">
                                                        @if ($errors->has('weight'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('weight') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="deliverycharge"> Delivery Charge </label>
                                                        <input type="text" name="deliverycharge" id="deliverycharge"
                                                            class="form-control {{ $errors->has('deliverycharge') ? ' is-invalid' : '' }}"
                                                            value="{{ old('deliverycharge', 0) }}">
                                                        @if ($errors->has('deliverycharge'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('deliverycharge') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="extradeliverycharge"> Extra Delivery Charge (Per kg) </label>
                                                        <input type="text" name="extradeliverycharge"
                                                            id="extradeliverycharge"
                                                            class="form-control {{ $errors->has('extradeliverycharge') ? ' is-invalid' : '' }}"
                                                            value="{{ old('extradeliverycharge', 0) }}">
                                                        @if ($errors->has('extradeliverycharge'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('extradeliverycharge') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="custom-label">
                                                            <label>Publication Status</label>
                                                        </div>
                                                        <div class="box-body pub-stat display-inline">
                                                            <input
                                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                type="radio" id="active" name="status" value="1" @if (old('status',1)==1) checked @endif>
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
                                                                type="radio" name="status" value="0" id="inactive" @if (old('status',1)==0) checked @endif>
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
@endsection
