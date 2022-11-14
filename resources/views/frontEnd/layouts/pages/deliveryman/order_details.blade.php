@extends('frontEnd.layouts.pages.deliveryman.master')
@section('parcels', 'active')
@section('title', 'Orders')
<style>
    .card{
        margin: 5px !important;
    }
</style>
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @php 
                    $status = App\ParcelType::where('id', $order->order_status)->first(); 
                    $totalAmount = 0;
                    $totalshipping = 0;

                    // pickupman
                    $pickupman = App\Pickupman::where('status', 1)->get();

                    // deliveryman
                    $deliveryman = App\Deliveryman::where('status', 1)->get();

                    @endphp
                    <p><span>@lang('common.order_id'): <b>{{ $order->id }}</b></span>, <span>@lang('common.status'): <b>{{ $status->title }}</b></span></p>
                    
                    <div class="py-3">
                        <form action="{{ route('deliveryman.orderdelivered') }}" method="post">
                            @csrf
                            {{-- picked order --}}
                            @if($order->order_status == 12 && $order->dman_id)
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Payment method information</label>
                                        <textarea name="payment_method_info" id="" cols="30" rows="3" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Receive amount</label>
                                        <input type="number" name="paid_amount" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Delivery Order" class="btn btn-primary btn-sm">
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <a onclick="return confirm('Are you sure you have delivered order?')" class="btn btn-primary btn-sm" href="{{ route('deliveryman.orderdelivered', $order->id) }}">@lang('common.delivery_order')</a>  --}}
                        @endif

                        <p>
                            @if($order->order_status == 4)
                            <span>@lang('common.delivery_on') </span><b>@php echo date('F Y h:i:s a',strtotime($order->updated_at)) @endphp</b>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @php
                            $orderPman = App\Pickupman::where('id', $order->pman_id)->first();
                            @endphp
                            <p>@lang('common.pickupman_info')</p>
                            <p class="m-1">@lang('common.name') : <b>{{ $orderPman->name??'' }}</b></p>
                            <p class="m-1">@lang('common.mobile_no') : <b>{{ $orderPman->phone??'' }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @php
                            $orderDman = App\Deliveryman::where('id', $order->dman_id)->first();
                            @endphp
                            <p>@lang('common.deliveryman_info')</p>
                            <p class="m-1">@lang('common.name') : <b>{{ $orderDman->name??'' }}</b></p>
                            <p class="m-1">@lang('common.mobile_no') : <b>{{ $orderDman->phone??'' }}</b></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-dark"><b>@lang('common.items')</b></h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.image')</th>
                                    <th>@lang('common.product')</th>
                                    <th>@lang('common.price')</th>
                                    <th>@lang('common.quantity')</th>
                                    <th>@lang('common.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orderItems as $item)
                                @php
                                
                                $totalAmount += $item->service_amount * $item->qty;
                                $totalshipping += $item->product->shipping_charge;
                                    
                                @endphp
                                <tr>
                                    <td><img style="width: 60px;" class="img-fluid" src="{{ asset($item->product->image) }}" alt=""></td>
                                    <td>
                                        {{ $item->product->product_name }}
                                        <p>@lang('common.service_type'): {{ $item->service->serviceName->service_name }}</p>
                                    </td>
                                    <td>৳{{ $item->service_amount }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>৳{{ $item->service_amount *  $item->qty }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">@lang('common.no_data_found')</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>@lang('common.shipping_address')</p>
                            <p class="m-1"><b>{{ $shipping->fullname??'' }}</b></p>
                            <p class="m-1"><small class="bg-primary text-light rounded p-1">{{ $shipping->type??'' }}</small><small>{{ $shipping->address??'' }}, {{ $shipping->thana->name??'' }}, {{ $shipping->district->name??'' }}, {{ $shipping->division->name??'' }}</small></p>
                            <p class="m-1"><small>{{ $shipping->mobile_no??'' }}</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>@lang('common.billing_address')</p>
                            <p class="m-1"><b>{{ $billing->fullname??'' }}</b></p>
                            <p class="m-1"><small class="bg-primary text-light rounded p-1">{{ $billing->type??'' }}</small><small>{{ $billing->address??'' }}, {{ $billing->thana->name??'' }}, {{ $billing->district->name??'' }}, {{ $billing->division->name??'' }}</small></p>
                            <p class="m-1"><small>{{ $billing->mobile_no??'' }}</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><b>@lang('common.summary')</b></p>
                            <div class="d-flex  justify-content-between mb-1">
                                <span>@lang('common.sub_total')</span> <span>৳{{ $totalAmount }}</span>
                            </div>
                            <div class="d-flex  justify-content-between border-bottom pb-1">
                                <span>@lang('common.delivery_charge')</span> <span>৳{{ $totalshipping }}</span>
                            </div>
                            <div class="d-flex  justify-content-between mb-1">
                                <span><b>@lang('common.total')</b></span> <span>৳{{ $totalAmount + $totalshipping }}</span>
                            </div>
                            <p class="mt-4">@lang('common.paid_by'): <span><b>{{ $order->payment_method_id==1? 'Cash on delivery':'' }}</b></span></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    
@endsection