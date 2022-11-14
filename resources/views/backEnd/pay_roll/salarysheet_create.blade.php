@extends('backEnd.layouts.master')
@section('pay_roll', 'active menu-open')
@section('salarysheet_create', 'active')
@section('title', 'Salaraysheet Create')
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
                    <h3 class="card-title"> @lang('common.salarysheet_create') </h3>
                </div>
                <form action="{{ URL('superadmin/salarysheet/create') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year"> Year <span class="text-danger">*</span>
                                    </label>
                                    <select name="year" id="year"
                                        class="form-control select2 {{ $errors->has('year') ? ' is-invalid' : '' }}"
                                        required>
                                        @php
                                            $years = App\Year::where('status', 1)->get();
                                        @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach ($years as $value)
                                            <option value="{{ $value->title }}"
                                                @if (old('year', $year ?? '') == $value->title) selected @endif>
                                                {{ $value->title }}</option>
                                            {{-- <option value="{{ $value->title }}"
                                                @if (Request::get('year')) {{ $_GET['year'] == $value->title ? 'selected' : '' }} @endif>
                                                {{ $value->title }}</option> --}}
                                        @endforeach
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="username"> Month <span class="text-danger">*</span>
                                    </label>
                                    <select name="month" id="month"
                                        class="form-control select2 {{ $errors->has('month') ? ' is-invalid' : '' }}"
                                        required>
                                        @php
                                            $months = App\Month::where('status', 1)->get();
                                        @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach ($months as $value)
                                            <option value="{{ $value->title }}"
                                                @if (old('month', $month ?? '') == $value->title) selected @endif>
                                                {{ $value->title }}</option>
                                            {{-- <option value="{{ $value->title }}"
                                                @if (Request::get('month')) {{ $_GET['month'] == $value->title ? 'selected' : '' }} @endif>
                                                {{ $value->title }}</option> --}}
                                        @endforeach
                                    </select>
                                    @if ($errors->has('month'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('month') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="username"> Employee <span class="text-danger">*</span>
                                    </label>
                                    {{-- <select name="employee_id[]" id="employee_id" class="form-control multi_select2"
                                        data-type="select-multiple" data-choices-removeItem multiple required> --}}
                                    {{-- @php
                                            if (Session::get('section') == 'laundry') {
                                                $origin = 1;
                                            } elseif (Session::get('section') == 'salon') {
                                                $origin = 2;
                                            } elseif (Session::get('section') == 'pos') {
                                                $origin = 3;
                                            }
                                            $employees = App\Employee::where('origin', $origin)->get();
                                        @endphp --}}
                                    {{-- <option value="">@lang('common.choose')</option> --}}
                                    {{-- <option value="0">All</option>
                                        @foreach ($employees as $value)
                                            <option value="{{ $value->id }}" @if (old('employee_id') == $value->id) selected @endif>
                                                {{ $value->name }}</option>
                                            <option value="{{ $value->id }}"
                                                @if (Request::get('employee_id')) {{ $_GET['employee_id'] == $value->id ? 'selected' : '' }} @endif>
                                                {{ $value->name }}</option>
                                        @endforeach --}}
                                    {{-- </select> --}}
                                    <select data-choices name="employee_id[]" id="employee_id"
                                        class="form-control select2" data-type="select-multiple"
                                        data-choices-removeItem multiple required>
                                        <option value="">Select Employee</option>
                                    </select>
                                    @if ($errors->has('employee_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('employee_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            {{-- salary details --}}

            @if ($employee_det != null)
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

                                        {{-- <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div> --}}

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
            @endif

            {{-- salary details --}}

        </div>
    </section>
@endsection
@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
    <script>
        $('.multi_select2').select2({
            closeOnSelect: false,
        });

        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).ready(function() {
            var options = '<option value="">All</option>';
            var selected = null;
            $.ajax({
                method: "GET",
                url: "{{ route('get_employee') }}",
            }).done(function(response) {

                response.forEach(function(item, i) {
                    if (jQuery.inArray(item.id, selected) != '1') {
                        options += '<option selected value="' + item.id + '"> ' + item
                            .name + '</option>';
                    } else {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            '</option>';
                        // console.log(options);

                    }
                    // console.log(options);
                });
                $('#employee_id').html(options);

            });
        });



        // Get Area
        $('body').on('change', '#agent_id', function() {
            var agent_id = $('#agent_id').val();
            var options = '<option value="">All</option>';
            var selected = null;
            $.ajax({
                method: "GET",
                url: "{{ route('get_employee') }}",
                data: {
                    'agent_id': agent_id
                },
            }).done(function(response) {
                // console.log(response);
                response.forEach(function(item, i) {
                    if (jQuery.inArray(item.id, selected) != '-1') {
                        options += '<option selected value="' + item.id + '"> ' + item
                            .name + ' (' + item.thana.name + ') </option>';
                    } else {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' (' + item.thana.name + ') </option>';
                    }
                });
                $('#area_id').html(options);

            });

        })
    </script>
@endsection
