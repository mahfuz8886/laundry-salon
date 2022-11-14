@extends('backEnd.layouts.master')
@section('salon_order_section', 'active menu-open')
@section('orders', 'active')
@section('title', 'Orders')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="card">
                <div class="card-body">
                    {{-- @foreach ($bookings as $item)
                        @foreach ($item->bookingitem as $it)
                            <ul>
                                <li> {{ $it->id }} </li>
                                <li> {{ $it->employee->name ?? '' }} </li>
                                {{ $it->total }}
                            </ul>
                        @endforeach
                    @endforeach --}}
                    @php 
                    $status = App\ParcelType::where('id', $booking->status)->first(); 
             
                    $totalAmount = 0;
                    $totalDiscount = 0;
                    @endphp
                    <p><span>@lang('common.booking_id'): <b>{{ $booking->id }}</b></span>, <span>@lang('common.status'): <b>{{ $status->title }}</b></span></p>
                    
                    <div class="py-1">
                        
                        <form class="mb-3" action="{{ route('superadmin.salon.orderUpdate', $booking->id) }}" method="post">
                            @csrf
                            @if($booking->status == 1 || ($booking->status != 12 && $booking->status != 9))
                                <a onclick="return confirm('Are you sure want to cancel order?')" class="btn btn-danger btn-sm" href="{{ route('superadmin.salon.ordercancel', $booking->id) }}">@lang('common.cancel')</a>
                            @endif
                            @if($booking->status == 1)
                                <input type="hidden" name="status" value="10">
                                <input type="submit" value="Confirm" class="btn btn-primary btn-sm">
                            @endif

                            @if($booking->status == 10) 
                                {{-- <div class="form-row">
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
                                </div> --}}
                                <input type="hidden" name="status" value="11">
                                <input type="submit" value="Processing" class="btn btn-primary btn-sm">
                            @endif

                            {{-- work complete order --}}
                            @if($booking->status == 11)
                                <input type="hidden" name="status" value="12">
                                {{-- purchase area --}}
                                
                                <input type="submit" value="Work completed" class="btn btn-primary btn-sm">
                            @endif

                        </form>

                        <p>
                            @if($booking->status != 1)
                            <span>{{$status->title}} on </span><b>@php echo date('F Y h:i:s a',strtotime($booking->updated_at)) @endphp</b>
                            @endif
                        </p>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-dark"><b>@lang('common.items')</b></h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.image')</th>
                                            <th>@lang('common.service')</th>
                                            <th>@lang('common.price')</th>
                                            <th>@lang('common.space')</th>
                                            <th>@lang('common.total')</th>
                                            <th>@lang('common.working_date')</th>
                                            <th>@lang('common.schedule')</th>
                                            <th>@lang('common.employee')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bookingItems as $item)
                                        @php
                                        $totalAmount += $item->space_amount;
                                        $totalDiscount += $item->discount;
                                        @endphp
                                        <tr>
                                            <td>
                                                <img style="width: 60px;" class="img-fluid" src="{{ asset($item->service->category->image) }}" alt="">
                                            </td>
                                            <td>
                                                {{ $item->service->service_name }}
                                            </td>
                                            <td>৳{{ $item->space_amount }}</td>
                                            <td>{{ $item->space }}</td>
                                            <td>৳{{ $item->space *  $item->space_amount }}</td>
                                            <td>{{ date('F Y', strtotime($item->booking_date)) }}</td>
                                            <td>
                                                @php
                                                if ($item->time_schedule) {
                                                    $tempSchedul = explode('-', $item->time_schedule);
                                                    echo date('h:i a', strtotime($tempSchedul[0])).' - '.date('h:i a', strtotime($tempSchedul[1]));
                                                }
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                 $employee = App\Employee::where('id', $item->employee_id)->first();   
                                                @endphp
                                                {{ $employee->name??'Unknown' }}
                                            </td>
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>@lang('common.customer_address')</p>
                            <p class="m-1"><b>{{ $booking->address->fullname??'' }}</b></p>
                            <p class="m-1"><small class="bg-primary rounded p-1">{{ $booking->address->type??'' }}</small><small>{{ $booking->address->address??'' }}, {{ $booking->address->thana->name??'' }}, {{ $booking->address->district->name??'' }}, {{ $booking->address->division->name??'' }}</small></p>
                            <p class="m-1"><small>{{ $booking->address->mobile_no??'' }}</small></p>
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
                                <span>@lang('common.discount')</span> <span>৳{{ $totalDiscount }}</span>
                            </div>
                            <div class="d-flex  justify-content-between mb-1">
                                <span><b>@lang('common.total')</b></span> <span>৳{{ $totalAmount - $totalDiscount }}</span>
                            </div>
                            <p class="mt-4">@lang('common.paid_by'): <span><b>{{ $booking->payment_method_id==1? 'Cash':'' }}</b></span></p>
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
                        $items = App\SalonInventoryLog::groupBy('item_id')->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
                        ->where('in_out', 'In');
                                                        if($branches != null) {
                                                            $items = $items->whereIn('branch_id', $branches);
                                                        }
                                                        $items = $items->with('item')->with('unit')->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach($items as $item)
                        <option value="{{ $item->item_id }},{{ $item->branch_id }}">{{ $item->item->name }} ({{$item->item->sum}})</option>
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
                    url: '{{ route('superadmin.salon.getItemPrices') }}',
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