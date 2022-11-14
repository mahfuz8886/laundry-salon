@extends('backEnd.layouts.master')
@section('pay_roll', 'active menu-open')
@section('advance_manage', 'active')
@section('title', 'Manage Salarysheet')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="manage-button">
                    <div class="body-title">
                        <h5>@lang('common.advance') @lang('common.manage')</h5>
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
                                                <label for="year"> Date From <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                                @if ($errors->has('date_from'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('date_from') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="year"> Date To <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" name="date_to" value="{{ $_GET['date_to']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                                @if ($errors->has('date_to'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('date_to') }}</strong>
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
                                                <th>@lang('common.sl.')</th>
                                                <th>@lang('common.name')</th>
                                                <th>@lang('common.this_month_advance_amount')</th>
                                                {{-- <th>@lang('common.month')</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($employees_datas as $data)
                                                <tr>
                                                    <td> {{ ++$loop->index  }} </td>
                                                    <td> {{ $data['name'] ?? '' }} </td>
                                                    <td> {{ $data['amount'] ?? '' }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        {{-- {{ $salaries->appends($_GET)->links() }} --}}
                                    </div>
                                </div>

                            </div>
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
