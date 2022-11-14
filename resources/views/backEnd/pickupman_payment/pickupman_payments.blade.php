@extends('backEnd.layouts.master')
@section('payment', 'active menu-open')
@section('pickupman_payment_summary', 'active')
@section('title', 'Payment Pickupman')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="box-content mb-5">
                <form action="{{ url('superadmin/pickupman-payment') }}" method="POST">
                    @csrf
                    <div class="row">
                        @if ($type != 'paid')
                            <div class="paid_form_section col-md-8 my-5">
                                <div class="paid_description">
                                    <p><b>@lang('common.total_select_parcel') : </b> <span class="total_parcel ml-2">0</span></p>
                                    <p><b>@lang('common.total_amount') : </b> <span class="total_amount ml-2">0</span></p>

                                    <input type="hidden" value="{{ $pickupman->id ?? '' }}" name="pickupmanId">
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        onclick="return confirm('Do you want to paid all selected parcel?')"> @lang('common.select_parcel') @lang('common.paid') </button>
                                    {{-- <input type="submit" class="btn btn-outline-success text-uppercase" name="submit" value="Paid all selected parcel"> --}}
                                </div>
                            </div>
                        @endif

                        <div class="col-md-4 my-5">
                            <div class="details-wrapper">

                                <h2 class="border-bottom">@lang('common.payment_method') @lang('common.details')</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pl-3 pr-3">
                        <table id="payment" class="table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>@lang('common.track_id')</th>
                                    <th class="text-right"> @lang('common.total_collection') </th>
                                    <th class="text-right"> @lang('common.pickupman') @lang('common.total')</th>
                                    <th class="text-right"> @lang('common.paid') </th>
                                    <th class="text-right"> due </th>
                                    <th>@lang('common.status')</th>
                                    <th>@lang('common.action') </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pickupman_parcels as $parcel)
                                    <tr class="ml-1 sparent">
                                        <td>
                                            @if ($parcel->pickupman_due > 0)
                                                <input class="pselect" type="checkbox" name="parcel_id[]"
                                                    value="{{ $parcel->id }}">
                                            @endif

                                        </td>
                                        <td>{{ $parcel->trackingCode }}</td>
                                        <td class="text-right">{{ $parcel->cod }}</td>
                                        <td class="text-right">{{ $parcel->pickupman_amount }}</td>
                                        <td class="text-right">
                                            {{ $parcel->pickupman_paid }}
                                        </td>
                                        <td class="text-right">{{ $parcel->pickupman_due }}</td>
                                        <td>
                                            {{ $parcel->parcelStatus->title ?? '' }}
                                        </td>
                                        <td>
                                            @if ($parcel->pickupman_paid > 0)
                                                <a href="{{ url('superadmin/pickupman-payment-invoice/'.$parcel->id) }}" target="_blank" class="btn btn-sm btn-info">
                                                @lang('common.invoice')
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="ml-1 sparent">
                                    <th class="text-right" colspan="2"> @lang('common.total') </th>
                                    <th class="text-right">{{ $pickupman_parcels->sum('cod') }}</th>
                                    <th class="text-right">{{ $pickupman_parcels->sum('pickupman_amount') }}</th>
                                    <th class="text-right">
                                        {{ $pickupman_parcels->sum('pickupman_paid') }}
                                    </th>
                                    <th class="text-right">{{ $pickupman_parcels->sum('pickupman_due') }}</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>

                            </tbody>
                        </table>
                        <br>
                        {{ $pickupman_parcels->links() }}
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function() {
            // $('#payment').DataTable({
            //     "paging": true,
            //     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            // });


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

                        totalAmount += parseFloat(data[5]);

                    }
                });

                $('.total_parcel').text(totalParcel);
                $('.total_amount').text(totalAmount);

            }
        });
    </script>

@endsection
