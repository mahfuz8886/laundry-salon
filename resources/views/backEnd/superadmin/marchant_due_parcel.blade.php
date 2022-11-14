@extends('backEnd.layouts.master')
@section('payment', 'active menu-open')
@section('title', 'Payment Marchant')
@section('content')


    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="box-content mb-5">
                <form action="{{ url('superadmin/submit_due_payment') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="paid_form_section col-md-8 my-5">
                            <div class="paid_description">
                                <p><b>@lang('common.total_select_parcel') : </b> <span class="total_parcel ml-2">0</span></p>
                                <p><b>@lang('common.total_amount_count') : </b> <span class="total_amount ml-2">0</span></p>

                                <input type="hidden" value="{{ $marchant }}" name="merchantId">
                                <input type="hidden" value="{{ $marchant }}" name="parcelId">

                                <input type="submit" class="btn btn-outline-success text-uppercase" name="submit"
                                    value="Paid all selected parcel">
                            </div>
                        </div>
                        <div class="col-md-4 my-5">
                            <div class="details-wrapper">

                                <h2 class="border-bottom">Payment Method Details</h2>
                                @if ($minfo->paymentMethod == 1)
                                    <p><b>@lang('common.bank_name'): </b>{{ $minfo->nameOfBank }}</p>
                                    <p><b>@lang('common.branch_name'): </b>{{ $minfo->bankBranch }}</p>
                                    <p><b>@lang('common.ac_holder_name'): </b>{{ $minfo->bankAcHolder }}</p>
                                    <p><b>@lang('common.bank_ac_no'): </b>{{ $minfo->bankAcNo }}</p>
                                @elseif ($minfo->paymentMethod == 2)
                                    <p><b>@lang('common.bkash'): </b>{{ $minfo->bkashNumber }}</p>
                                @elseif ($minfo->paymentMethod == 3)
                                    <p><b>@lang('common.rocket'): </b>{{ $minfo->roketNumber }}</p>
                                @elseif ($minfo->paymentMethod == 4)
                                    <p><b>@lang('common.nagad'): </b>{{ $minfo->nogodNumber }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pl-3 pr-3">
                        <table id="payment" class="table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>@lang('common.track_id')</th>
                                    <th>@lang('common.cod')</th>
                                    <th>@lang('common.merchant') @lang('common.amount')</th>
                                    <th>@lang('common.parcel') @lang('common.type')</th>
                                    <th>@lang('common.cod_charge')</th>
                                    <th>@lang('common.delivery_charge')</th>
                                    <th>@lang('common.status')</th>
                                    <th>@lang('common.delivered_date')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($results as $parcel)
                                    <tr class="ml-1 sparent">
                                        <td><input class="pselect" type="checkbox" name="parcel_id[]"
                                                value="{{ $parcel->id }}"></td>
                                        <td>{{ $parcel->trackingCode }}</td>
                                        <td>{{ $parcel->cod }}</td>
                                        <td>{{ $parcel->merchantAmount }}</td>
                                        <td>
                                            @if ($parcel->percelType == 1)
                                                Prepaid
                                            @else
                                            @lang('common.cash_collection')
                                            @endif
                                        </td>
                                        <td>{{ $parcel->codCharge }}</td>
                                        <td>{{ $parcel->deliveryCharge }}</td>
                                        <td>
                                            @if ($parcel->status == 4)
                                                Delivered
                                            @elseif($parcel->status > 5 && $parcel->status < 9)
                                                Return
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                
                                                echo date('F d, Y h:i:s a', strtotime($parcel->updated_at));
                                                
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function() {
            $('#payment').DataTable({
                "paging": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
            });


            $('#payment').on('click', '#select-all', function(event) {

                if (this.checked) {
                    // Iterate each checkbox
                    $('#payment :checkbox').each(function() {
                        this.checked = true;
                    });
                    updateAmount();
                } else {
                    $('#payment :checkbox').each(function() {
                        this.checked = false;
                    });
                    updateAmount();
                }
            });


            $('#payment').on('click', '.pselect', function() {
                updateAmount();
            });


            function updateAmount() {
                let totalParcel = 0;
                let totalAmount = 0;
                //get all checkbox input field
                $('#payment .sparent .pselect').each(function() {
                    if (this.checked == true) {

                        totalParcel += 1;

                        let alltr = $(this).closest('tr');

                        let data = alltr.children('td').map(function() {
                            return $(this).text();
                        });

                        let parcelType = data[4].replace('\n', '').trim();
                        let status = data[7].replace('\n', '').trim();


                        if (parcelType == 'Prepaid' || status == 'Return') {
                            totalAmount -= parseInt(data[6]);

                        } else {
                            totalAmount += parseInt(data[3]);
                        }



                    }
                });

                $('.total_parcel').text(totalParcel);
                $('.total_amount').text(totalAmount);

            }
        });
    </script>

@endsection
