@extends('backEnd.layouts.master')
@section('delivery_charge', 'active menu-open')
@section('delivery_charge_manage', 'active')
@section('title', 'Delivery Charge Edit')
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
                                        <h5>@lang('common.edit')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/deliverycharge/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.edit')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="{{ url('admin/deliverycharge/update') }}" method="POST"
                                        enctype="multipart/form-data" name="editForm">
                                        @csrf
                                        <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="delivery_charge_head_id"> @lang('common.delivery_charge_head') </label>
                                                        <select name="delivery_charge_head_id" id="delivery_charge_head_id"
                                                            class="form-control">
                                                            @foreach ($delivery_charge_heads as $delivery_charge_head)
                                                                <option value="{{ $delivery_charge_head->id }}"
                                                                    @if (old('delivery_charge_head_id', $edit_data->delivery_charge_head_id) == $delivery_charge_head->id) selected @endif>
                                                                    {{ $delivery_charge_head->name }}
                                                                    ({{ $delivery_charge_head->service_time }})
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
                                                        <label for="subtitle"> @lang('common.weight') (name) </label>
                                                        <input type="text" name="weight" id="weight"
                                                            class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}"
                                                            value="{{ old('weight', $edit_data->weight) }}">
                                                        @if ($errors->has('weight'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('weight') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="deliverycharge"> @lang('common.delivery_charge') </label>
                                                        <input type="text" name="deliverycharge" id="deliverycharge"
                                                            class="form-control {{ $errors->has('deliverycharge') ? ' is-invalid' : '' }}"
                                                            value="{{ old('deliverycharge', $edit_data->deliverycharge) }}">
                                                        @if ($errors->has('deliverycharge'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('deliverycharge') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="extradeliverycharge"> @lang('common.extra_delivery_charge')
                                                        </label>
                                                        <input type="text" name="extradeliverycharge"
                                                            id="extradeliverycharge"
                                                            class="form-control {{ $errors->has('extradeliverycharge') ? ' is-invalid' : '' }}"
                                                            value="{{ old('extradeliverycharge', $edit_data->extradeliverycharge) }}">
                                                        @if ($errors->has('extradeliverycharge'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('extradeliverycharge') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="cod_charge"> @lang('common.cod_charge') (%) </label>
                                                        <input type="number" step="any" name="cod_charge" id="cod_charge"
                                                            class="form-control {{ $errors->has('cod_charge') ? ' is-invalid' : '' }}"
                                                            value="{{ old('cod_charge', $edit_data->cod_charge) }}">
                                                        @if ($errors->has('cod_charge'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('cod_charge') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="custom-label">
                                                            <label>@lang('common.publication_status')</label>
                                                        </div>
                                                        <div class="box-body pub-stat display-inline">
                                                            <input
                                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                type="radio" id="active" name="status" value="1"
                                                                @if (old('status', $edit_data->status) == 1) checked @endif>
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
                                                                type="radio" name="status" value="0" id="inactive"
                                                                @if (old('status', $edit_data->status) == 0) checked @endif>
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
