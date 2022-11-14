@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('all_order', 'active')
@section('title', 'Parcel Invoice')
@section('style')
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
            padding: 5px 10px !important;
            border: 1px solid #010101;
        }

        h6 {
            font-weight: bold;
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
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="50%">
                                            <div>
                                                <img src="{{ url($merchant->logo ?? $setting->logo) }}" alt="Logo"
                                                    width="50" height="50">
                                            </div>
                                            <div class="company_info">
                                                <b>@lang('common.company_name') :</b> {{ $merchant->companyName }} <br>
                                                <b>@lang('common.name') :</b> {{ $merchant->firstName }} <br>
                                                <b>@lang('common.mobile_no') :</b> {{ $merchant->otherphoneNumber }} <br>
                                                <b>@lang('common.address') :</b> {{ $merchant->present_address }} <br>
                                            </div>
                                        </td>
                                        <td>
                                            <h4> @lang('common.invoice') </h4>
                                            <div>
                                                <b>@lang('common.invoiceNo') : </b> {{ $show_data->invoiceNo }} <br>
                                                <b>@lang('common.track_id') : </b> {{ $show_data->trackingCode }} <br>
                                                <b>@lang('common.invoice_date'): </b>
                                                {{ date('d M Y', strtotime($show_data->created_at)) }}
                                                <br>
                                            </div>
                                            <div class="supplier_info">
                                                <b>@lang('common.name') :</b> {{ $show_data->recipientName }} <br>
                                                <b>@lang('common.mobile_no') :</b> {{ $show_data->recipientPhone }} <br>
                                                <b>@lang('common.address') :</b>
                                                {{ $show_data->delivery_address }},
                                                @if ($show_data->area)
                                                    {{ $show_data->area }},
                                                @endif
                                                @if ($show_data->thana)
                                                    {{ $show_data->thana }},
                                                @endif
                                                @if ($show_data->district)
                                                    {{ $show_data->district }},
                                                @endif
                                                @if ($show_data->division)
                                                    {{ $show_data->division }},
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <h6> @lang('common.total_amount') : {{ $show_data->cod }}</h6>
                                        </td>
                                        <td>
                                            <img class="company_image" src="{{ url($setting->logo) }}" alt="Logo"
                                                width="50" height="50">
                                            <h3>{{ $setting->name }}</h3>

                                            <p>
                                                {{ $setting->address }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
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
