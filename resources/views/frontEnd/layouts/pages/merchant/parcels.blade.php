@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('all_order', 'active')
@section('title', 'Parcel')
@section('style')
    <style>
        .table th,
        .table td {
            white-space: nowrap !important;
        }

        .table td {
            padding: 2px 10px !important;
            margin: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class="profile-edit mrt-30">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="" class="filte-form">
                    @csrf
                    <div class="row">
                        <input type="hidden" value="1" name="filter_id">
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="@lang('common.invoiceNo')" name="invoiceNo"
                                value="{{ request()->get('invoiceNo') }}">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="@lang('common.track_id')" name="trackId"
                                value="{{ request()->get('trackId') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="@lang('common.mobile_no')" name="phoneNumber"
                                value="{{ request()->get('phoneNumber') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="@lang('common.date_from')"
                                name="startDate" value="{{ request()->get('startDate') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="@lang('common.date_to')"
                                name="endDate" value="{{ request()->get('endDate') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success">@lang('common.submit') </button>
                        </div>
                        <!-- col end -->
                    </div>
                </form>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="tab-inner table-responsive">
                    <table id="example" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>@lang('common.id')</th>
                                <th>@lang('common.invoiceNo')</th>
                                <th>@lang('common.track_id')</th>
                                <th>@lang('common.date')</th>
                                <th>@lang('common.customer')</th>
                                <th>@lang('common.mobile_no')</th>
                                <th>@lang('common.address')</th>
                                <th width="100px">@lang('common.status')</th>
                                <th>@lang('common.rider')</th>
                                <th>@lang('common.total')</th>
                                <th>@lang('common.charge')</th>
                                <th>@lang('common.sub_total')</th>
                                <th>@lang('common.last_update')</th>
                                <th>@lang('common.payment_status')</th>
                                <th>@lang('common.note')</th>
                                <th>@lang('common.more')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allparcel as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->invoiceNo }}</td>
                                    <td>{{ $value->trackingCode }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->recipientName }}</td>
                                    <td>{{ $value->recipientPhone }}</td>
                                    <td>
                                        @if ($value->delivery_address)
                                            {{ $value->delivery_address }},
                                        @endif
                                        @if ($value->area_id)
                                            {{ $value->area }},
                                        @endif
                                        @if ($value->thana_id)
                                            {{ $value->thana }},
                                        @endif
                                        @if ($value->district_id)
                                            {{ $value->district }},
                                        @endif
                                        @if ($value->division_id)
                                            {{ $value->division }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $parcelstatus = App\Parceltype::find($value->status);
                                        @endphp
                                        {{ $parcelstatus->title }}
                                        @if ($value->status_description)
                                            <p class="desc text-start text-primary">[ {{ $value->status_description }} ]
                                            </p>
                                        @endif

                                    </td>
                                    <td>
                                        @php
                                            $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                                        @endphp
                                        @if ($value->deliverymanId)
                                            {{ $deliverymanInfo->name ?? '' }}
                                        @else
                                            Not Asign
                                        @endif
                                    </td>
                                    <td> {{ $value->cod }}</td>
                                    <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                    <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}</td>
                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                                    <td>
                                        @if ($value->merchantpayStatus == 1 && ($value->percelType == 2 && $value->status == 4))
                                            Paid
                                        @elseif($value->merchantpayStatus == 1 && (($value->status > 5 && $value->status < 9) || $value->percelType == 1))
                                            Service charge adjustment
                                        @else
                                            Unknown process
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $parcelnote = App\Parcelnote::where('parcelId', $value->id)
                                                ->orderBy('id', 'DESC')
                                                ->first();
                                        @endphp
                                        @if (!empty($parcelnote))
                                            {{ $parcelnote->note }}
                                        @endif
                                    </td>
                                    <td>
                                        <li>
                                            <a href="{{ url('merchant/parcel/in-details/' . $value->id) }}"
                                                class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                            @if ($value->status == 1)
                                                <a href="{{ url('merchant/parcel/edit/' . $value->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @endif
                                        </li>
                                        @if ($value->status >= 2)
                                            <li>
                                                <a class="btn btn-sm btn-success" a
                                                    href="{{ url('merchant/parcel/invoice/' . $value->id) }}"
                                                    title="Invoice"><i class="fas fa-list"></i></a>
                                            </li>
                                        @endif
                                        @if ($value->status < 2)
                                            <li>
                                                <a class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Do you want to Cancel ?')"
                                                    href="{{ url('merchant/parcel-cancel/' . $value->id) }}"
                                                    title="Invoice"> @lang('common.cancel') </a>
                                            </li>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
@endsection
