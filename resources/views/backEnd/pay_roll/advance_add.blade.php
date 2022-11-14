@extends('backEnd.layouts.master')
@section('pay_roll', 'active menu-open')
@section('advance_add', 'active')
@section('title', 'Advance Create')
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
                    <h3 class="card-title"> @lang('common.advance') </h3>
                </div>
                <form action="{{ URL('superadmin/advance/add') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="year"> Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="pay_date" value="{{ old('pay_date', $advance_det[0]['date'] ?? '') }}"
                                        class="flatDate form-control" required>
                                    @if ($errors->has('pay_date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pay_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="username"> Employee <span class="text-danger">*</span>
                                    </label>
                                    <select data-choices name="employee_id[]" id="employee_id" class="form-control select2"
                                        data-type="select-multiple" data-choices-removeItem multiple>
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
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="year"> Employee Name
                                </label>

                                <input type="text" name="employee_id[]" value="">
                                <input type="text" name="account_head_id[]" value="">
                                <input readonly type="text" name="name[]" id="name"
                                    class="form-control name {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    value="{{ old('name') }}">
                                    <p class="text-danger warning" id="warning">
                                    </p>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="username"> This Month Advance Amount
                                </label>
                                <input readonly type="text" name="advance_amount[]" id="advance_amount"
                                    class="form-control advance_amount {{ $errors->has('advance_amount') ? ' is-invalid' : '' }}"
                                    value="{{ old('advance_amount') }}">
                                    <p class="text-danger warning" id="warning">
                                    </p>
                                @if ($errors->has('advance_amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('advance_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="username"> Amount
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
            </div> --}}

            {{-- advance details --}}


            @if ($advance_det != null)
                <form action="{{ url('superadmin/advance/store') }}" method="post">
                    @csrf
                    @foreach ($advance_det as $item)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="year"> Employee Name
                                            </label>

                                            <input type="hidden" name="date" value="{{ $item['date'] }}">
                                            <input type="hidden" name="account_head_id[]" value="{{ $item['account_head_id'] }}">
                                            <input readonly type="text" name="name[]" id="name"
                                                class="form-control name {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                value="{{ old('name', $item['name']) }}">
                                            <p class="text-danger warning" id="warning">
                                            </p>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="username"> This Month Advance Amount
                                            </label>
                                            <input readonly type="text" name="advance_amount[]" id="advance_amount"
                                                class="form-control advance_amount {{ $errors->has('advance_amount') ? ' is-invalid' : '' }}"
                                                value="{{ old('advance_amount', $item['advance_amount']) }}">
                                            <p class="text-danger warning" id="warning">
                                            </p>
                                            @if ($errors->has('advance_amount'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('advance_amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="username"> Amount
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            @endif

            {{-- advance details --}}

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
