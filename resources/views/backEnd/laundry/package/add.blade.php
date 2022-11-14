@extends('backEnd.layouts.master')
@section('package_section', 'active menu-open')
@section('package', 'active menu-open')
@section('add_package', 'active')
@section('title', 'Add package')

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
        <form action="{{ route('superadmin.laundry.storePackage') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="card">
                    <h3 class="card-header"> Add Package </h3>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-7 offset-2">
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Package Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="package_name" id="" required value="{{ old('package_name') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Package Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="package_amount" id="" required value="{{ old('package_amount') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label"> Package Duration (day) </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="package_duration" id="" required value="{{ old('package_duration') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label"> Max Quantity </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="package_quantity" id="" required value="{{ old('package_quantity') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">@lang('common.image') </label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" value="" id="image" class="form-control" required>
                                </div>             
                            </div>
                            <div class="form-group row">
                                <label for="branch_id" class="col-sm-3 col-form-label">Branch</label>
                                <div class="col-sm-9">
                                    <select name="branch_id" class="form-control select2" id="branch_id" required>
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($allBranch as $branch)
                                        <option value="{{ $branch->id }}" @if (old('branch_id') == $branch->id) selected @endif>{{ $branch->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="">@lang('common.choose')</option>
                                        <option value="1" @if (old('status') == 1) selected @endif>Active</option>
                                        <option value="0" @if (old('status') == 0) selected @endif>Inactive</option>
                                        
                                    </select>
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
                                <th>Max Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="rowContainer">
                            
                            <tr>
                                <td style="min-width: 40px"></td>
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
                                        <option value="">@lang('common.choose')</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control" required>
                                </td>
                            </tr>
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
                        <option value="">@lang('common.choose')</option>
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
        {{-- template area --}}





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