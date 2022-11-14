@extends('backEnd.layouts.master')
@section('pay_roll', 'active menu-open')
@section('salarysheet_manage', 'active')
@section('title', 'View Salarysheet')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="manage-button">
                    <div class="body-title">
                        <h5>@lang('common.salarysheet') @lang('common.view')</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Year:&nbsp; <b> {{ $salary_det[0]['year'] }} </b>,&nbsp;
                                Month:&nbsp; <b> {{ $salary_det[0]['month'] }} </b>
                            </div>
                            <div class="card-body">
                                <div class="teble-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.name')</th>
                                                <th>@lang('common.gross_salary')</th>
                                                <th>@lang('common.commission')</th>
                                                <th>@lang('common.commission_withdraw')</th>
                                                <th>@lang('common.advance')</th>
                                                <th>@lang('common.payable_amount')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salary_det as $item)
                                                <tr>
                                                    <td> {{ $item['name'] }} </td>
                                                    <td> {{ $item['gross_salary'] }} </td>
                                                    <td> {{ $item['month_commission'] }} </td>
                                                    <td> {{ $item['month_withdraw_commission'] }} </td>
                                                    <td> {{ $item['advance'] }} </td>
                                                    <td> {{ $item['payable_amount'] }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        {{-- {{ $salary_det->appends($_GET)->links() }} --}}
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
