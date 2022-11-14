@extends('backEnd.layouts.master')
@section('payment', 'active menu-open')
@section('pickupman_payment_summary', 'active')
@section('title', 'pickupman payment summary')
@section('extracss')
    <style>
        .table th, .table td {
            white-space: nowrap !important; 
        }
    </style>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card custom-card">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.payment_summery') @lang('common.pickupman')</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> @lang('common.sl')</th>
                                            <th> @lang('common.name') </th>
                                            <th> @lang('common.mobile_no') </th>
                                            <th class="text-right"> @lang('common.total_parcel') </th>
                                            <th class="text-right"> @lang('common.total_amount') </th>
                                            <th class="text-right"> @lang('common.total') @lang('common.paid') </th>
                                            <th class="text-right"> @lang('common.total') @lang('common.due') </th>
                                            <th> @lang('common.action') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pickupmen as $key => $pickupman)
                                            @php
                                                $paymentSummary = $pickupman->paymentSummary();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pickupman->name }}</td>
                                                <td>{{ $pickupman->phone }}</td>
                                                <td class="text-right">{{ $paymentSummary['total_parcel'] }}</td>
                                                <td class="text-right">{{ $paymentSummary['total_amount'] }}</td>
                                                <td class="text-right">{{ $paymentSummary['total_paid'] }}</td>
                                                <td class="text-right">{{ $paymentSummary['total_due'] }}</td>
                                                <td>
                                                    <a href="{{ url('superadmin/pickupman-payments/all/'.$pickupman->id) }}" class="btn btn-sm btn-primary">
                                                    @lang('common.all_parcel')
                                                    </a>
                                                    <a href="{{ url('superadmin/pickupman-payments/paid/'.$pickupman->id) }}" class="btn btn-sm btn-success">
                                                    @lang('common.paid_parcel')
                                                    </a>
                                                    <a href="{{ url('superadmin/pickupman-payments/due/'.$pickupman->id) }}" class="btn btn-sm btn-warning">
                                                    @lang('common.due_parcel')
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                {{ $pickupmen->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Section  -->




@endsection
