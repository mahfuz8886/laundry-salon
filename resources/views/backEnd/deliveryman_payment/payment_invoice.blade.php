@extends('backEnd.layouts.master')
@section('payment', 'active menu-open')
@section('deliveryman_payment_summary', 'active')
@section('title', 'Parcel Details')
@section('extracss')
    <style>
        body {
            background: #ffffff;
        }

        .table th {
            padding: 8px 10px !important;
            white-space: nowrap !important;
        }

        .table th,
        .table td {
            padding: 5px 6px !important;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12  text-left">
                                    <a role="button" class="btn btn-info btn-sm" onclick="getPrint()">@lang('common.print')</a>
                                </div>
                            </div>

                            <hr>
                            <div id="print_area">
                                <div class="row">
                                    <div class="col-sm-8" style="width: 60%; float: left;">
                                        <div>
                                            <img src="{{ url($setting->logo) }}" alt="Logo" height="50">
                                        </div>
                                        <div class="company_info">
                                            {{ $setting->address }} <br>
                                            <b>
                                            @lang('common.merchant_information')
                                            </b> <br>
                                            @lang('common.name') : {{ $parcel->merchant->firstName ?? '' }} <br>
                                            @lang('common.mobile_no') : {{ $parcel->merchant->phoneNumber ?? '' }} <br>
                                            @lang('common.company_name') : {{ $parcel->merchant->companyName ?? '' }} <br>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" style="width: 40%; float: left;">
                                        <h4> @lang('common.invoice') </h4>
                                        <div>
                                            <b>@lang('common.track_id'):</b> SC-54114 <br>
                                            <b>@lang('common.invoice_date'):</b> {{ date('d M Y', strtotime($parcel->created_at)) }}
                                            <br>
                                        </div>
                                        <div class="supplier_info">
                                            <b> @lang('common.deliveryman') @lang('common.information') </b> <br>
                                            @lang('common.name') : {{ $parcel->deliveryman->name ?? '' }} <br>
                                            @lang('common.mobile_no') : {{ $parcel->deliveryman->phone ?? '' }} <br>
                                            @lang('common.address') : {{ $parcel->deliveryman->present_address ?? '' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left"> @lang('common.status') </th>
                                                    <th class="text-left"> @lang('common.amount') </th>
                                                    <th class="text-left"> @lang('common.paid') </th>
                                                    <th class="text-left"> @lang('common.due') </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left"> {{ $parcel->title }} </td>
                                                    <td class="text-left"> {{ $parcel->deliveryman_amount }} </td>
                                                    <td class="text-left"> {{ $parcel->deliveryman_paid }} </td>
                                                    <td class="text-left"> {{ $parcel->deliveryman_due }} </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
        function getPrint() {
            var html = $('body').html($('#print_area').html());
            window.print(html);
            window.location.replace('{!! url()->full() !!}');
        }
    </script>
@endsection
