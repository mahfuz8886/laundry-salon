@extends('backEnd.layouts.master')
@section('parcel', 'active menu-open')
@section('merchants', 'active')
@section('title', 'Merchant Parcels')
@section('extracss')
<style>
    .table th {
        padding: 8px 10px !important;
        white-space: nowrap !important; 
    }
    .table th, .table td {
        padding: 5px 6px !important;
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
                                        <h5> @lang('common.merchant') @lang('common.parcel') </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form action="" class="filte-form">
                                    @csrf
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="text-right">
                                    <button type="button" class="btn btn-sm btn-info" onclick="getPrint()"> @lang('common.print') </button>
                                </div>
                                <div class="print_area">
                                    <div class="">
                                        <table class="table table-bordered">
                                            <h3 class="text-center"> @lang('common.merchant') @lang('common.parcel')</h3>
                                            <h4 class="text-center"> {{ $merchant->firstName }} - {{ $merchant->phoneNumber }} </h4>
                                            <thead>
                                                <tr>
                                                    <th>@lang('common.id')</th>
                                                    <th> @lang('common.track_id') </th>
                                                    <th> @lang('common.customer_name')</th>
                                                    <th> @lang('common.mobile_no') </th>
                                                    <th> @lang('common.delivery_address') </th>
                                                    <th class="text-right"> @lang('common.total_collection')</th>
                                                    <th class="text-right"> @lang('common.total_charge') </th>
                                                    <th class="text-right"> @lang('common.merchant') @lang('common.amount')</th>
                                                    <th> @lang('common.status') </th>
                                                    <th class="table_action"> @lang('common.action') </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parcels as $key => $parcel)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $parcel->trackingCode }}</td>
                                                        <td>{{ $parcel->recipientName }}</td>
                                                        <td>{{ $parcel->recipientPhone }}</td>
                                                        <td>
                                                            {{ $parcel->delivery_address }}
                                                            @if ($parcel->area) , {{ $parcel->area->name }}
                                                            @elseif ($parcel->thana) , {{ $parcel->thana->name }}
                                                            @elseif ($parcel->district) , {{ $parcel->district->name }}
                                                            @elseif ($parcel->division), {{ $parcel->division->name }}
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{ $parcel->cod }}</td>
                                                        <td class="text-right">{{ $parcel->deliveryCharge + $parcel->codCharge }}</td>
                                                        <td class="text-right">{{ $parcel->merchantAmount }}</td>
                                                        <td class="text-left">{{ $parcel->parcelStatus->title??'' }}</td>
                                                        <td class="table_action">
                                                            <a href="{{ url('/editor/parcel/invoice/'.$parcel->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                                            @lang('common.invoice')
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-area">
                                        <div class="pagination-wrapper d-flex justify-content-center align-items-center">
                                            {{ $parcels->links() }}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var APP_URL = '{!! url()->full()  !!}';
        function getPrint() {
            $('.table_action').remove();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
    <!-- Modal Section  -->
@endsection
