@extends('backEnd.layouts.master')
@section('laundry_order_section', 'active menu-open')
@section('orders', 'active')
@section('title', 'Orders')

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
                    $totalDiscount = 0;

                    // pickupman
                    $pickupman = App\Pickupman::where('status', 1)->get();

                    // deliveryman
                    $deliveryman = App\Deliveryman::where('status', 1)->get();

                    @endphp
                    <p><span>@lang('common.order_id'): <b>{{ $order->id }}</b></span>, <span>@lang('common.status'): <b>{{ $status->title }}</b></span></p>
                    
                    <div class="py-1">
                        
                        <form class="mb-3" action="{{ route('superadmin.laundry.orderUpdate', $order->id) }}" method="post">
                            @csrf
                            @if($order->order_status == 1 || ($order->order_status != 4 && $order->order_status != 9))
                                <a onclick="return confirm('Are you sure want to cancel order?')" class="btn btn-danger btn-sm" href="{{ route('superadmin.laundry.ordercancel', $order->id) }}">@lang('common.cancel')</a>
                                {{-- <a onclick="return confirm('Are you sure want to hold order?')" class="btn btn-warning btn-sm" href="{{ route('superadmin.laundry.orderhold', $order->id) }}">@lang('common.hold_order')</a> --}}
                            @endif
                            @if($order->order_status == 1)
                                <input type="hidden" name="status" value="10">
                                <input type="submit" value="Confirm" class="btn btn-primary btn-sm">
                            @endif

                            {{-- processing order --}}
                            @if($order->order_status == 10) 
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">@lang('common.pickupman')</label>
                                        <select name="pman" id="" required class="form-control select2">
                                            <option value="">@lang('common.select')</option>
                                            @foreach($pickupman as $man)
                                            <option {{$order->pman_id==$man->id? 'selected':''}} value="{{ $man->id }}">{{ $man->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($order->pman_id)
                                    <input type="hidden" name="status" value="2">
                                    <input type="submit" value="Picked" class="btn btn-primary btn-sm">
                                @else
                                    <input type="hidden" name="status" value="10">
                                    <input type="submit" value="Pickupman assign" class="btn btn-primary btn-sm">
                                @endif
                            @endif

                            {{-- work complete order --}}
                            @if($order->order_status == 11)
                                <input type="hidden" name="status" value="12">
                                {{-- purchase area --}}
                                
                                <input type="submit" value="Work completed" class="btn btn-primary btn-sm">
                            @endif

                            @if($order->order_status == 2)

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">@lang('common.employee')</label>
                                        <select name="employee[]" multiple id="" required class="form-control select2">
                                            <option value="">@lang('common.select')</option>
                                            @php
                                            $employees = App\Employee::where('status', 1)->get();
                                            @endphp
                                            @foreach($employees as $item)
                                            <option  value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="11">
                                <input type="submit" value="Processing" class="btn btn-primary btn-sm">
                            @endif

                            @if($order->order_status == 12)
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">@lang('common.deliveryman')</label>
                                        <select name="dman" id="" required class="form-control select2">
                                            <option value="">@lang('common.select')</option>
                                            @foreach($deliveryman as $man)
                                            <option {{$order->dman_id==$man->id? 'selected':''}} value="{{ $man->id }}">{{ $man->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($order->dman_id)
                                    <input type="hidden" name="status" value="4">
                                    <input type="submit" value="Delivered" class="btn btn-primary btn-sm">
                                @else
                                    <input type="hidden" name="status" value="12">
                                    <input type="submit" value="Deliveryman assign" class="btn btn-primary btn-sm">
                                @endif
                                
                            @endif

                        </form>

                        <p>
                            @if($order->order_status != 1)
                            <span>{{$status->title}} on </span><b>@php echo date('F Y h:i:s a',strtotime($order->updated_at)) @endphp</b>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            @php
                            $orderEmps = App\LaundryOrderEmployee::where('order_id', $order->id)->with('employee')->get();
                            @endphp
                            <p class="text-dark">@lang('common.employee_info')</p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.order_id')</th>
                                            <th>@lang('common.employee')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orderEmps as $item)
                                        
                                        <tr>
                                            <td>{{ $item->order_id }}</td>
                                            <td>{{ $item->employee->name }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center">@lang('common.no_data_found')</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
                                    <th>@lang('common.product_or_package')</th>
                                    <th>@lang('common.price')</th>
                                    <th>@lang('common.quantity')</th>
                                    <th>@lang('common.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orderItems as $item)
                                @php
                                    if($item->product != NULL) {
                                        $totalAmount += $item->service_amount * $item->qty;
                                        $totalshipping += $item->product->shipping_charge;
                                        $totalDiscount += $item->service_discount;
                                    } else {
                                        $totalAmount += $item->package->package_amount * $item->qty;
                                    }
                                @endphp
                                @if ($item->product != NULL)
                                <tr>
                                    <td><img style="width: 60px;" class="img-fluid" src="{{ asset($item->product->image) }}" alt=""></td>
                                    <td>
                                        {{ $item->product->product_name }}
                                        <p>@lang('common.service_type'): {{ $item->service->serviceName->service_name??'' }}</p>
                                    </td>
                                    <td>৳{{ $item->service_amount }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>৳{{ $item->service_amount *  $item->qty }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td><img style="width: 60px;" class="img-fluid" src="{{ URL($item->package->image ?? 'public/avatar/avatar.png') }}" alt=""></td>
                                    <td>
                                        {{ $item->package->package_name }}
                                        <p>
                                            @lang('common.duration'): {{ $item->package->duration . " Days" ??'' }} <br>
                                            @lang('common.quantity'): {{ $item->package->package_quantity ??'' }}
                                        </p>
                                    </td>
                                    <td>৳{{ $item->package->package_amount }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>৳{{ $item->package->package_amount *  $item->qty }}</td>
                                </tr>
                                @endif
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
                            <p class="m-1"><small class="bg-primary rounded p-1">{{ $shipping->type??'' }}</small><small>{{ $shipping->address??'' }}, {{ $shipping->thana->name??'' }}, {{ $shipping->district->name??'' }}, {{ $shipping->division->name??'' }}</small></p>
                            <p class="m-1"><small>{{ $shipping->mobile_no??'' }}</small></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>@lang('common.billing_address')</p>
                            <p class="m-1"><b>{{ $billing->fullname??'' }}</b></p>
                            <p class="m-1"><small class="bg-primary rounded p-1">{{ $billing->type??'' }}</small><small>{{ $billing->address??'' }}, {{ $billing->thana->name??'' }}, {{ $billing->district->name??'' }}, {{ $billing->division->name??'' }}</small></p>
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
                            <div class="d-flex  justify-content-between">
                                <span>@lang('common.delivery_charge')</span> <span>৳{{ $totalshipping }}</span>
                            </div>
                            <div class="d-flex  justify-content-between pb-1">
                                <span>@lang('common.discount')</span> <span>৳{{ $totalDiscount }}</span>
                            </div>
                            <div class="d-flex  justify-content-between mb-1">
                                <span><b>@lang('common.total')</b></span> <span>৳{{ $totalAmount + $totalshipping - $totalDiscount }}</span>
                            </div>
                            <p class="mt-4">@lang('common.paid_by'): <span><b>{{ $order->payment_method_id==1? 'Cash on delivery':'' }}</b></span></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- template area --}}
        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td style="min-width: 200px">
                    <select name="item[]" id="item" class="form-control select2" required onchange="getBuyAndSalePrice(this.value,this)">
                        @php
                        $branches = App\helper\CustomHelper::getUserBranch();
                        $items = App\InventoryLog::groupBy('item_id')->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
                                    ->where('in_out', 'In');
                                                        if($branches != null) {
                                                            $items = $items->whereIn('branch_id', $branches);
                                                        }
                                                        $items = $items->with('item')->with('unit')->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach($items as $item)
                        <option value="{{ $item->item_id }},{{ $item->branch_id }}">{{ $item->item->name }} ({{$item->sum}})</option>
                        @endforeach
                    </select>
                </td>
                <td style="min-width: 150px"><input type="number" step="any" class="form-control buyPrice" name="buy_price[]" required></td>
                <td style="min-width: 150px"><input type="number" step="any" class="form-control saleprice" name="sale_price[]" required></td>
                <td style="min-width: 150px"><input type="number" class="form-control quantity" name="quantity[]" required></td>
            </tr>
        </template>
        {{-- template area --}}

        </div>
    </section>
@endsection

@section('script')
    <script>
        function addMoreItem() {
          var temp = document.getElementsByTagName("template")[0];
          var clon = temp.content.cloneNode(true);
          document.querySelector('.rowContainer').appendChild(clon);
        }

        function deleteRow(button) {
            let tr = button.closest('tr');
            tr.parentNode.removeChild(tr);
        }

        function getBuyAndSalePrice(item, ref) {
            let itemId = item;
            let buy = $(ref).closest('tr').find('.buyPrice');
            let sale = $(ref).closest('tr').find('.saleprice');
            
            
            if(itemId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.getItemPrices') }}',
                    data: {itemId},
                    success: function(data) {
                        if(data != null) {
                            // console.log(data);
                           buy.val(data.buy_price);
                           sale.val(data.sale_price);
                        }
                    }
                })
            }
        }
    </script>
@endsection