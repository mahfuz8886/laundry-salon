@extends('backEnd.layouts.master')
@section('parcel', 'active menu-open')
@section($parceltype->title, 'active')
@section('title', $parceltype->title)
@section('extracss')
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

        .table-cont {
            border: 1px red solid;
        }

        .table-cont .table {
            min-width: 600px;
        }

        .table th,
        .table td {
            white-space: nowrap !important;
            /* word-wrap: break-word;   */
        }

        .table td {
            padding: 2px 10px !important;
            margin: 0px !important;
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
                                        <h5>{{ $parceltype->title }} @lang('common.parcel')</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form action="" class="filte-form">
                                    {{-- @csrf --}}
                                    <div class="row">
                                        <input type="hidden" value="1" name="filter_id">
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
                                            <input type="date" class="flatDate form-control" placeholder="@lang('common.date_from')" name="startDate"
                                                value="{{ request()->get('startDate') }}">
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-2">
                                            <input type="date" class="flatDate form-control" placeholder="@lang('common.date_to')" name="endDate"
                                                value="{{ request()->get('endDate') }}">
                                        </div>
                                        {{-- <div class="col-sm-2">
                                            <input type="number" class="form-control" placeholder="Merchant Id"
                                                name="merchantId" value="{{ request()->get('merchantId') }}">
                                        </div> --}}
                                        <!-- col end -->
                                        <div class="col-sm-4">
                                            <select name="merchantId" id="merchantId" class="form-control select2">
                                                <option value=""> @lang('common.select') @lang('common.merchant')</option>
                                                @foreach ($merchants as $merchant)
                                                    <option value="{{ $merchant->id }}"
                                                        @if (request()->get('merchantId') == $merchant->id) selected @endif>
                                                        {{ $merchant->companyName }} ({{ $merchant->firstName }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-2 mt-2">
                                            <select name="per_page" id="per_page" class="form-control select2">
                                                <option value="10" @if (request()->get('per_page') == '10') selected @endif> 10
                                                </option>
                                                <option value="25" @if (request()->get('per_page') == '25') selected @endif> 25
                                                </option>
                                                <option value="50" @if (request()->get('per_page') == '50') selected @endif> 50
                                                </option>
                                                <option value="100" @if (request()->get('per_page') == '100') selected @endif>
                                                    100 </option>
                                                <option value="300" @if (request()->get('per_page') == '300') selected @endif>
                                                    300 </option>
                                                <option value="all" @if (request()->get('per_page') == 'all') selected @endif>
                                                    All </option>
                                            </select>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-2 my-2">
                                            <button type="submit" class="btn btn-success">@lang('common.submit') </button>
                                        </div>
                                        <!-- col end -->
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('editor/parcel/selectupdate') }}" method="post">
                                    <div class="action_container my-1" style="width: 200px">
                                        <div class="form-group d-flex">
                                            <select name="updstatus" class="form-control"
                                                style="width: 170px; margin-right:25px;">
                                                @foreach ($parceltypes as $i => $ptvalue)
                                                    <option value="{{ $ptvalue->id }}">{{ $ptvalue->title }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-primary btn-sm" type="submit" name="all_submit"> @lang('common.update')
                                            </button>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"> @lang('common.select_all') </th>
                                                <th>@lang('common.id')</th>
                                                <th>@lang('common.company_name')</th>
                                                <th>@lang('common.recipient_name')</th>
                                                <th>@lang('common.mobile_no')</th>
                                                <th>@lang('common.track_id')</th>
                                                <th width="300">@lang('common.address')</th>
                                                <th>@lang('common.pickupman')</th>
                                                <th>@lang('common.rider')</th>
                                                <th>@lang('common.agent')</th>
                                                <th> @lang('common.created_date') </th>
                                                <th>@lang('common.last_update')</th>
                                                <th>@lang('common.status')</th>
                                                {{-- <th>Status Description</th> --}}
                                                {{-- <th>Parcel Type</th> --}}
                                                <th>@lang('common.total')</th>
                                                <th>@lang('common.charge')</th>
                                                <th>@lang('common.sub_total')</th>
                                                {{-- <th>Actual Price</th> --}}
                                                <th>@lang('common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($show_data as $key => $value)
                                                <tr>
                                                    <td>
                                                        @if ($value->merchantPaid == 0)
                                                            <input type="checkbox" name="parcel_select[]"
                                                                class="parcel_check" value="{{ $value->id }}">
                                                        @endif
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    @php
                                                        $merchant = App\Merchant::find($value->merchantId);
                                                        $agentInfo = App\Agent::find($value->agentId);
                                                        $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                                                        $pickupmanInfo = App\Pickupman::find($value->pickupmanId);
                                                    @endphp

                                                    <td>{{ $merchant->companyName }}</td>
                                                    <td>{{ $value->recipientName }}</td>
                                                    <td>{{ $value->recipientPhone }}</td>
                                                    <td>{{ $value->trackingCode }}</td>
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
                                                        @if ($value->pickupmanId)
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#pickupmanModal{{ $value->id }}">
                                                                {{ $pickupmanInfo->name ?? '' }}
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#pickupmanModal{{ $value->id }}">@lang('common.assign')</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($value->deliverymanId)
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#asignModal{{ $value->id }}">{{ $deliverymanInfo->name ?? '' }}</button>
                                                        @else
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#asignModal{{ $value->id }}">@lang('common.assign')</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($value->agentId)
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#agentModal{{ $value->id }}">{{ $agentInfo->name }}</button>
                                                        @else
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#agentModal{{ $value->id }}">@lang('common.assign')</button>
                                                        @endif
                                                    </td>



                                                    <td>{{ date('F d, Y h:i a', strtotime($value->created_at)) }}</td>
                                                    <td>{{ date('F d, Y h:i a', strtotime($value->updated_at)) }}</td>
                                                    <td>{{ $parceltype->title }}</td>
                                                    {{-- <td>{{ $value->status_description }}</td> --}}
                                                    {{-- <td>
                                                        @if ($value->percelType == 1)
                                                            Prepaid
                                                        @else
                                                            Cash collection
                                                        @endif
                                                    </td> --}}
                                                    <td> {{ $value->cod }}</td>
                                                    <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                                    <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}
                                                    </td>
                                                    {{-- <td>{{ $value->productPrice }}</td> --}}
                                                    <td>
                                                        <ul class="action_buttons">
                                                            <li>
                                                                <a href="{{ url('editor/parcel/edit/' . $value->id) }}"
                                                                    class="edit_icon"><i class="fa fa-edit"></i></a>
                                                            </li>
                                                            @if (Auth::user()->role_id <= 2)
                                                                <li>
                                                                    {{-- <button type="button" class="thumbs_up" title="Action"
                                                                        data-toggle="modal"
                                                                        data-target="#sUpdateModal{{ $value->id }}"><i
                                                                            class="fa fa-sync-alt"></i></button> --}}
                                                                    <!-- Modal -->
                                                                    <div id="sUpdateModal{{ $value->id }}"
                                                                        class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">@lang('common.parcel_status_update')</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ url('editor/parcel/status-update') }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="hidden_id"
                                                                                            value="{{ $value->id }}">
                                                                                        <input type="hidden"
                                                                                            name="customer_phone"
                                                                                            value="{{ $value->recipientPhone }}">
                                                                                        <div class="form-group">
                                                                                            <select name="status"
                                                                                                onchange="percelDelivery(this)"
                                                                                                class="form-control"
                                                                                                id="">
                                                                                                @foreach ($parceltypes as $index => $ptvalue)
                                                                                                    <option
                                                                                                        value="{{ $ptvalue->id }}"
                                                                                                        @if ($value->status == $ptvalue->id) selected="selected" @endif>
                                                                                                        {{ $ptvalue->title ?? '' }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control" id="parcel_Status_description" max="50" name="parcel_Status_description"
                                                                                                rows="3" cols="20" placeholder="@lang('common.description')"></textarea>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <button
                                                                                                class="btn btn-success">Update</button>
                                                                                        </div>

                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-dismiss="modal">@lang('common.close')</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal end -->
                                                                </li>
                                                            @endif

                                                            <li>
                                                                <button type="button" class="edit_icon" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#merchantParcel{{ $value->id }}"
                                                                    title="View"><i class="fa fa-eye"></i></button>
                                                                <div id="merchantParcel{{ $value->id }}"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('common.parcel_details')
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <td>@lang('common.merchant') @lang('common.name')</td>
                                                                                            <td>{{ $value->firstName }}
                                                                                                {{ $value->lastName }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>@lang('common.mobile_no')</td>
                                                                                            <td>{{ $value->phoneNumber }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>@lang('common.email_address')</td>
                                                                                            <td>{{ $value->emailAddress }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>@lang('common.company_name')</td>
                                                                                            <td>{{ $value->companyName }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <td>@lang('common.recipient_name')</td>
                                                                                        <td>{{ $value->recipientName }}
                                                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('common.recipient_address')</td>
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
                                                <tr>
                                                    <td>@lang('common.last_update')</td>
                                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}
                                                    </td>
                                                </tr>
                                    </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('common.close')</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
            </li>

            <li>
                <a target="_blank" class="edit_icon anchor" a href="{{ url('editor/parcel/invoice/' . $value->id) }}"
                    title="Invoice"><i class="fa fa-list"></i></a>
            </li>

            </ul>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            <div class="pagination-area">
                <div class="pagination-wrapper d-flex justify-content-center align-items-center">
                    @if (request()->get('per_page') != 'all')
                        {{ $show_data->appends($_GET)->links() }}
                    @endif
                </div>
            </div>
            </form>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        </div>
        </div>
        </div>

        <!-- modal section-->
        @foreach ($show_data as $key => $value)
            @php
                $merchant = App\Merchant::find($value->merchantId);
                $agentInfo = App\Agent::find($value->agentId);
                $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                $pickupmanInfo = App\Pickupman::find($value->pickupmanId);
                $pickupmen = App\Pickupman::where('district_id', $value->district_id)->get();
            @endphp

            <!-- Modal -->
            <div id="pickupmanModal{{ $value->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> @lang('common.pickupman') @lang('common.assign')</h5>
                        </div>
                        <div class="modal-body">
                            <form id="pickupman" action="{{ url('editor/pickupman/asign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber }}">
                                <div class="form-group">
                                    <select name="pickupmanId" class="form-control" id="">
                                        <option value="">@lang('common.select')</option>
                                        @foreach ($pickupmen as $key => $pickupman)
                                            <option value="{{ $pickupman->id }}">{{ $pickupman->name }} -
                                                {{ $pickupman->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- form group end -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">@lang('common.update')</button>
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

            <!-- Modal -->
            <div id="asignModal{{ $value->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    @php
                        $parcel_deliverymen = App\Deliveryman::where('district_id', $value->district_id)->get();
                    @endphp
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('common.deliveryman') @lang('common.assign')</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('editor/deliveryman/asign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber }}">
                                <div class="form-group">
                                    <select name="deliverymanId" class="form-control" id="">
                                        <option value="">@lang('common.select')</option>
                                        @foreach ($parcel_deliverymen as $key => $deliveryman)
                                            <option value="{{ $deliveryman->id }}">{{ $deliveryman->name }} -
                                                {{ $deliveryman->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- form group end -->
                                <!-- form group end -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">@lang('common.update')</button>
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

            <!-- Modal -->
            <div id="agentModal{{ $value->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    @php
                        $parcel_agents = App\Agent::where('district_id', $value->district_id)->get();
                    @endphp
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('common.agent') @lang('common.assign')</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('editor/agent/asign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber }}">
                                <div class="form-group">
                                    <select name="agentId" class="form-control" id="">
                                        <option value="">@lang('common.select')</option>
                                        @foreach ($parcel_agents as $key => $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }} -
                                                {{ $agent->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- form group end -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">@lang('common.update')</button>
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
        @endforeach






        <!--modal section-->





    </section>

    <script>
        //custome script
        $('#select-all').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        function selectRow(parent) {
            let par = parent;
            document.getElementByTagName('tr').style.background = "#ffffff";
            par.style.background = "#ddd";
        }

        //   function clearSelect(parent) {
        //       console.log(parent);
        //       let par = parent;
        //       par.style.background = "#fff";
        //   }

        $(document).ready(function() {
            $('table tr').each(function(a, b) {
                $(b).click(function() {
                    $('table tr').css('background', '#ffffff');
                    $(this).css('background', '#ddd');
                });
            });


        });
    </script>

    <!-- Modal Section  -->
@endsection
