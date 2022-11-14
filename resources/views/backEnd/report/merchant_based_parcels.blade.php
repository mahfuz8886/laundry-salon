@extends('backEnd.layouts.master')
@section('report', 'active menu-open')
@section('merchant_based_parcels', 'active')
@section('title', 'Merchant Based Parcels')
@section('extracss')
    <style>
        .logo {
            padding: 10px;
            position: absolute;
            top: 5px;
            left: 5px
        }

        .table th {
            vertical-align: middle !important;
            padding: 8px 10px !important;
            /* white-space: nowrap !important;  */
        }

        .table th,
        .table td {
            padding: 5px 6px !important;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="content-fluid">
            <h4> @lang('common.merchant_based_parcel_report') </h4>
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="merchant_id" id="merchant_id" class="form-control select2">
                                        {{-- <option value=""> Select Merchant </option> --}}
                                        @foreach ($merchants as $merchant)
                                            <option value="{{ $merchant->id }}"
                                                @if (old('merchant_id', $merchant_info->id ?? '') == $merchant->id) selected @endif>
                                                {{ $merchant->companyName }} ({{ $merchant->firstName }} -
                                                {{ $merchant->phoneNumber }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" name="start_date"
                                        value="{{ request()->get('start_date') ? date('Y-m-d', strtotime(request()->get('start_date'))) : '' }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" name="end_date"
                                        value="{{ request()->get('end_date') ? date('Y-m-d', strtotime(request()->get('end_date'))) : '' }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="trackingCode"
                                        value="{{ old('trackingCode', request()->get('trackingCode')) }}"
                                        class="form-control" placeholder="Enter tracking no.">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control select2">
                                        <option value=""> @lang('common.all_parcel_type') </option>
                                        @foreach ($parcel_types as $parcel_type)
                                            <option value="{{ $parcel_type->id }}"
                                                @if (old('status', request()->get('status')) == $parcel_type->id) selected @endif>
                                                {{ $parcel_type->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="pay_status" id="pay_status" class="form-control select2">
                                        <option value=""> @lang('common.select_pay_status') </option>
                                        <option value="1" @if (request()->get('pay_status') == 1) selected @endif> Payable
                                        </option>
                                        <option value="2" @if (request()->get('pay_status') == 2) selected @endif> Paid
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md btn-info"> @lang('common.search') </button>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-primary text-right" onclick="startPrint()">
                                    @lang('common.print') </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (count($parcels) > 0)
            <div class="content-fluid">
                <div class="print_area">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="text-center"> @lang('common.merchant_based_parcel_report') </h3>
                                    @if (request()->get('start_date') && request()->get('end_date'))
                                        <h6 class="text-center">
                                        @lang('common.date') : {{ date('d M Y', strtotime(request()->get('start_date'))) }} to
                                            {{ date('d M Y', strtotime(request()->get('end_date'))) }}
                                        </h6>
                                    @else
                                        <h6 class="text-center">
                                        @lang('common.date') : Full time
                                        </h6>
                                    @endif
                                    <br>
                                    <img class="logo" src="{{ url($setting->logo) }}" alt="Logo" width="100"
                                        height="100">
                                </div>
                                <div class="col-sm-12">
                                    <span class="merchant_info pull-left">
                                        <b> @lang('common.merchant_name') : </b> {{ $merchant_info->companyName ?? '' }}
                                        ({{ $merchant_info->firstName ?? '' }} -
                                        {{ $merchant_info->phoneNumber ?? '' }})
                                    </span>
                                    <span class="total_info pull-right">
                                    @lang('common.total_parcel') : {{ count($parcels) }}
                                    </span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" style="margin-top: 15px">
                                        <thead>
                                            <tr>
                                                <th width="15"> @lang('common.sl') </th>
                                                <th width="90"> @lang('common.track_id') </th>
                                                <th> @lang('common.customer_name') @lang('common.&') @lang('common.mobile_no'). </th>
                                                <th> @lang('common.pickup_date') </th>
                                                <th> @lang('common.delivery_date') </th>
                                                <th> @lang('common.delivery_address') </th>
                                                <th> @lang('common.status') </th>
                                                <th class="text-right"> @lang('common.collect_amount') </th>
                                                <th class="text-right"> @lang('common.delivery_charge') </th>
                                                <th class="text-right"> @lang('common.cod_charge') </th>
                                                <th class="text-right"> @lang('common.payable_amount')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parcels as $key => $parcel)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $parcel->trackingCode }}</td>
                                                    <td>
                                                        {{ $parcel->recipientName }} <br>
                                                        {{ $parcel->recipientPhone }}
                                                    </td>
                                                    <td>
                                                        @if ($parcel->pickup_date)
                                                            {{ date('d M Y', strtotime($parcel->pickup_date)) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($parcel->delivery_date)
                                                            {{ date('d M Y', strtotime($parcel->delivery_date)) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($parcel->delivery_address)
                                                            {{ $parcel->delivery_address }},
                                                        @endif
                                                        {{-- @if ($parcel->area)
                                                            {{ $parcel->area->name }},
                                                        @endif
                                                        @if ($parcel->thana)
                                                            {{ $parcel->thana->name }},
                                                        @endif
                                                        @if ($parcel->district)
                                                            {{ $parcel->district->name }},
                                                        @endif
                                                        @if ($parcel->division)
                                                            {{ $parcel->division->name }},
                                                        @endif --}}
                                                    </td>
                                                    <td>{{ $parcel->parcelStatus->title ?? '' }}</td>
                                                    <td class="text-right">
                                                        {{ number_format($parcel->cod, 2) }}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ number_format($parcel->deliveryCharge, 2) }}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ number_format($parcel->codCharge, 2) }}
                                                    </td>
                                                    <td class="text-right">
                                                        @if (in_array($parcel->status, [4, 6, 7, 8]))
                                                            {{ number_format($parcel->merchantDue, 2) }}
                                                        @else
                                                            0.00
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="10"> @lang('common.total_parcel') </th>
                                                <th class="text-right">{{ number_format($total['parcel'], 2) }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10"> @lang('common.total_collection') </th>
                                                <th class="text-right">{{ number_format($total['cod'], 2) }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="10"> @lang('common.total_delivery_charge') </th>
                                                <th class="text-right">
                                                    {{ number_format($total['delivery_charge'], 2) }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10"> @lang('common.total_cod_charge') </th>
                                                <th class="text-right">
                                                    {{ number_format($total['cod_charge'], 2) }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10"> @lang('common.total_payable') </th>
                                                <th class="text-right">
                                                    {{ number_format($total['merchant_payable'], 2) }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="10"> @lang('common.total_paid') </th>
                                                <th class="text-right">
                                                    {{ number_format($total['merchant_paid'], 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    @lang('common.print_time'): {{ date('d M Y H:i a') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @elseif($parcels)
            <div class="card">
                <div class="card-body">
                @lang('common.no_record_found') !
                </div>
            </div>
        @endif


    </section>
@endsection

@section('script')
    <script>
        var APP_URL = '{!! url()->full() !!}';

        function startPrint() {
            $('.dt-buttons').hide();
            $('.dataTables_paginate').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }

        $('.dataTable').DataTable({
            "paging": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            "searching": false,
            "ordering": false,
            search: {
                regex: false,
                smart: false
            },
            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                'colvis',
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
        });
    </script>
@endsection
