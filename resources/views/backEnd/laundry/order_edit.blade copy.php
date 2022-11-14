@extends('backEnd.layouts.master')
@section('laundry_order_section', 'active menu-open')
@section('orders', 'active')
@section('title', 'Orders')

@section('content')

    <!-- Main content -->
    <section class="content mt-3">
        <div class="container-fluid">

            {{-- product --}}
            <div class="card">
                <h3 class="card-header">
                    Edit order
                </h3>
                <div class="card-body">

                    <p>
                        <button type="button" class="btn btn-sm btn-success" onclick="addItem({{ $orderId }})">Add New Item</button>
                    </p>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.image')</th>
                                    <th>@lang('common.product')</th>
                                    <th>@lang('common.price')</th>
                                    <th>@lang('common.quantity')</th>
                                    <th>
                                        @lang('common.total')
                                        <p>(service + shipping - discount)</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orderItems as $item)
                                <tr>
                                    <td><img style="width: 60px;" class="img-fluid" src="{{ asset($item->product->image) }}" alt=""></td>
                                    <td>
                                        {{ $item->product->product_name }}
                                        <p>@lang('common.service_type'): {{ $item->service->serviceName->service_name }}</p>
                                    </td>
                                    <td>৳{{ $item->service_amount }}</td>
                                    <td><input type="number" class="form-control" name="quantity" onkeyup="updateQty({{ $item->id }}, this.value)" value="{{ $item->qty }}"></td>
                                    <td>৳{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">@lang('common.no_data_found')</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('superadmin.laundry.orderEdit') }}" method="post">
                        <input type="hidden" name="rowId" value="{{ $orderId }}">
                        @csrf
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Service Type</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="rowContainer">

                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm submitBtn" disabled >Submit New Order</button>
                    </form>
                </div>
            </div>
            {{-- product --}}

            @php
            //$order_items = App\OrderItem::where('order_id', $orderId)->whereNotNull('package_id')->get();
            //$order_items = App\OrderItem::where('order_id', 17)->whereNotNull('package_id')->with('package')->get();
            //dd($order_items);
            // foreach ($order_items as $order_item) {
            //     echo $order_item->id . "<br>";
            // }
            @endphp

            @if ($order_items)
                <div class="package-edit">
                    {{-- package --}}
                    <div class="card">
                        <h3 class="card-header">
                            Edit Package
                        </h3>
                        @foreach ($order_items as $order_item)
                        <div class="card-body">

                            <div class="row mb-4">
                                <label for="" class="form-label">@lang('common.image') </label>
                                <div class="col-md-3">
                                    <img class= "backend_image" src="{{ URL($order_item->package->image ?? 'public/avatar/avatar.png') }}" alt="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="supplier" class="form-label">Package Name</label>
                                    <input disabled type="text" class="form-control" value="{{ $order_item->package->package_name ?? '' }}" name="package_name" id="" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="supplier" class="form-label">Package Amount</label>
                                    <input disabled type="number" class="form-control" value="{{ $order_item->package->package_amount ?? '' }}" name="package_amount" id="" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="supplier" class="form-label">Package Duration (day)</label>
                                    <input disabled type="number" class="form-control" value="{{ $order_item->package->duration ?? '' }}" name="package_duration" id="" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="supplier" class="form-label"> Max Quantity </label>
                                    <input disabled type="number" class="form-control" value="{{ $order_item->package->package_quantity ?? '' }}" name="package_quantity" id="" required>
                                </div>
                            </div>

                        </div>
                        
                        
                    </div>
                    {{-- package --}}

                    {{-- package items --}}
                    <div class="card">
                        <h3 class="card-header">
                            <p>
                                <button type="button" onclick="addMoreItem()" class="btn btn-sm btn-success">@lang('common.add_more')</button>
                            </p>
                        </h3>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Product</th>
                                            <th>Service Type</th>
                                            <th>Amount</th>
                                            <th>Max Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody class="rowContainer-package">
                                        @if($order_item->package->items)
                                        @foreach($order_item->package->items as $pItem)
                                        <tr>
                                            <td style="min-width: 40px"></td>
                                            <td>
                                                <select name="product[]" id="item" class="form-control productId" required onchange="loadProduct(this.value,this)">
                                                    @php
                                                    $products = App\LaundryProduct::where('status', 'Active')->get();
                                                    @endphp
                                                    <option value="">@lang('common.choose')</option>
                                                    @foreach($products as $item)
                                                    @php
                                                        $pservices = App\ProductService::where('laundry_product_id', $pItem->product_id)->with('serviceName')->get();
                                                    @endphp
                                                    <option {{$pItem->product_id == $item->id? 'selected':''}} value="{{ $item->id }}">{{ $item->product_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="service[]" class="form-control service" required >
                                                    <option value="">@lang('common.choose')</option>
                                                    @if($pservices)
                                                    @foreach($pservices as $svc)
                                                        <option {{ $svc->id == $pItem->service_id? 'selected':'' }} value="{{$svc->id}}">{{ $svc->serviceName->service_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" value="{{$pItem->amount}}" name="amount[]" class="form-control" required>
                                            </td>
                                            <td>
                                                <input type="number" value="{{$pItem->max_qty}}" name="qty[]" class="form-control" required>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>
                            
                            <input type="submit" value="Submit" class="btn btn-primary mt-5">
                        </div>
                    </div>
                    @endforeach {{-- $order_items --}}
                    {{-- package items --}}
                </div>
            @endif

        </div>
    </section>

    {{-- template area --}}
    <template>
        <tr>
          <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
          <td style="min-width: 200px">
            <select name="category[]" id="category" class="form-control" required onchange="loadProduct(this.value)">
              <option value="">@lang('common.choose')</option>
              @php
              $categories = App\LaundryProductCategory::where('status', 'Active')->get();
              @endphp
              @foreach($categories as $item)
              <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
              @endforeach
            </select>
        </td>
          <td style="min-width: 200px">
              <select name="product[]" id="product" class="form-control" required onchange="loadProductService(this.value)">
                <option value="">@lang('common.choose')</option>
                
              </select>
          </td>
          <td style="min-width: 200px">
                <select name="service[]" id="service" class="form-control" required>
                  
                </select>
          </td>
          <td style="min-width: 150px"><input type="number" class="form-control" name="quantity[]" required></td>
        </tr>
    </template>


     {{-- template area for pkg --}}
        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRowPackage(this)"></i></td>
                <td>
                    <select name="product[]" id="item" class="form-control" required onchange="loadProduct(this.value,this)">
                        @php
                        $products = App\LaundryProduct::where('status', 'Active')->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach($products as $item)
                        
                        <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="service[]" class="form-control service" required >
                        
                    </select>
                </td>
                <td>
                    <input type="number" name="amount[]" class="form-control" required>
                </td>
                <td>
                    <input type="number" name="qty[]" class="form-control" required>
                </td>
            </tr>
        </template>
        {{-- template area for pkg --}}
    

@endsection

@section('script')
    <script>


        function loadProduct(catId) {
            let categoryId = catId;
            let options = '<option value="">@lang('common.choose')</option>';
            if(categoryId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.getproduct') }}',
                    data: {categoryId},
                    success: function(data) {
                        if(data != null) {
                            // console.log(data);
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.product_name +' </option>';
                            });

                            $('#product').empty();
                            $('#product').append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }

        function loadProductService(pid) {
            let productId = pid;
            let options = '<option value="">@lang('common.choose')</option>';
            if(productId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.getproductservice') }}',
                    data: {productId},
                    success: function(data) {
                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.service_name.service_name +' </option>';
                            });

                            $('#service').empty();
                            $('#service').append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }


        function updateQty(itemId, qty) {
            if(qty != '') {
                $.ajax({
                    type: "GET",
                    url: '{{ route("superadmin.laundry.updateqty") }}',
                    data: {itemId, qty},
                    success: function(data) {
                        if(data == 1) {
                            window.location.reload();
                        }
                    }
                })
            }
        }

        function addItem(orderId) {
            var temp = document.getElementsByTagName("template")[0];
            var clon = temp.content.cloneNode(true);
            document.querySelector('.rowContainer').appendChild(clon);

            let submitBtn = document.querySelector('.submitBtn');
            submitBtn.disabled = false;
        }

        function deleteRow(button) {
            let tr = button.closest('tr');
            //tr.parentNode.removeChild(tr);
            //tr.parentNode.removeChild('tr');
            tr.remove();
        }


        //package
        function addMoreItem() {
          var temp = document.getElementsByTagName("template")[1];
          var clon = temp.content.cloneNode(true);
          document.querySelector('.rowContainer-package').appendChild(clon);
        }

        function deleteRowPackage(button) {
            let tr = button.closest('tr');
            //tr.parentNode.removeChild('tr');
            tr.remove();
            //calculateInvoiceTotal();
        }

        
        async function loadProduct(product, ref) {
            let productId = product;
            let url = "{{ route('getServices') }}";
            let options = '<option value="">choose</option>';
            
            if(productId) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {product_id: productId},
                    success: (data) => {
                        let selectRowService = $(ref).closest('tr').find('.service');
                        if(data) {
                            data.forEach(element => {
                                options += '<option value="'+ element.id +'">'+ element.service_name.service_name +'</option>';
                            });

                            selectRowService.empty();
                            selectRowService.append(options);
                        }else {
                            selectRowService.empty();
                        }
                    }
                })
            }
        }


    </script>
@endsection