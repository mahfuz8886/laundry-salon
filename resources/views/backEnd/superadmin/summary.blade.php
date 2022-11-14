@extends('backEnd.layouts.master')
@section('report', 'active menu-open')
@section('summary_report', 'active')
@section('title', 'Summary Report')
@section('content')
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible !important;
            }

            #printSection {
                position: absolute !important;
                left: 0;
                top: 0;
            }
        }
    </style>

    {{-- <section>
        <form action="{{ url('superadmin/summary') }}" method="get">@csrf
            <div class="container">
                <div class="card m-2 mt-5">
                    <div class="row m-3 ">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <input type="text" placeholder="start date"
                                    value="@isset($_GET['start_date']) {{ $_GET['start_date'] }} @endisset"
                                    name="start_date" class="mydatesNew form-control  flatpickr-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" placeholder="end date"
                                    value="@isset($_GET['end_date']) {{ $_GET['end_date'] }} @endisset"
                                    name="end_date" class="mydatesNew form-control  flatpickr-input">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" class="btn rounded-lg shadow px-4 btn-success border-0"
                                    value="show">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section> --}}

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date"> Start Date </label>
                                    <input type="date" name="start_date" value="{{ $start_date }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date"> End Date </label>
                                    <input type="date" name="end_date" value="{{ $end_date }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for=""> <br> </label>
                                    <input type="submit" value="@lang('common.search')" class="btn btn-success form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <div class="form-group">
                    <button type="button" class="btn btn-sm btn-primary text-right" onclick="startPrint()">
                        @lang('common.print') </button>
                </div>
            </div>
            <div class="print_area">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10 mx-auto">
                            <div class="card   custom-card">
                                <div class="col-sm-12">
                                    <h3 class="text-center">
                                        <b> @lang('common.summary_report') </b>
                                    </h3>
                                    <p class="text-center">
                                        <b>{{ date('d F-Y', strtotime($start_date)) }} To
                                            {{ date('d F-Y', strtotime($end_date)) }}</b>
                                    </p>
                                </div>
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-sm custom-table ">
                                        <thead>
                                            @php
                                                $totalOrder = 0;
                                                $toady_quantity = 0;
                                                $toady_collection = 0;
                                                $toady_delivery_charge = 0;
                                                $toady_codCharge = 0;
                                                $toady_merchant_payable = 0;
                                            @endphp
                                            <tr>
                                                <th class="text-center"> @lang('common.sl') </th>
                                                <th> @lang('common.all_parcel_type') </th>
                                                <th class="text-right"> @lang('common.quantity') </th>
                                                <th class="text-right"> @lang('common.total_collection') </th>
                                                <th class="text-right"> @lang('common.delivery_charge') </th>
                                                <th class="text-right"> @lang('common.cod_charge') </th>
                                                <th class="text-right"> @lang('common.merchant_payable') </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parcel_types as $parcel_type)
                                                <tr>
                                                    <th class="text-center">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <th width="15%">
                                                        {{ $parcel_type->title }}
                                                    </th>
                                                    <td class="text-right">
                                                        {{ $parcel['today_' . $parcel_type->slug . '_quantity'] }}
                                                        @php
                                                            $totalOrder += $parcel['today_' . $parcel_type->slug . '_quantity'];
                                                            $toady_quantity += $parcel['today_' . $parcel_type->slug . '_quantity'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['today_' . $parcel_type->slug . '_collection'] }}
                                                        @php
                                                            $toady_collection += $parcel['today_' . $parcel_type->slug . '_collection'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['today_' . $parcel_type->slug . '_delivery_charge'] }}
                                                        @php
                                                            $toady_delivery_charge += $parcel['today_' . $parcel_type->slug . '_delivery_charge'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['today_' . $parcel_type->slug . '_codCharge'] }}
                                                        @php
                                                            $toady_codCharge += $parcel['today_' . $parcel_type->slug . '_codCharge'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['today_' . $parcel_type->slug . '_merchant_payable'] }}
                                                        @php
                                                            $toady_merchant_payable += $parcel['today_' . $parcel_type->slug . '_merchant_payable'];
                                                        @endphp
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th class="text-right" colspan="2">
                                                    @lang('common.total')
                                                </th>
                                                <th class="text-right">
                                                    {{ $toady_quantity }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $toady_collection }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $toady_delivery_charge }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $toady_codCharge }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $toady_merchant_payable }}
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10 mx-auto">
                            <div class="card   custom-card">
                                <div class="col-sm-12">
                                    <h3 class="text-center">
                                        <b> @lang('common.total_summary')</b>
                                    </h3>
                                </div>
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-sm custom-table ">
                                        <thead>
                                            @php
                                                $totalOrder = 0;
                                                $total_quantity = 0;
                                                $total_collection = 0;
                                                $total_delivery_charge = 0;
                                                $total_codCharge = 0;
                                                $total_merchant_payable = 0;
                                            @endphp
                                            <tr>
                                                <th class="text-center"> @lang('common.sl') </th>
                                                <th> @lang('common.all_parcel_type') </th>
                                                <th class="text-right"> @lang('common.quantity') </th>
                                                <th class="text-right"> @lang('common.total_collection') </th>
                                                <th class="text-right"> @lang('common.delivery_charge') </th>
                                                <th class="text-right"> @lang('common.cod_charge') </th>
                                                <th class="text-right"> @lang('common.merchant_payable') </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parcel_types as $parcel_type)
                                                <tr>
                                                    <th class="text-center">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <th width="15%">
                                                        {{ $parcel_type->title }}
                                                    </th>
                                                    <td class="text-right">
                                                        {{ $parcel['total_' . $parcel_type->slug . '_quantity'] }}
                                                        @php
                                                            $totalOrder += $parcel['total_' . $parcel_type->slug . '_quantity'];
                                                            $total_quantity += $parcel['total_' . $parcel_type->slug . '_quantity'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['total_' . $parcel_type->slug . '_collection'] }}
                                                        @php
                                                            $total_collection += $parcel['total_' . $parcel_type->slug . '_collection'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['total_' . $parcel_type->slug . '_delivery_charge'] }}
                                                        @php
                                                            $total_delivery_charge += $parcel['total_' . $parcel_type->slug . '_delivery_charge'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['total_' . $parcel_type->slug . '_codCharge'] }}
                                                        @php
                                                            $total_codCharge += $parcel['total_' . $parcel_type->slug . '_codCharge'];
                                                        @endphp
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $parcel['total_' . $parcel_type->slug . '_merchant_payable'] }}
                                                        @php
                                                            $total_merchant_payable += $parcel['total_' . $parcel_type->slug . '_merchant_payable'];
                                                        @endphp
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th class="text-right" colspan="2">
                                                    @lang('common.total')
                                                </th>
                                                <th class="text-right">
                                                    {{ $total_quantity }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $total_collection }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $total_delivery_charge }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $total_codCharge }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $total_merchant_payable }}
                                                </th>
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
    </section>

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






<!-- Modal -->
<div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content "
            style="background: -webkit-linear-gradient(#d9ebeb,#d9ebeb);  
      background: -moz-linear-gradient(#d9ebeb,#d9ebeb);  
      background: -o-linear-gradient(#d9ebeb,#d9ebeb);  
       background: linear-gradient(#d9ebeb,#d9ebeb);
       background-repeat:no-repeat;">
            <div class="modal-header">
                <h5 class="modal-title modal_title_parcel"> </h5>
                <button type="button" class="  btn-outline-danger btn-sm rounded-lg" style="outline:none"
                    data-dismiss="modal"><i class="far fa-window-close"></i></button>

                <!-- <button type="button" class="close" data-dismiss="modal" style="outline:none" aria-label="Close">
                                                                                                                  <span aria-hidden="true">&times;</span>
                                                                                                                </button>-->
            </div>
            <div class="modal-body priceModal_Body table-responsive">
            </div>
            <div class="text-right m-1">
                <button type="button" class="  btn-outline-danger btn-sm rounded-lg" style="outline:none"
                    data-dismiss="modal">close</button>

            </div>
        </div>
    </div>
</div>



@endsection
