@extends('backEnd.layouts.master')
@section('pay_roll', 'active menu-open')
@section('salarysheet_manage', 'active')
@section('title', 'Manage Salarysheet')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="manage-button">
                    <div class="body-title">
                        <h5>@lang('common.salarysheet') @lang('common.manage')</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <form method="GET" action="">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
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
                                                        {{-- <option value="{{ $value->title }}" @if (old('year', $year ?? '') == $value->title) selected @endif>
                                                            {{ $value->title }}</option> --}}
                                                        <option value="{{ $value->title }}"
                                                            @if (Request::get('year')) {{ $_GET['year'] == $value->title ? 'selected' : '' }} @endif>
                                                            {{ $value->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('year'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('year') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 col-sm-6">
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
                                                        {{-- <option value="{{ $value->title }}" @if (old('month', $month ?? '') == $value->title) selected @endif>
                                                            {{ $value->title }}</option> --}}
                                                        <option value="{{ $value->title }}"
                                                            @if (Request::get('month')) {{ $_GET['month'] == $value->title ? 'selected' : '' }} @endif>
                                                            {{ $value->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('month'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('month') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label><br>
                                                <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="teble-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.status')</th>
                                                <th>@lang('common.year')</th>
                                                <th>@lang('common.month')</th>
                                                <th>@lang('common.created_date')</th>
                                                <th>@lang('common.pay_date')</th>
                                                <th>@lang('common.payment_method')</th>
                                                <th class="pl-4">@lang('common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach($customers as $customer)
                                            <tr>
                                                <td class="pl-4">
                                                    <a class="pr-2" href="{{ route('superadmin.getCustomer', $customer->id) }}"><i class="fa fa-edit text-primary"></i></a>
                                                    <a class="pr-2" href="{{ route('superadmin.detailsCustomer', $customer->id) }}"><i class="fa fa-desktop text-primary"></i></a>
                                                    @if ($customer->customer_type == 'Corporate')
                                                    <a class="pr-2" href="{{ route('superadmin.add_or_edit_corporate_customer_product', $customer->id) }}"> <i class="fab fa-product-hunt"></i> </a>
                                                    @endif
                                                </td>
                                                <td>{{ $customer->status==1?'Active':'Inactive' }}</td>
                                                <td>{{ $customer->id }}</td>
                                                <td>{{ $customer->firstName }}</td>
                                                <td>{{ $customer->phoneNumber }}</td>
                                                <td>{{ $customer->emailAddress }}</td>
                                                <td>{{ $customer->register_by }}</td>
                                                <td>
                                                    <img style="width: 60px;height:40px;border:1px dotted black" src="{{ asset($customer->logo) }}" alt="">
                                                </td>
                                                
                                            </tr>

                                            @endforeach --}}

                                            @foreach ($salaries as $salary)
                                                <tr>
                                                    <td> {{ ($salary->status) == 1 ? 'Paid' : 'Pending'  }} </td>
                                                    <td> {{ $salary->year ?? '' }} </td>
                                                    <td> {{ $salary->month ?? '' }} </td>
                                                    <td> {{ date('d-m-Y', strtotime($salary->created_at)) }} </td>
                                                    <td> 
                                                        @if ($salary->pay_date != NULL)
                                                            {{ date('d-M-Y', strtotime($salary->pay_date)) }}
                                                        @endif
                                                    </td>
                                                    <td> {{ $salary->payment_via ?? '' }} </td>
                                                    <td>
                                                        @if ($salary->status == 0)
                                                            <a type="button" class="btn btn-primary btn-sm text-white paid_by_invoice" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $salary->invoice_no }}">
                                                                Paid 
                                                            </a>
                                                        @endif
                                                        <a href="{{ URL('superadmin/salarysheet/view/'. $salary->invoice_no) }}" class="btn btn-info btn-sm"> View </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        {{ $salaries->appends($_GET)->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal for paid salary --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Pay Salary </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ URL('superadmin/salarysheet/salary-paid') }}" method="post" id="pay-form">
            @csrf
            <div class="form-group col-md-8">
                <label for="head_name"> @lang('common.date') </label>
                <input type="hidden" name="invoice_no" id="invoice_no">
                <input type="date" name="pay_date" value="{{ old('pay_date') }}"
                    class="flatDate form-control flatpickr-input">
            </div>
            <div class="form-group col-md-8">
                <label for="payment_method">@lang('common.payment_method')</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="">@lang('common.choose')</option>
                    <option value="Cash" @if (old('payment_method') == 'Cash') selected @endif>
                        @lang('common.cash')</option>
                    <option value="Bank" @if (old('payment_method') == 'Bank') selected @endif>
                        @lang('common.bank')</option>
                    <option value="Mobile Banking" @if (old('payment_method') == 'Mobile Banking') selected @endif>
                        @lang('common.mobile_banking')</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"> Submit </button>
        </div>
    </form>
      </div>
    </div>
  </div>
    {{-- modal for paid salary --}}

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.paid_by_invoice').on('click', function() {
                var invoice_no = $(this).data('id');
                $('#invoice_no').val(invoice_no);
                //console.log(invoice_no);
            });
            $('.close').on('click', function() {
                $('#pay-form')[0].reset();
            });
        });
    </script>
@endsection
