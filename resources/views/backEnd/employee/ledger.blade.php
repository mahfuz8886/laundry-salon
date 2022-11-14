@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee', 'menu-open')
@section('employee_ledger', 'active')
@section('title', 'Ledger')
@section('extracss')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }



        .select2-results__option[aria-selected=true]:before {
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }

        .select2-container .select2-selection--multiple {
            height: 150px !important;
            margin: 0;
            padding: 0;
            line-height: inherit;
            border-radius: 0;
            overflow: scroll;
        }
    </style>
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> @lang('common.employee_ledger') </h3>
                </div>
                <form action="" method="GET">
                    {{-- @csrf --}}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="username"> Employee <span class="text-danger">*</span>
                                    </label>
                                    <select name="employee_id" id="employee_id" class="form-control select2" required>
                                        <option value=""> @lang('common.choose') </option>
                                        @foreach ($employees as $employee)
                                            <option @if (Request::get('employee_id')) {{ $_GET['employee_id'] == $employee->id ? 'selected':''  }} @endif value="{{ $employee->id }}">
                                                {{ $employee->name ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Date From <span class="text-danger">*</span> </label>
                                    <input type="date" name="date_from" value="{{ $_GET['date_from'] ?? '' }}"
                                        class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Date to <span class="text-danger">*</span> </label>
                                    <input type="date" name="date_to" value="{{ $_GET['date_to'] ?? '' }}"
                                        class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            {{-- salary details --}}

            {{-- @if ($employee_det != null)
                <form action="{{ URL('superadmin/salarysheet/store') }}" method="post">
                    @csrf

                    @foreach ($employee_det as $item)
                        @if ($item['salarysheet'] == true)
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"> {{ $item['name'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="text-center">
                                                Salary already created
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"> {{ $item['name'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="year"> Gross Salary <span class="text-danger">*</span>
                                                </label>
                                                <input type="hidden" name="employee_id[]"
                                                    value="{{ $item['employee_id'] }}">
                                                <input type="hidden" name="month" value="{{ $month }}">
                                                <input type="hidden" name="year" value="{{ $year }}">
                                                <input type="hidden" name="invoice_no" value="{{ $item['invoice_no'] }}">
                                                <input readonly type="text" name="gross_salary[]" id="gross_salary"
                                                    class="form-control {{ $errors->has('gross_salary') ? ' is-invalid' : '' }}"
                                                    value="{{ old('gross_salary', $item['gross_salary']) }}" required>
                                                @if ($errors->has('gross_salary'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('gross_salary') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="username"> Commission <span class="text-danger">*</span>
                                                </label>
                                                <input readonly type="text" name="month_commission[]" id="month_commission"
                                                    class="form-control {{ $errors->has('month_commission') ? ' is-invalid' : '' }}"
                                                    value="{{ old('month_commission', $item['month_commission']) }}">
                                                @if ($errors->has('month_commission'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('month_commission') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="username"> Withdraw Commission <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input readonly type="text" name="month_withdraw_commission[]"
                                                    id="month_withdraw_commission"
                                                    class="form-control {{ $errors->has('month_withdraw_commission') ? ' is-invalid' : '' }}"
                                                    value="{{ old('month_withdraw_commission', $item['month_withdraw_commission']) }}">
                                                @if ($errors->has('month_withdraw_commission'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('month_withdraw_commission') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="username"> Advance <span class="text-danger">*</span>
                                                </label>
                                                <input readonly type="text" name="advance[]" id="advance"
                                                    class="form-control {{ $errors->has('advance') ? ' is-invalid' : '' }}"
                                                    value="{{ old('advance', $item['advance']) }}">
                                                @if ($errors->has('advance'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('advance') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="username"> Payable Amount <span class="text-danger">*</span>
                                                </label>
                                                @php
                                                    $payable = ($item['gross_salary'] + $item['month_commission']);
                                                    $payable = $payable - ($item['month_withdraw_commission'] + $item['advance']);
                                                @endphp
                                                <input readonly type="text" name="amount[]" id="amount"
                                                    class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                    value="{{ old('amount', $payable) }}">
                                                @if ($errors->has('amount'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="username"> Bonus
                                                </label>
                                                <input type="number" name="bonus[]" id="bonus"
                                                    class="form-control {{ $errors->has('bonus') ? ' is-invalid' : '' }}"
                                                    value="{{ old('bonus') }}">
                                                @if ($errors->has('bonus'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('bonus') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="username"> Fine
                                                </label>
                                                <input type="number" name="fine[]" id="fine"
                                                    class="form-control {{ $errors->has('fine') ? ' is-invalid' : '' }}"
                                                    value="{{ old('fine') }}">
                                                @if ($errors->has('fine'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('fine') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif --}}

            {{-- salary details --}}



            {{-- ledger --}}
            @if (Request::get('employee_id') != null)
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> 
                        Month:&nbsp;{{ date('d-M-Y', strtotime($head['date_from'])) }}&nbsp;to &nbsp; {{ date('d-M-Y', strtotime($head['date_to'])) }},&nbsp; Name:&nbsp;{{ $head['emp_name'] ?? '' }} 
                    </h3>
                </div>
                <div class="card-body">
                    <div class="teble-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.date')</th>
                                    <th>@lang('common.number_of_work')</th>
                                    <th>@lang('common.total')&nbsp;@lang('common.commission')</th>
                                    <th>@lang('common.commission')&nbsp;@lang('common.withdraw')</th>
                                    <th>@lang('common.commission')&nbsp;@lang('common.due')</th>
                                    <th>@lang('common.advance')</th>
                                    <th>@lang('common.total_work')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sub_no_of_work = 0;
                                    $sub_total_commission = 0;
                                    $sub_paid_commission = 0;
                                    $sub_due_commission = 0;
                                    $sub_advance = 0;
                                @endphp
                                @forelse ($data as $item)
                                    <tr>
                                        <td> {{ date('d-M-Y', strtotime($item['date'])) ?? '' }} </td>
                                        <td class="text-center"> {{ $item['no_of_work'] ?? '' }} </td>
                                        <td class="text-center"> {{ $item['total_commission'] ?? '' }} </td>
                                        <td class="text-center"> {{ $item['paid_commission'] ?? '' }} </td>
                                        <td class="text-center"> {{ $item['due_commission'] ?? '' }} </td>
                                        <td class="text-center"> {{ $item['advance'] ?? '' }} </td>
                                        <td class="text-center"> {{ $item['today_total'] ?? '' }} </td>
                                    </tr>
                                    @php
                                        $sub_no_of_work = $sub_no_of_work + $item['no_of_work'];
                                        $sub_total_commission = $sub_total_commission + $item['total_commission'];
                                        $sub_paid_commission = $sub_paid_commission + $item['paid_commission'];
                                        $sub_due_commission = $item['due_commission'];
                                        $sub_advance = $sub_advance + $item['advance'];
                                    @endphp
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6"> @lang('common.no_record_found') </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="text-left">@lang('common.total'):&nbsp;{{ $sub_no_of_work }}</th>
                                    <th class="text-left">@lang('common.commission'):&nbsp;{{ $sub_total_commission }}</th>
                                    <th class="text-left">@lang('common.withdraw'):&nbsp;{{ $sub_paid_commission }}</th>
                                    <th class="text-left">@lang('common.due'):&nbsp;{{ $sub_due_commission }}</th>
                                    <th class="text-left">@lang('common.advance'):&nbsp;{{ $sub_advance }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            {{-- ledger --}}

        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var options = '<option value="">@lang('common.choose')</option>';
            $.ajax({
                method: "GET",
                url: "{{ route('get_employee') }}",
            }).done(function(response) {

                response.forEach(function(item, i) {
                    /*if (selected == item.id) {
                        options += '<option selected value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    } else {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    }*/
                    options += '<option @if (Request::get('employee_id')) {{ $_GET['employee_id'] === '+ item.id +' ? 'selected':''  }} @endif value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    // console.log(options);
                });
                // $('#employee_id').html(options);

            });
        });
    </script>
@endsection
