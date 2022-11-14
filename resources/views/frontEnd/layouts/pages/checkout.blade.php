@extends('frontEnd.layouts.master')
@section('title','checkout')
@section('content')

<main id="content" role="main" class="checkout-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}">@lang('common.home')</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('common.checkout')</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">@lang('common.checkout')</h1>
        </div>

        <!-- Accordion -->
        <div id="shopCartAccordion1" class="accordion rounded mb-6">
            <!-- Card -->
            <div class="card border-0">
                <div id="shopCartHeadingTwo" class="alert alert-primary mb-0" role="alert">
                    Have a coupon? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartTwo" aria-expanded="false" aria-controls="shopCartTwo">Click here to enter your code</a>
                </div>
                <div id="shopCartTwo" class="collapse border border-top-0" aria-labelledby="shopCartHeadingTwo" data-parent="#shopCartAccordion1" style="">
                    <form class="js-validate p-5" novalidate="novalidate">
                        <p class="w-100 text-gray-90">If you have a coupon code, please apply it below.</p>
                        <div class="input-group input-group-pill max-width-660-xl">
                            <input type="text" class="form-control" name="name" placeholder="Coupon code" aria-label="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-block btn-dark font-weight-normal btn-pill px-4">
                                    <i class="fas fa-tags d-md-none"></i>
                                    <span class="d-none d-md-inline">Apply coupon</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Accordion -->
        <div class="row">
            <div class="col-lg-7">

                <div class="mb-10 cart-table">
                    <form class="mb-4" action="#" method="post">
                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>@lang('common.image')</th>
                                    <th class="product-name">@lang('common.product')</th>
                                    <th class="product-price">@lang('common.price')</th>
                                    <th class="product-quantity w-lg-15">@lang('common.quantity')</th>
                                    <th class="product-subtotal">@lang('common.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalAmount =0;
                                    $shippingTotal = 0;
                                    $discountTotal = 0;
                                @endphp
                                @foreach($items as $item)
                                @php
                                    if($item->product != NULL) {
                                        $totalAmount += $item->service->amount * $item->quantity;
                                        $shippingTotal += $item->product->shipping_charge;
                                        $discountInfo = App\LaundryDiscount::where('product_id', $item->product_id)
                                                        ->where('customer_id', Session::get('merchantId'))
                                                        ->where('status', 1)
                                                        ->where('product_service_id', $item->service_id)
                                                        ->first();
                                        
                                        if($discountInfo) {
                                            $discountTotal += (($item->service->amount * $item->quantity) * $discountInfo->discount) /100;
                                        }
                                    } else {
                                        $totalAmount += $item->package->package_amount * $item->quantity;
                                    }
                                @endphp
                                @if ($item->product != NULL)
                                <tr class="">
                                    <td class="d-none d-md-table-cell" style="width: 120px">
                                        <a href="{{ url('product/details/'.$item->product->id.'/'.$item->product->slug) }}"><img class="img-fluid p-1 border border-color-1" style="max-width: 70px" src="{{ asset($item->product->image) }}" alt="Image Description"></a>
                                    </td>
    
                                    <td data-title="Product">
                                        <a href="{{ url('product/details/'.$item->product->id.'/'.$item->product->slug) }}" class="text-gray-90">{{ $item->product->product_name }}</a>
                                        <p><small>@lang('common.service'): {{ $item->service->serviceName->service_name }}</small></p>
                                    </td>
    
                                    <td data-title="Price">
                                        <span class="">৳{{ $item->service->amount }}</span>
                                    </td>
    
                                    <td data-title="Quantity">
                                        {{ $item->quantity }}
                                    </td>
    
                                    <td data-title="Total">
                                        <span class=""> ৳{{ $item->service->amount * $item->quantity }}</span>
                                    </td>
                                </tr>
                                @else
                                <tr class="">
                                    <td class="d-none d-md-table-cell" style="width: 120px">
                                        <a href="{{ url('package/details/'.$item->package->id) }}"><img class="img-fluid p-1 border border-color-1" style="max-width: 70px" src="{{ URL($item->package->image ?? 'public/avatar/avatar.png') }}" alt="Image Description"></a>
                                    </td>
    
                                    <td data-title="Product">
                                        <a href="{{ url('package/details/'.$item->package->id) }}" class="text-gray-90">{{ $item->package->package_name }}</a>
                                        <p><small>@lang('common.duration'): {{ $item->package->duration }} </small></p>
                                    </td>
    
                                    <td data-title="Price">
                                        <span class="">৳{{ $item->package->package_amount }}</span>
                                    </td>
    
                                    <td data-title="Quantity">
                                        {{ $item->quantity }}
                                    </td>
    
                                    <td data-title="Total">
                                        <span class=""> ৳{{ $item->package->package_amount * $item->quantity }}</span>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                
                            </tbody>
                        </table>
                    </form>
                </div>

            </div>
            <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                <div class="pl-lg-3 ">
                    <div class="bg-gray-1 rounded-lg">
                        <!-- Order Summary -->
                        <div class="p-4 mb-4 checkout-table">

                            <!-- Title -->
                            <div class=" mb-3">
                                <h3 class="mb-0 font-size-25">@lang('common.shipping&billing_address')</h3>
                            </div>
                            <!-- End Title -->

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <i class="fas fa-map-marker-alt"></i> {{ $shippingAndBilling->shipping->fullname??'not set' }}
                                            <p class="ml-3">
                                                {{ $shippingAndBilling->shipping->address??'' }},{{ $shippingAndBilling->shipping->thana->name??'' }},
                                                {{ $shippingAndBilling->shipping->district->name??'' }},{{ $shippingAndBilling->shipping->division->name??'' }}
                                            </p>
                                        </td>
                                        <td><button type="button" class="btn btn-xs btn-primary shippingBtn">{{ $shippingAndBilling->shipping_id?'Edit':'Add' }}</button></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-map-marker-alt"></i> {{ $shippingAndBilling->billing->fullname??'not set' }}
                                            <p class="ml-3">
                                                @if($shippingAndBilling->billing_id)
                                                {{ $shippingAndBilling->billing->address??'' }},{{ $shippingAndBilling->billing->thana->name??'' }},
                                                {{ $shippingAndBilling->billing->district->name??'' }},{{ $shippingAndBilling->billing->division->name??'' }}
                                                @else
                                                <span>Billing to same address</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td><button type="button" class="btn btn-xs btn-primary billingBtn">Edit</button></td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Title -->
                            <div class=" mb-3">
                                <h3 class="mb-0 font-size-25">@lang('common.order_summary')</h3>
                            </div>
                            <!-- End Title -->

                            <!-- Product Content -->
                            <table class="table">
                                
                                <tbody>
                                    <tr>
                                        <th>@lang('common.sub_total')</th>
                                        <td>৳{{ $totalAmount }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('common.shipping')</th>
                                        <td>৳{{ $shippingTotal }}</td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>@lang('common.discount')</th>
                                        <td data-title="Discount">
                                            <span class="amount">৳{{ $discountTotal }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('common.total')</th>
                                        <td><strong>৳{{ $totalAmount + $shippingTotal - $discountTotal }}</strong></td>
                                    </tr>
                                </tbody>
                                
                            </table>
                            <!-- End Product Content -->
                            <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                <!-- Basics Accordion -->
                                <div id="basicsAccordion1">

                                    <!-- Card -->
                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                        <div class="p-3" id="basicsHeadingThree">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="thirdstylishRadio1" name="stylishRadio" value="1">
                                                <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                                    data-toggle="collapse"
                                                    data-target="#basicsCollapseThree"
                                                    aria-expanded="false"
                                                    aria-controls="basicsCollapseThree">
                                                    Cash on delivery
                                                </label>
                                            </div>
                                        </div>
                                        <div id="basicsCollapseThree" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                            aria-labelledby="basicsHeadingThree"
                                            data-parent="#basicsAccordion1">
                                            <div class="p-4">
                                                Pay with cash upon delivery.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                </div>
                                <!-- End Basics Accordion -->
                            </div>
                            <form action="{{ route('product.placeOrder') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-12 form-group">
                                        <label for="">Order picked date time</label>
                                        <input type="datetime-local" class="form-control" name="picked_time" placeholder="Enter order picked date time" required>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck10" required
                                            data-msg="Please agree terms and conditions."
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">
                                        <label class="form-check-label form-label" for="defaultCheck10">
                                            I have read and agree to the website <a href="#" class="text-blue">terms and conditions </a>
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place order</button>
                            </form>
                        </div>
                        <!-- End Order Summary -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection