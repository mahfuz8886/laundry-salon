@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('orders', 'active')
@section('title', 'Orders')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <b>@lang('common.order_details')</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.image')</th>
                                    <th>@lang('common.product_or_package')</th>
                                    <th>@lang('common.price')</th>
                                    <th>@lang('common.quantity')</th>
                                    <th>@lang('common.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $shippingTotal = 0;    
                                    $amountTotal = 0;    
                                    $discountTotal = 0;
                                    $package_tot = 0;
                                    $total = 0;    
                                @endphp
                                @forelse($orderItems as $item)
                                @php
                                    if($item->product_id != NULL) {
                                        $shippingTotal += $item->shipping_charge;
                                        $amountTotal += $item->service_amount * $item->qty;
                                        $discountTotal += $item->service_discount;
                                    } else{
                                        $package_tot = $item->package->package_amount * $item->qty;
                                    }
                                    $total = $shippingTotal + $amountTotal + $package_tot - $discountTotal;
                                @endphp
                                @if ($item->product_id != NULL)
                                <tr>
                                    <td><img style="width: 60px;" src="{{ asset($item->product->image) }}" alt=""></td>
                                    <td>
                                        {{ $item->product->product_name }}
                                        <p>@lang('common.service'): {{ $item->service->serviceName->service_name }}</p>
                                    </td>
                                    <td>৳{{ $item->service_amount }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>৳{{ $item->service_amount * $item->qty }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td><img style="width: 60px;" src="{{ URL($item->package->image ?? 'public/avatar/avatar.png') }}" alt=""></td>
                                    <td>
                                        {{ $item->package->package_name }}
                                        <p>@lang('common.duration'): {{ $item->package->duration }}</p>
                                    </td>
                                    <td>৳{{ $item->package->package_amount }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>৳{{ $item->package->package_amount * $item->qty }}</td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"><b>Shipping charge: </b></td>
                                    <td>৳{{ $shippingTotal }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><b>Discount: </b></td>
                                    <td>৳{{ $discountTotal }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><b>Grand total: </b></td>
                                    <td>৳{{ $total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
