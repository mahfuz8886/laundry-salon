@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee', 'menu-open')
@section('employee_manage', 'active')
@section('title', 'Update employee')
@section('content')
    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.employee') @lang('common.commission_pay')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/employee/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.employee') @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('admin/employee/commission') }}" method="POST">
                                @csrf
                                @php
                                    $total_commission = $employee->account_head->tot_commission;
                                    $total_commission = $total_commission->sum('amount');

                                    $total_paid_commission = $employee->account_head->tot_paid_commission;
                                    $total_paid_commission = $total_paid_commission->sum('amount');

                                    $remaining_commission = $total_commission - $total_paid_commission;
                                @endphp
                                <input type="hidden" name="hidden_id" value="{{ $employee->id }}">
                                <div class="col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.commission_information') </h3>
                                        </div>
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.total_commission') <span class="text-danger">*</span>
                                                        </label>
                                                        <input readonly type="number" name="total_commission" id="total_commission"
                                                            class="form-control {{ $errors->has('total_commission') ? ' is-invalid' : '' }}"
                                                            value="{{ old('total_commission', $total_commission) }}" required>

                                                        @if ($errors->has('total_commission'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('total_commission') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.total_paid_commission') <span class="text-danger">*</span>
                                                        </label>
                                                        <input readonly type="number" name="total_paid_commission" id="total_paid_commission"
                                                            class="form-control {{ $errors->has('total_paid_commission') ? ' is-invalid' : '' }}"
                                                            value="{{ old('total_paid_commission', $total_paid_commission) }}" required>
                                                            
                                                        @if ($errors->has('total_paid_commission'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('total_paid_commission') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.remaining_commission') <span class="text-danger">*</span>
                                                        </label>
                                                        <input readonly type="number" name="remaining_commission" id="remaining_commission"
                                                            class="form-control {{ $errors->has('remaining_commission') ? ' is-invalid' : '' }}"
                                                            value="{{ old('remaining_commission', $remaining_commission) }}" required>
                                                            
                                                        @if ($errors->has('remaining_commission'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('remaining_commission') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.amount') <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="amount" id="amount"
                                                            class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                            value="{{ old('amount', 0) }}" required>
                                                            <p class="text-danger" id="warning">
                                                            </p>
                                                            
                                                        @if ($errors->has('amount'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('amount') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->

                                                <div class="col-sm-12 mrt-30">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" id="submit-btn">@lang('common.submit') </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('change keyup', '#amount', function() {
                //console.log('clickeddddd');
                var amount = $(this).val();
                var remaining_commission = $('#remaining_commission').val();

                if(Number(amount) > Number(remaining_commission)) {
                    $('#warning').text("Paid Amount can not exceed remaining balance");
                    $('#submit-btn').prop('disabled', true);
                } else {
                    $('#warning').empty();
                    $('#submit-btn').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
