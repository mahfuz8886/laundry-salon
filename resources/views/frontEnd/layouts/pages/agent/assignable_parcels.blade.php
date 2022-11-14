@extends('frontEnd.layouts.pages.agent.agentmaster')
@section('title', 'My Assignable Parcel')
@section('agent_assignable_parcels', 'active')
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
                <div class="tab-inner">
                    <table id="example" class="table agentAssignableTable table-striped table-responsive">
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
                                <th>@lang('common.note')</th>
                                <th>@lang('common.more')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allparcel as $key => $value)
                                <tr>
                                    @php
                                        $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                                        $merchantInfo = App\Merchant::find($value->merchantId);
                                        $pickupmanInfo = App\Deliveryman::find($value->pickupmanId);
                                        $parcel_deliverymen = App\Deliveryman::where('district_id',$value->district_id)->get();
                                        $parcel_pickupmen = App\Pickupman::where('district_id',$value->district_id)->get();
                                    @endphp
                                    {{-- @if ($key==1)
                                    {{ dd($value->merchantId) }}
                                    @endif --}}
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
                                            <button class="btn btn-info" href="#" data-toggle="modal"
                                                data-target="#merchantParcel{{ $value->id }}" title="View"><i
                                                    class="fa fa-eye"></i></button>
                                        </li>
                                        <div id="merchantParcel{{ $value->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">@lang('common.parcel_details')</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>@lang('common.merchant_name')</td>
                                                                <td>{{ $value->firstName }} {{ $value->lastName }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('common.mobile_no')</td>
                                                                <td>{{ $value->phoneNumber }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('common.email')</td>
                                                                <td>{{ $value->emailAddress }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('common.company_name')</td>
                                                                <td>{{ $value->companyName }}</td>
                                                            </tr>
                                                            <td>@lang('common.recepient_name')</td>
                                                            <td>{{ $value->recipientName }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.recepient_address')</td>
                                    <td>{{ $value->recipientAddress }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.cod')</td>
                                    <td>{{ $value->cod }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.cod_charge')</td>
                                    <td>{{ $value->codCharge }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.delivery_charge')</td>
                                    <td>{{ $value->deliveryCharge }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.sub_total')</td>
                                    <td>{{ $value->merchantAmount }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.paid')</td>
                                    <td>{{ $value->merchantPaid }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.due')</td>
                                    <td>{{ $value->merchantDue }}</td>
                                </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('common.close')</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
    <li>
        <button class="btn btn-primary" title="Action" data-toggle="modal" data-target="#sUpdateModal{{ $value->id }}">
        @lang('common.assign_me')
        </button>
    </li>
    <!-- Modal -->
    <div id="sUpdateModal{{ $value->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form action="{{ url('agent-parcel-assign-parcel') }}" method="POST">
                @csrf
                <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                <input type="hidden" name="customer_phone" value="{{ $value->recipientPhone }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('common.agent_assign')  </h5>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for=""> @lang('common.note') </label>
                                <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">@lang('common.close')</button>
                        <button class="btn btn-success pull-right"> @lang('common.assign_me')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal end -->
    @if ($value->status >= 2)
        <li><a class="btn btn-primary" a href="{{ url('agent/parcel/invoice/' . $value->id) }}" title="Invoice"><i
                    class="fas fa-list"></i></a></li>
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
    <!-- Modal -->
@endsection
