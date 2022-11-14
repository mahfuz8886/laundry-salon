@extends('frontEnd.layouts.pages.pickupman.master')
@section('parcels', 'active')
@section('title', 'Orders')

@section('content')

    <!-- Main content -->
    <section class="content mt-3">
        <div class="container-fluid">
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

                    <form action="{{ route('pickupman.laundry.orderUpdate') }}" method="post">
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
                        <button type="submit" class="btn btn-primary btn-sm submitBtn" disabled>Submit New Order</button>
                    </form>
                </div>
            </div>
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
    

@endsection

@section('script')
    <script>


        function loadProduct(catId) {
            let categoryId = catId;
            let options = '<option value="">@lang('common.choose')</option>';
            if(categoryId != null) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('pickupman.laundry.getproduct') }}',
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
                    type: 'GET',
                    url: '{{ route('pickupman.laundry.getproductservice') }}',
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
                    url: '{{ route("pickupman.updateqty") }}',
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
            tr.parentNode.removeChild(tr);
        }


    </script>
@endsection