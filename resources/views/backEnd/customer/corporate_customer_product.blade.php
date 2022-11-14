@extends('backEnd.layouts.master')
@section('customer', 'active menu-open')
@section('customer_manage', 'active')
@section('title', 'Product Add')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('superadmin.store_corporate_customer_product', ['customer_id' => $id]) }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="card">
                    <h3 class="card-header"> Product Discount </h3>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-7 offset-2">
                                <div class="form-group row">
                                    <label for="supplier" class="col-sm-3 col-form-label"> Issue Date </label>
                                    <div class="col-sm-9">
                                        <input type="date" name="issue_date" value="{{ old('issue_date', $date[0]->issue_date ?? '') }}"
                                            class="flatDate form-control flatpickr-input">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 offset-2">
                                <div class="form-group row">
                                    <label for="supplier" class="col-sm-3 col-form-label"> Validate Till </label>
                                    <div class="col-sm-9">
                                        <input type="date" name="validate_date" value="{{ old('validate_date', $date[0]->validate_date ?? '') }}"
                                            class="flatDate form-control flatpickr-input">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- purchase area --}}
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
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody class="rowContainer">

                            @forelse ($corporate_products as $corporate_product)
                            <tr>
                                <td style="min-width: 40px"></td>
                                <td>
                                    <input type="hidden" id="id" name="id[]" value="{{ $corporate_product->id }}">
                                    <select name="product[]" id="item" class="form-control product" required
                                        onchange="loadProduct(this.value,this)">
                                        @php
                                            $products = App\LaundryProduct::where('status', 'Active')
                                                ->where('product_show_id', 2)
                                                ->orWhere('product_show_id', 3)
                                                ->get();
                                        @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach ($products as $item)
                                        @php
                                            $pservices = App\ProductService::where('laundry_product_id', $corporate_product->product_id)->with('serviceName')->get();
                                        @endphp
                                            <option {{$corporate_product->product_id == $item->id? 'selected':''}} value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="service[]" class="form-control service" required onchange="loadAmount(this.value,this)">
                                        <option value="">@lang('common.choose')</option>
                                        @if($pservices)
                                        @foreach($pservices as $svc)
                                            <option {{ $svc->id == $corporate_product->service_id? 'selected':'' }} value="{{$svc->laundry_service_id}}">{{ $svc->serviceName->service_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control amount" value="{{ $corporate_product->amount ?? '' }}" required>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    {{-- <td colspan="4" class="text-center"> No Data Found. </td> --}}
                                </tr>
                            @endforelse

                            {{-- @if ()
                            <tr>
                                <td style="min-width: 40px"></td>
                                <td>
                                    <select name="product[]" id="item" class="form-control select2" required
                                        onchange="loadProduct(this.value,this)">
                                        @php
                                            $products = App\LaundryProduct::where('status', 'Active')
                                                ->where('product_show_id', 2)
                                                ->orWhere('product_show_id', 3)
                                                ->get();
                                        @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="service[]" class="form-control service select2" required>
                                        <option value="">@lang('common.choose')</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control" required>
                                </td>
                            </tr>
                            @endif --}}

                        </tbody>

                    </table>
                </div>

                <input type="submit" value="Submit" class="btn btn-primary mt-5">
            </div>
        </form>

        {{-- template area --}}
        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td>
                    <select name="product[]" id="item" class="form-control product" required
                        onchange="loadProduct(this.value,this)">
                        @php
                            $products = App\LaundryProduct::where('status', 'Active')
                                ->where('product_show_id', 2)
                                ->orWhere('product_show_id', 3)
                                ->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach ($products as $item)
                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="service[]" class="form-control service" required onchange="loadAmount(this.value,this)">
                        <option value="">@lang('common.choose')</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="amount[]" class="form-control amount" required>
                </td>
            </tr>
        </template>
        {{-- template area --}}





    </section>
@endsection

@section('script')
    <script>
        function addMoreItem() {
            var temp = document.getElementsByTagName("template")[0];
            var clon = temp.content.cloneNode(true);
            document.querySelector('.rowContainer').appendChild(clon);
            $('.select2').select2();
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
                        console.log(data);
                        if (data) {
                            data.forEach(element => { 

                                options += '<option value="' + element.laundry_service_id + '">' + element
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

        async function loadAmount(service, ref) {
            let product = $(ref).closest('tr').find('.product');
            let product_id = product.val();
            let url = "{{ route('getServicesAmount') }}";
            $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        service_id: service
                    },
                    success: (data) => {
                        let amount = $(ref).closest('tr').find('.amount');
                        if(data) {
                            let val = data.amount;
                            amount.empty();
                            amount.val(val);
                        } else {
                            amount.empty();
                        }
                    }
                })
        }
    </script>
@endsection
