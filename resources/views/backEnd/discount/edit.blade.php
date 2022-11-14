@extends('backEnd.layouts.master')
@section('discount_section', 'active menu-open')
@section('laundry_discount', 'menu-open')
@section('manage_ldiscount', 'active')
@section('title', 'add discount')
@section('content')
    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="container-fluid">
            <form action="{{ route('superadmin.laundry.updateDiscount') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <b>@lang('common.update_discount')</b>
                    </div>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="customerType">Customer Type</label>
                                <select class="form-control" id="customerType" name="customer_type" required>
                                    <option value="">@lang('common.select')</option>
                                    <option {{ $discounts[0]->customer_type=='Regular'?'selected':'' }} value="Regular">@lang('common.regular')</option>
                                    <option {{ $discounts[0]->customer_type=='Corporate'?'selected':'' }} value="Corporate">@lang('common.corporate')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="users"> Customers </label>
                                <select class="form-control select2" name="customer_id" id="customers" required>
                                    <option value="">@lang('common.select')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status"> Status </label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="">@lang('common.select')</option>
                                    <option {{ $discounts[0]->status==1?'selected':'' }} value="1">@lang('common.active')</option>
                                    <option {{ $discounts[0]->status==0?'selected':'' }} value="0">@lang('common.inactive')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <p>
                    <button type="button" onclick="addMoreItem()" class="btn btn-sm btn-success">@lang('common.add_more')</button>
                </p>
                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Product</th>
                                <th>Service Type</th>
                                <th>Discount(%)</th>
                            </tr>
                        </thead>
                        <tbody class="rowContainer">

                            @foreach ($discounts as $discount)
                            <tr>
                                <td style="min-width: 40px"></td>
                                <td>
                                    <input type="hidden" name="id[]" class="form-control" value="{{ $discount->id }}" id="" required>
                                    <select name="product[]" id="item" class="form-control" required
                                        onchange="loadProduct(this.value,this)">
                                        @php
                                            $products = App\LaundryProduct::where('status', 'Active')->get();
                                        @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach ($products as $item)
                                        @php
                                            $pservices = App\ProductService::where('laundry_product_id', $discount->product_id)->with('serviceName')->get();
                                        @endphp
                                            <option {{ $item->id==$discount->product_id?'selected':'' }} value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="service[]" class="form-control service" required>
                                        <option value="">@lang('common.choose')</option>
                                        @if($pservices)
                                        @foreach($pservices as $svc)
                                            <option {{ $svc->id == $discount->product_service_id? 'selected':'' }} value="{{$svc->id}}">{{ $svc->serviceName->service_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="discount[]" class="form-control" value="{{ $discount->discount }}" id="discount" required>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>


                <button type="submit" class="btn btn-primary mt-4">@lang('common.submit')</button>
            </form>
        </div>
    </section>


    {{-- template area --}}
    <template>
        <tr>
            <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
            <td>
                <select name="product[]" id="item" class="form-control" required
                    onchange="loadProduct(this.value,this)">
                    @php
                        $products = App\LaundryProduct::where('status', 'Active')->get();
                    @endphp
                    <option value="">@lang('common.choose')</option>
                    @foreach ($products as $item)
                        <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="service[]" class="form-control service" required>
                    <option value="">@lang('common.choose')</option>
                </select>
            </td>
            <td>
                <input type="number" name="discount[]" class="form-control" id="discount" required>
            </td>
        </tr>
    </template>
    {{-- template area --}}

@endsection

@section('script')
    <script>

        // Get customer
        $('body').on('change', '#customerType', function() {
                var userType = $('#customerType').val();
                var options = '<option value=""> Select user </option>';
                var selected = '{{ old('customer_id', $discounts[0]->customer_id) }}';
                $.ajax({
                    method: "POST",
                    url: "{{ route('getCustomers') }}",
                    data: {
                        'type': userType
                    },
                }).done(function(response) {
                    response.forEach(function(item, i) {
                        if(selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item.firstName +
                            ' </option>';
                        }else {
                            options += '<option value="' + item.id + '"> ' + item.firstName +
                            ' </option>';
                        }
                        
                    });
                    $('#customers').html(options);
                    // $('#customerType').trigger('change');
                });
            })

            $('#customerType').trigger('change');


        function addMoreItem() {
            var temp = document.getElementsByTagName("template")[0];
            var clon = temp.content.cloneNode(true);
            document.querySelector('.rowContainer').appendChild(clon);
        }

        function deleteRow(button) {
            // let tr = button.closest('tr');
            // tr.parentNode.removeChild('tr');
            // calculateInvoiceTotal();
            // console.log('asdfghj');
            let tr = button.closest('tr');
            //tr.parentNode.removeChild('tr');
            tr.remove();
            calculateInvoiceTotal();
            console.log(tr);
        }

        async function loadProduct(product, ref) {
            let productId = product;
            let url = "{{ route('getServices') }}";
            let options = '<option value="">choose</option>';
            if (productId) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        product_id: productId
                    },
                    success: (data) => {
                        let selectRowService = $(ref).closest('tr').find('.service');
                        if (data) {
                            data.forEach(element => {

                                options += '<option value="' + element.id + '">' + element
                                    .service_name.service_name + '</option>';
                            });

                            selectRowService.empty();
                            selectRowService.append(options);
                        } else {
                            selectRowService.empty();
                        }
                    }
                })
            }
        }

    </script>
@endsection
