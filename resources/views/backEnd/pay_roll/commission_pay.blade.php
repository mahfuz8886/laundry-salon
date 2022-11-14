@extends('backEnd.layouts.master')
@section('pay_roll', 'active menu-open')
@section('commission_pay', 'active')
@section('title', 'Commission Create')
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
        .name {
            background-color: #007BFF;
            border: none;
            color: white;
            text-transform: capitalize;
        }
        .name:focus {
            border: none;
        }
    </style>
@endsection
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

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> @lang('common.commission_pay') </h3>
                </div>
                <form action="{{ URL('superadmin/commission/pay') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="username"> Employee <span class="text-danger">*</span>
                                    </label>
                                    <select data-choices name="employee_id[]" id="employee_id" class="form-control select2"
                                        data-type="select-multiple" data-choices-removeItem multiple required>
                                        <option value=""> Select Employee </option>
                                    </select>
                                    @if ($errors->has('employee_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('employee_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
                </form>
            </div>

            {{-- commission details --}}

            {{-- <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"> Employee Name </h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="year"> Today Commission <span class="text-danger">*</span>
                                </label>
                                <input readonly type="text" name="tody_commission[]" id="tody_commission"
                                    class="form-control {{ $errors->has('tody_commission') ? ' is-invalid' : '' }}"
                                    value="{{ old('tody_commission') }}" required>
                                @if ($errors->has('tody_commission'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tody_commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="username"> Due Commission <span class="text-danger">*</span>
                                </label>
                                <input readonly type="text" name="due_commission[]" id="due_commission"
                                    class="form-control {{ $errors->has('due_commission') ? ' is-invalid' : '' }}"
                                    value="{{ old('due_commission') }}">
                                @if ($errors->has('due_commission'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due_commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="username"> Pay Commission
                                </label>
                                <input type="number" name="amount[]" id="amount"
                                    class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                    value="{{ old('amount') }}">
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

            @if ($employee_det != null || old('employee_id') != null)
                <form action="{{ url('superadmin/commission/store') }}" method="post">
                    @csrf
                    @foreach ($employee_det as $item)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <input disabled class="name" name="name[]" type="text" value="{{ $item['name'] }}">
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="year"> Today Commission <span class="text-danger">*</span>
                                            </label>

                                            <input type="hidden" name="employee_id[]" value="{{ $item['employee_id'] }}">
                                            <input type="hidden" name="account_head_id[]"
                                                value="{{ $item['account_head_id'] }}">

                                            <input readonly type="text" name="tody_commission[]" id="tody_commission"
                                                class="form-control {{ $errors->has('tody_commission') ? ' is-invalid' : '' }}"
                                                value="{{ old('tody_commission', $item['today_commission']) }}" required>
                                            @if ($errors->has('tody_commission'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('tody_commission') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="username"> Due Commission <span class="text-danger">*</span>
                                            </label>
                                            <input readonly type="text" name="due_commission[]" id="due_commission"
                                                class="form-control due_commission {{ $errors->has('due_commission') ? ' is-invalid' : '' }}"
                                                value="{{ old('due_commission', $item['due_commission']) }}">
                                            @if ($errors->has('due_commission'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('due_commission') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="username"> Pay Commission
                                            </label>
                                            <input type="number" name="amount[]" id="amount"
                                                class="form-control amount {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                value="{{ old('amount') }}">
                                            <p class="text-danger warning" id="warning">
                                            </p>
                                            @if ($errors->has('amount'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if (old('employee_id') != null && sizeof(old('employee_id')) > 0)
                        @foreach (old('employee_id') as $item)
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"> 
                                        <input disabled class="name" name="name[]" type="text" value="{{ old('name.' . $loop->index) }}">
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="year"> Today Commission <span class="text-danger">*</span>
                                                </label>

                                                <input type="hidden" name="employee_id[]"
                                                    value="{{ old('employee_id.' . $loop->index) }}">
                                                <input type="hidden" name="account_head_id[]"
                                                    value="{{ old('account_head_id.' . $loop->index) }}">

                                                <input readonly type="text" name="tody_commission[]" id="tody_commission"
                                                    class="form-control {{ $errors->has('tody_commission') ? ' is-invalid' : '' }}"
                                                    value="{{ old('tody_commission.' . $loop->index) }}" required>
                                                @if ($errors->has('tody_commission'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('tody_commission.' . $loop->index) }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="username"> Due Commission <span class="text-danger">*</span>
                                                </label>
                                                <input readonly type="text" name="due_commission[]" id="due_commission"
                                                    class="form-control due_commission {{ $errors->has('due_commission') ? ' is-invalid' : '' }}"
                                                    value="{{ old('due_commission.' . $loop->index) }}">
                                                @if ($errors->has('due_commission'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('due_commission.' . $loop->index) }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group {{ $errors->has('amount.' . $loop->index) ? 'has-error' : '' }}">
                                                <label for="username"> Pay Commission
                                                </label>
                                                <input type="number" name="amount[]" id="amount"
                                                    class="form-control amount {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                                    value="{{ old('amount.' . $loop->index) }}">
                                                <p class="text-danger warning" id="warning">
                                                </p>
                                                @if ($errors->has('amount.' . $loop->index))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('amount.' . $loop->index) }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            @endif

            {{-- commission details --}}

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

            $(document).on('change keyup', '.amount', function() {
                //console.log('clickeddddd');
                var amount = $(this).val();
                //var remaining_commission = $(this).closest('.amount').find('.due_commission');
                var remaining_commission = $(this).closest('.due_commission');
                var item = $(this);
                //var remaining_commission = item.closest('div');

                console.log(amount);
                console.log(remaining_commission);

                if (Number(amount) > Number(remaining_commission)) {
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
