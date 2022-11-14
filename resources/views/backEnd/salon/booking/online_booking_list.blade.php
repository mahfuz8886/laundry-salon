@extends('backEnd.layouts.master')
@section('salon_order_section', 'active menu-open')
@section('online_order', 'active menu-open')
@section('manage_online_order', 'active')
@section('title', 'Orders')

@section('content')

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
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control select2">
                                        <option value="">@lang('common.select')</option>
                                        @php 
                                        $parcelTypes = App\ParcelType::whereIn('id', array(1,9,10,12))->get();
                                        @endphp
                                        @foreach($parcelTypes as $type)
                                        <option {{ $_GET && $_GET['status'] == $type->id ? 'selected':'' }} value="{{ $type->id }}">{{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Pay Status</label>
                                    <select name="payment_status" class="form-control select2">
                                        <option value=""></option>
                                        <option {{$_GET && $_GET['payment_status'] == 1? 'selected':''}} value="1">Paid</option>
                                        <option value="0">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Booking#</label>
                                    <input type="text" name="order_id" value="{{ $_GET['order_id']??'' }}" class="form-control" value="">
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" name="date_to" value="{{ $_GET['date_to']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.action')</th>
                                    <th>@lang('common.status')</th>
                                    <th>@lang('common.pay_status')</th>
                                    <th>@lang('common.booking_id')</th>
                                    <th>@lang('common.place_date')</th>
                                    <th>@lang('common.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('superadmin.salon.orderdetails', $order->id) }}" class="mr-2"><i class="fa fa-desktop"></i></a>
                                        <a href="#" class="mr-2"><i class="fa fa-print"></i></a>
                                    </td>
                                    <td>{{ $order->statusName->title??'' }}</td>
                                    <td>{{ $order->paid_status==1? 'Paid':'Unpaid' }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @php
                                        $bItems = App\SalonBookingItem::where('booking_id', $order->id)->get();
                                        echo $bItems->sum('total'); 
                                        @endphp
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $bookings->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    
@endsection