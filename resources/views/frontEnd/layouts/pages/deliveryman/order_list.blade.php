@extends('frontEnd.layouts.pages.deliveryman.master')
@section('parcels', 'active')
@section('title', 'Orders')

@section('content')

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
                                        $parcelTypes = App\ParcelType::whereNotIn('id', array(6,7,8))->get();
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
                                        <option {{$_GET && $_GET['payment_status'] == 'Paid'? 'selected':''}} value="Paid">Paid</option>
                                        <option {{$_GET && $_GET['payment_status'] == 'Unpaid'? 'selected':''}} value="Unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Order#</label>
                                    <input type="text" name="order_id" value="{{ $_GET['order_id']??'' }}" class="form-control" value="">
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" name="date_to" value="{{ $_GET['date_to']??'' }}" class="form-control" value="">
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
                                    <th>@lang('common.order_id')</th>
                                    <th>@lang('common.place_date')</th>
                                    <th>@lang('common.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('deliveryman.orderdetails', $order->id) }}" class="mr-2"><i class="fa fa-desktop"></i></a>
                                    </td>
                                    <td>{{ $order->statusName->title??'' }}</td>
                                    <td>{{ $order->pay_status }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->getAmount->sum('total') }}</td>
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
                            {{ $orders->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    
@endsection