@extends('frontEnd.layouts.pages.deliveryman.master')
@section('title', 'Dashboard')
@section('my_parcels', 'active')
@section('styles')
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
                            <input type="text" class="form-control" placeholder="@lang('common.track_id')" name="trackId">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="@lang('common.mobile_no')" name="phoneNumber">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="@lang('common.date_from')" name="startDate">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="@lang('common.date_to')" name="endDate">
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
                <div class="">
                    <table id="example" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>@lang('common.sl')</th>
                                <th>@lang('common.track_id')</th>
                                <th>@lang('common.date')</th>
                                <th>@lang('common.company_name')</th>
                                <th>@lang('common.mobile_no') </th>
                                <th width="150">@lang('common.address') </th>
                                <th>@lang('common.status')</th>
                                <th>@lang('common.total')</th>
                                <th>@lang('common.charge')</th>
                                <th>@lang('common.sub_total')</th>
                                <th>@lang('common.last_update')</th>
                                <th>@lang('common.payment_status')</th>
                                <th>@lang('common.assign_type')</th>
                                <th>@lang('common.note')</th>
                                <th>@lang('common.more')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allparcel as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->trackingCode }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->companyName }}</td>
                                    <td>{{ $value->recipientPhone }}</td>
                                    <td>
                                        @if ($value->delivery_address)
                                            {{ $value->delivery_address . ',' }}
                                        @endif
                                        @if ($value->area)
                                            {{ $value->area . ',' }}
                                        @endif
                                        @if ($value->thana)
                                            {{ $value->thana . ',' }}
                                        @endif
                                        @if ($value->district)
                                            {{ $value->district . ',' }}
                                        @endif
                                        @if ($value->division)
                                            {{ $value->division . '.' }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $parcelstatus = App\Parceltype::find($value->status);
                                        @endphp
                                        {{ $parcelstatus->title }}
                                    </td>
                                    <td> {{ $value->cod }}</td>
                                    <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                    <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}</td>
                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                                    <td>
                                        @if ($value->merchantpayStatus == null)
                                            NULL
                                        @elseif($value->merchantpayStatus == 0)
                                            @lang('common.processing')
                                        @else
                                            @lang('common.paid')
                                        @endif
                                    </td>

                                    <td>
                                        @if ($value->pickupmanId && $value->deliverymanId == null)
                                            <p>@lang('common.pickupman_assign')</p>
                                        @elseif($value->deliverymanId && $value->pickupmanId == null)
                                            <p>@lang('common.deliveryman_assign')</p>
                                        @elseif($value->deliverymanId && $value->pickupmanId)
                                            <p>@lang('common.pickupman_assign')</p>
                                            <p>@lang('common.deliveryman_assign')</p>
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
                                        <!--<button class="btn btn-info" href="#"  data-toggle="modal" data-target="#merchantParcel{{ $value->id }}" title="View"><i class="fa fa-eye"></i></button>-->
                                        <div id="merchantParcel{{ $value->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Parcel Details</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>Merchant Name</td>
                                                                <td>{{ $value->firstName }} {{ $value->lastName }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Merchant Phone</td>
                                                                <td>{{ $value->phoneNumber }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Merchant Email</td>
                                                                <td>{{ $value->emailAddress }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Company</td>
                                                                <td>{{ $value->companyName }}</td>
                                                            </tr>
                                                            <td>Recipient Name</td>
                                                            <td>{{ $value->recipientName }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient Address</td>
                                    <td>{{ $value->recipientAddress }}</td>
                                </tr>
                                <tr>
                                    <td>COD</td>
                                    <td>{{ $value->cod }}</td>
                                </tr>
                                <tr>
                                    <td>C. Charge</td>
                                    <td>{{ $value->codCharge }}</td>
                                </tr>
                                <tr>
                                    <td>D. Charge</td>
                                    <td>{{ $value->deliveryCharge }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>{{ $value->merchantAmount }}</td>
                                </tr>
                                <tr>
                                    <td>Paid</td>
                                    <td>{{ $value->merchantPaid }}</td>
                                </tr>
                                <tr>
                                    <td>Due</td>
                                    <td>{{ $value->merchantDue }}</td>
                                </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
    @if (in_array($value->status, [2, 3, 4, 5, 6, 7, 8]) && $value->merchantPaid == 0)
        <button class="btn btn-danger" title="Action" data-toggle="modal" data-target="#sUpdateModal{{ $value->id }}"><i
                class="fa fa-sync-alt"></i></button>
    @endif

    <!-- Modal -->
    <div id="sUpdateModal{{ $value->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('common.parcel_status_update')</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ url('deliveryman/parcel/status-update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                        <input type="hidden" name="customer_phone" value="{{ $value->recipientPhone }}">
                        <div class="form-group">
                            <select name="status" onchange="percelDelivery(this)" class="form-control" id="">
                                @foreach ($parceltypes->whereNotIn('id', [9]) as $key => $ptvalue)
                                    <option value="{{ $ptvalue->id }}"
                                        @if ($value->status == $ptvalue->id) selected="selected" @endif
                                        @if ($value->status > $ptvalue->id && in_array($ptvalue->id, [1, 2, 6, 7, 8])) disabled @endif>{{ $ptvalue->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- form group end -->
                        <div class="form-group mrt-15">
                            <textarea name="note" class="form-control" cols="30" placeholder="@lang('common.note')"></textarea>
                        </div>
                        <!-- form group end -->
                        <div class="form-group">
                            <div id="customerpaid" style="display: none;">
                                <input type="text" class="form-control" value="{{ old('customerpay') }}"
                                    id="customerpay" name="customerpay" placeholder="customer pay" /><br />
                            </div>
                        </div>
                        <!-- form group end -->
                        <div class="form-group">
                            <button class="btn btn-success">@lang('common.update')</button>
                        </div>
                        <!-- form group end -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('common.close')</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <!-- @if ($value->status >= 2)
    -->
    <!--<a class="btn btn-primary" a href="{{ url('deliveryman/parcel/invoice/' . $value->id) }}"  title="Invoice"><i class="fas fa-list"></i></a>-->
    <!--
    @endif-->
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
