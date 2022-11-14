@extends('backEnd.layouts.master')
@section('package_section', 'active menu-open')
@section('package', 'active menu-open')
@section('manage_package', 'active')
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
        <form action="{{ route('superadmin.laundry.updatePackage') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="card">
                    <h3 class="card-header">Update Package</h3>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-7 offset-2">
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Package Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $package->package_name??'' }}" name="package_name" id="" required>
                                    <input type="hidden" name="row_id" value="{{ $package->id }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Package Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ $package->package_amount??0 }}" name="package_amount" id="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label"> Package Duration (day) </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ $package->duration??'' }}" name="package_duration" id="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label"> Max Quantity </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" value="{{ $package->package_quantity ??'' }}" name="package_quantity" id="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">@lang('common.image') </label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" value="" id="image" class="form-control">
                                    <img class= "backend_image" src="{{ URL($package->image ?? 'public/avatar/avatar.png') }}" alt="">
                                </div>             
                            </div>
                            <div class="form-group row">
                                <label for="branch_id" class="col-sm-3 col-form-label"> Branch </label>
                                <div class="col-sm-9">
                                    <select name="branch_id" class="form-control select2" id="branch_id" required>
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($allBranch as $branch)
                                        <option {{ $branch->id==$package->branch_id?'selected':'' }} value="{{ $branch->id }}">{{ $branch->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label"> Status </label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="">@lang('common.choose')</option>
                                        <option {{ $package->status==1?'selected':'' }} value="1"> Active </option>
                                        <option {{ $package->status==0?'selected':'' }} value="0"> Inactive </option>
                                        
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
                            @if($package->items)
                            @foreach($package->items as $pItem)
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
            let tr = button.closest('tr');
            tr.parentNode.removeChild('tr');
            calculateInvoiceTotal();
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