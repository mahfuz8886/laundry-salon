@extends('frontEnd.layouts.master')
@section('title','Cart page')
@section('content')

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}">@lang('common.home')</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">@lang('common.cart')</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h1 class="text-center">@lang('common.cart_items')</h1>
            </div>
            <div class="mb-10 cart-table">
                <form class="mb-4" action="#" method="post">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">@lang('common.image')</th>
                                <th class="product-name">@lang('common.product_or_package')</th>
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
                            @forelse($items as $item)
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
                                    <td class="text-center">
                                        <a href="javascript:;" onclick="updateCartQuantity({{ $item->id }}, 'rem')" class="text-gray-32 font-size-26">×</a>
                                    </td>
                                    <td class="d-none d-md-table-cell" style="width: 200px">
                                        <a href="{{ url('product/details/'.$item->product->id.'/'.$item->product->slug) }}"><img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ asset($item->product->image) }}" alt="Image Description"></a>
                                    </td>
    
                                    <td data-title="Product">
                                        <a href="{{ url('product/details/'.$item->product->id.'/'.$item->product->slug) }}" class="text-gray-90">{{ $item->product->product_name }}</a>
                                        <p><small>@lang('common.service'): {{ $item->service->serviceName->service_name }}</small></p>
                                    </td>
    
                                    <td data-title="Price">
                                        <span class="">৳{{ $item->service->amount }}</span>
                                    </td>
    
                                    <td data-title="Quantity">
                                        <span class="sr-only">@lang('common.quantity')</span>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="{{$item->quantity}}">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;" onclick="updateCartQuantity({{ $item->id }}, 'dec')">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;" onclick="updateCartQuantity({{ $item->id }}, 'inc')">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </td>
    
                                    <td data-title="Total">
                                        <span class=""> ৳{{ $item->service->amount * $item->quantity }}</span>
                                    </td>
                                </tr>
                                @else
                                <tr class="">
                                    <td class="text-center">
                                        <a href="javascript:;" onclick="updateCartQuantity({{ $item->id }}, 'rem')" class="text-gray-32 font-size-26">×</a>
                                    </td>
                                    <td class="d-none d-md-table-cell" style="width: 200px">
                                        <a href="{{ url('package/details/'.$item->package->id) }}"><img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ URL($item->package->image ?? 'public/avatar/avatar.png') }}" alt="Image Description"></a>
                                    </td>
    
                                    <td data-title="Product">
                                        <a href="{{ url('package/details/'.$item->package->id) }}" class="text-gray-90">{{ $item->package->package_name }}</a>
                                        <p><small>@lang('common.duration'): {{ $item->package->duration }}</small></p>
                                    </td>
    
                                    <td data-title="Price">
                                        <span class="">৳{{ $item->package->package_amount }}</span>
                                    </td>
    
                                    <td data-title="Quantity">
                                        <span class="sr-only">@lang('common.quantity')</span>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="{{$item->quantity}}">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </td>
    
                                    <td data-title="Total">
                                        <span class=""> ৳{{ $item->package->package_amount * $item->quantity }}</span>
                                    </td>
                                </tr> 
                                @endif
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">@lang('common.your_cart_is_empty_now')</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </form>
            </div>

            <div class="mb-8 cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                        <div class="border-bottom border-color-1 mb-3">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">@lang('common.cart_toal')</h3>
                        </div>
                        <table class="table mb-3 mb-md-0">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>@lang('common.sub_total')</th>
                                    <td data-title="Subtotal"><span class="amount">৳{{ $totalAmount }}</span></td>
                                </tr>
                                <tr class="shipping">
                                    <th>@lang('common.shipping')</th>
                                    <td data-title="Shipping">
                                        <span class="amount">৳{{ $shippingTotal }}</span>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>@lang('common.discount')</th>
                                    <td data-title="Discount">
                                        <span class="amount">৳{{ $discountTotal }}</span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>@lang('common.total')</th>
                                    <td data-title="Total"><strong><span class="amount">৳{{ $totalAmount + $shippingTotal - $discountTotal }}</span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('product.checkout') }}" class="btn btn-primary-dark-w ml-md-2 my-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-sm-none d-md-block">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

@endsection

@section('script')

<script>
    function updateCartQuantity(id, action) {
        let cartId = id;
        let operation = action;

        if(cartId != null && operation != null) {
            $.ajax({
                type: "POST",
                url: "{{ route('product.updateCart') }}",
                data: {cartId, operation},
                success: function(data) {
                    if(data.status) {
                        window.location.reload();
                    }else {
                        console.log(data);
                    }
                }
            })
        }
    }
</script>

@endsection