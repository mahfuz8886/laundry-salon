@extends('backEnd.layouts.master')
@section('title', 'View Merchant')
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
                                    <div class="body-titleer">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>{{ $merchantInfo->companyName }}</h5>
                                            </div>
                                            <div class="col-sm-6 text-right"><button class="btn btn-primary" title="Action"
                                                    data-toggle="modal" data-target="#fullprofile"><i
                                                        class="fa fa-eye"></i> @lang('common.full_profile')</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="supplier-profile">
                                    <div class="company-name">
                                        <h2>@lang('common.contact_info')</h2>
                                    </div>
                                    <div class="supplier-info">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td> @lang('common.user_id') </td>
                                                <td>{{ $merchantInfo->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.name')</td>
                                                <td>{{ $merchantInfo->firstName }} {{ $merchantInfo->lastName }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.mobile_no')</td>
                                                <td>{{ $merchantInfo->phoneNumber }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.email_address')</td>
                                                <td>{{ $merchantInfo->emailAddress }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.nid')</td>
                                                <td>{{ $merchantInfo->nidnumber }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="supplier-profile">
                                    <div class="invoice slogo-area">
                                        <div class="supplier-logo">
                                            <img src="{{asset('public/frontEnd')}}/images/avator.png" alt="Photo">
                                        </div>
                                    </div>
                                    <div class="supplier-info">

                                        <div class="supplier-basic">
                                            <h5>{{ $merchantInfo->companyName }}</h5>
                                            <p>@lang('common.trade_licence_no') : {{ $merchantInfo->trade_licence_no }}</p>
                                            <p>@lang('common.facebook_page') : {{ $merchantInfo->facebook_page }}</p>
                                            <p>@lang('common.website') : {{ $merchantInfo->website }}</p>
                                            <p>@lang('common.member_since') : {{ date('d M Y', strtotime($merchantInfo->created_at)) }}</p>
                                            <p>@lang('common.status') : {{ $merchantInfo->status == 1 ? 'Active' : 'Inactive' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="supplier-profile">
                                    <div class="purchase">
                                        <h2>@lang('common.account_info')</h2>
                                    </div>
                                    @php
                                        $parcel_info = $merchantInfo->parcelCount();
                                    @endphp
                                    <div class="supplier-info">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>@lang('common.total_parcel')</td>
                                                <td>{{ $parcel_info['total'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.total_amount')</td>
                                                <td>{{ $parcel_info['total_amount'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.paid') </td>
                                                <td>{{ $parcel_info['total_paid'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.due') </td>
                                                <td>{{ $parcel_info['total_due'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.payment_method')</td>
                                                <td>
                                                    @if ($merchantInfo->paymentMethod == 1)
                                                    @lang('common.bank')
                                                    @endif
                                                    @if ($merchantInfo->paymentMethod == 2)
                                                    @lang('common.bkash')
                                                    @endif
                                                    @if ($merchantInfo->paymentMethod == 3)
                                                    @lang('common.nagad')
                                                    @endif
                                                    @if ($merchantInfo->paymentMethod == 4)
                                                    @lang('common.cash')
                                                    @endif
                                                    @if ($merchantInfo->paymentMethod == 5)
                                                    @lang('common.others')
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('common.payment_mode')</td>
                                                <td>
                                                    {{ $merchantInfo->paymentmode }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="card-body">
                                <form action="{{ url('admin/merchant-payment/bulk-option') }}" method="POST" id="myform">
                                    @csrf
                                    <input type="hidden" value="{{ $merchantInfo->id }}" name="merchantId">
                                    <input type="hidden" value="{{ $merchantInfo->id }}" name="parcelId">
                                    @if (Auth::user()->role_id <= 2)
                                        <select name="selectptions" class="bulkselect" form="myform"
                                            required="required">
                                            <option value="">Select..</option>
                                            <option value="0">Processing</option>
                                            <option value="1">Paid</option>
                                        </select>
                                        <button type="submit" class="bulkbutton"
                                            onclick="return confirm('Are you want change this?')">Apply</button>
                                    @endif

                                    <table class="example" class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="My-Button"></th>
                                                <th>SL</th>
                                                <th>Id</th>
                                                <th>Date</th>
                                                <th>COD</th>
                                                <th>L. Update</th>
                                                <th>Subtotal</th>
                                                <th>Paid Bills</th>
                                                <th>Due Bills</th>
                                                <th>Parcel Type</th>
                                                <th>C. Charge</th>
                                                <th>D. Charge</th>
                                                <th>Pay Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($parcels as $key => $value)
                                                <tr>
                                                    <td><input type="checkbox" value="{{ $value->id }}"
                                                            name="parcel_id[]" form="myform"></td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $value->trackingCode }}</td>
                                                    <td> {{ date('F d Y', strtotime($value->created_at)) }}
                                                        {{ date('H:i:s:A', strtotime($value->created_at)) }}</td>
                                                    <td>{{ $value->cod }}</td>
                                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                                                    <td>{{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}</td>
                                                    <td>{{ $value->merchantPaid }}</td>
                                                    <td>{{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}</td>
                                                    <td>
                                                        @if ($value->percelType == 1)
                                                            Prepaid
                                                        @else
                                                            Cash collection
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->codCharge }}</td>
                                                    <td>{{ $value->deliveryCharge }}</td>
                                                    <td>
                                                        @if ($value->merchantpayStatus == null)
                                                            NULL
                                                        @elseif($value->merchantpayStatus == 0)
                                                            Processing
                                                        @else
                                                            Paid
                                                        @endif
                                                    </td>
                                                    <td>@php $parceltype = App\Parceltype::find($value->status); @endphp @if ($parceltype != null)
                                                            {{ $parceltype->title }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <ul class="action_buttons">
                                                            @if ($value->status == 3)
                                                                <li>
                                                                    <a class="edit_icon anchor" a
                                                                        href="{{ url('editor/parcel/invoice/' . $value->id) }}"
                                                                        title="Invoice"><i class="fa fa-list"></i></a>
                                                                    <!-- Modal -->
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <a class="edit_icon" href="#" data-toggle="modal"
                                                                    data-target="#merchantParcel{{ $value->id }}"
                                                                    title="View"><i class="fa fa-eye"></i></a>
                                                                <div id="merchantParcel{{ $value->id }}"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Parcel Details
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <table
                                                                                    class="table table-bordered">
                                                                                    <tr>
                                                                                        <td>Recipient Name</td>
                                                                                        <td>{{ $value->recipientName }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Recipient Address</td>
                                                                                        <td>{{ $value->recipientAddress }}
                                                                                        </td>
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
                                                                                        <td>{{ $value->deliveryCharge }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Sub Total</td>
                                                                                        <td>{{ $value->merchantAmount }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Paid</td>
                                                                                        <td>{{ $value->merchantPaid }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Due</td>
                                                                                        <td>{{ $value->merchantDue }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Last Update</td>
                                                                                        <td>{{ $value->updated_at }}</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal end -->
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div id="fullprofile" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('common.profile')</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>@lang('common.name')</td>

                                    <td>{{ $merchantInfo->firstName }} {{ $merchantInfo->lastName }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.username')</td>
                                    <td>{{ $merchantInfo->username }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.company_name')</td>
                                    <td>{{ $merchantInfo->companyName }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.mobile_no')</td>
                                    <td>{{ $merchantInfo->phoneNumber }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.email_address')</td>
                                    <td>{{ $merchantInfo->emailAddress }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.pickup_address')</td>
                                    <td>{{ $merchantInfo->pickLocation }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.bank_name')</td>
                                    <td>{{ $merchantInfo->nameOfBank }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.branch_name')</td>
                                    <td>{{ $merchantInfo->nameOfBank }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.ac_holder_name')</td>
                                    <td>{{ $merchantInfo->bankAcHolder }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.bank_ac_no')</td>
                                    <td>{{ $merchantInfo->bankAcNo }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.bkash')</td>
                                    <td>{{ $merchantInfo->bkashNumber }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.rocket')</td>
                                    <td>{{ $merchantInfo->roketNumber }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('common.nagad')</td>
                                    <td>{{ $merchantInfo->nogodNumber }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('common.close')</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    </section>
    <script>
        $(document).ready(function() {
            $('.example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "autoWidth": true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,

            });
        });
    </script>
@endsection
