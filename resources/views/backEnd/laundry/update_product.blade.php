@extends('backEnd.layouts.master')
@section('product_section', 'active menu-open')
@section('product', 'active menu-open')
@section('list_product', 'active')
@section('title', 'Add Product')

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box-content">
                        <h3 class="border-bottom text-uppercase text-primary mb-3">@lang('common.update_product')</h3>
                        <form action="{{ route('superadmin.laundry.updateProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="product_name">@lang('common.product_name')</label>
                                    <input type="text" value="{{ old('product_name', $product->product_name) }}" name="product_name" class="form-control" id="product_name" placeholder="Product name" required>
                                    <input type="hidden" name="row_id" value="{{ $product->id }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sku">@lang('common.sku')</label>
                                    <input type="text" value="{{ old('sku', $product->sku) }}" name="sku" class="form-control" id="sku" placeholder="Product sku">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status">@lang('common.status')</label>
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="">@lang('common.select')</option>
                                        <option {{$product->status=='Active'? 'selected':''}} value="Active">@lang('common.active')</option>
                                        <option {{$product->status=='Inactive'? 'selected':''}} value="Inactive">@lang('common.inactive')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="category">@lang('common.category')</label>
                                    <select id="category" class="form-control" name="category" required>
                                        <option value="">@lang('common.select')</option>
                                        @foreach($categories as $categorie)
                                            <option {{$product->category_id==$categorie->id? 'selected':''}} value="{{ $categorie->id }}">{{ $categorie->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price_range">@lang('common.price_range')(@lang('common.website'))</label>
                                    <input type="text" value="{{ old('price_range', $product->price_range) }}" name="price_range" class="form-control" id="price_range" placeholder="Ex: 20-50" required>
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label for="shipping_charge">@lang('common.shipping_charge')</label>
                                    <input type="number" value="{{ old('shipping_charge', $product->shipping_charge) }}" name="shipping_charge" class="form-control" id="shipping_charge" placeholder="Shipping charge" required>
                                </div> -->
                                <div class="form-group col-md-4">
                                    <label for="product_show_id">@lang('common.type')</label>
                                    <select id="product_show_id" class="form-control select2" name="product_show_id" required>
                                        <option value="">@lang('common.select')</option>
                                        <option value="1" @if (old('product_show_id', $product->product_show_id) == 1) selected @endif> @lang('common.website') </option>
                                        <option value="2" @if (old('product_show_id', $product->product_show_id) == 2) selected @endif> @lang('common.corporate') </option>
                                        <option value="3" @if (old('product_show_id', $product->product_show_id) == 3) selected @endif> @lang('common.both_web_and_corporate') </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="branch_id">@lang('common.branch_area')</label>
                                    <select id="branch_id" class="form-control select2" name="branch_id[]" multiple required>
                                        <option value="">@lang('common.select')</option>
                                        @foreach($allBranch as $hub)
                                            @foreach($product->branch as $branch)
                                                @if($hub->id==$branch->laundry_branch_id)
                                                    {{$selected='selected'}}
                                                @endif
                                            @endforeach

                                            <option {{$selected??''}} value="{{ $hub->id }}">{{ $hub->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                <label for="description">@lang('common.description')</label>
                                <textarea class="form-control" name="description" id="editor1" placeholder="Additional description write here">{{ old('description', $product->description) }}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    
                                    <div class="image-uploader mt-5">
                                        <img style="width: 100%;height:100%" src="{{ asset($product->image) }}" alt="" id="preview">
                                        <input type="file" name="filename" id="profile">
                                        <label for="profile" class="selectImageBtn"><i class="fa fa-camera"></i></label>
                                    </div>
                                    <h6 class="text-center">@lang('common.upload_product_image')</h6>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="service_and_amount">@lang('common.service_and_amount')</label>
                                <p><button type="button" onclick="addNew()" class="btn btn-sm btn-primary">@lang('common.add_more')</button></p>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">@lang('common.action')</th>
                                            <th>@lang('common.service')</th>
                                            <th>@lang('common.amount')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="appendTo">
                                        @if($product->service)
                                            @foreach($product->service as $value)
                                                <tr>
                                                    <td><i class="fa fa-trash text-danger trash"></i></td>
                                                    <td>
                                                        <select name="service[]" id="" class="form-control" required>
                                                            <option value="">@lang('common.select')</option>
                                                            @foreach($services as $service)
                                                                
                                                                <option {{$value->laundry_service_id==$service->id? 'selected':''}} value="{{ $service->id }}">{{ $service->service_name }}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="amount[]" id="" value="{{ $value->amount }}" class="form-control" required>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="service_and_amount">Service cost</label>
                                <p><button type="button" onclick="addNewCost()" class="btn btn-sm btn-primary">@lang('common.add_more')</button></p>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">@lang('common.action')</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody class="rowContainer">
                                        @if($costs)
                                        @foreach($costs as $key => $cost)
                                        <tr>
                                            <td>@if($key > 0) <i class="fa fa-trash text-danger trash"></i> @endif</td>
                                            <td>
                                                <select name="item[]" id="item" class="form-control" required onchange="getBuyAndSalePrice(this.value, this)">
                                                    @php
                                                    $branches = App\helper\CustomHelper::getUserBranch();
                                                    $items = App\InventoryLog::groupBy('item_id')
                                                            ->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
                                                            ->where('in_out', 'In');
                                                            if($branches != null) {
                                                                $items = $items->whereIn('branch_id', $branches);
                                                            }
                                                    $items = $items->with('item')->with('unit')->get();
                                                    @endphp
                                                    <option value="">@lang('common.choose')</option>
                                                    @foreach($items as $item)
                                                    <option {{$cost->item_id==$item->item_id? 'selected':''}} value="{{ $item->item_id }},{{ $item->branch_id }}">{{ $item->item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" value="{{ $cost->qty }}" name="qty[]" class="form-control" required>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            
                            <button type="submit" class="btn btn-success my-5">@lang('common.submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td>
                    <select name="item[]" id="item" class="form-control" required onchange="getBuyAndSalePrice(this.value, this)">
                        @php
                        $branches = App\helper\CustomHelper::getUserBranch();
                        $items = App\InventoryLog::groupBy('item_id')
                                ->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
                                ->where('in_out', 'In');
                                if($branches != null) {
                                    $items = $items->whereIn('branch_id', $branches);
                                }
                        $items = $items->with('item')->with('unit')->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach($items as $item)
                        <option value="{{ $item->item_id }},{{ $item->branch_id }}">{{ $item->item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="qty[]" class="form-control" required>
                </td>
            </tr>
        </template>

    </section>
@endsection

@section('script')
    <script>
    
        function addNewCost() {
          var temp = document.getElementsByTagName("template")[0];
          var clon = temp.content.cloneNode(true);
          document.querySelector('.rowContainer').appendChild(clon);
        }
    
        //add new experience
        function addNew() {
            const newRow = '<tr>' +
                '<td><i class="fa fa-trash text-danger trash"></i></td>' +
                '<td>'+
                    '<select name="service[]" id="" class="form-control" required>'+
                        '<option value="">@lang("common.select")</option>'+
                        '@foreach($services as $service)'+
                        '<option value="{{ $service->id }}">{{ $service->service_name }}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>' +
                '<td><input class="form-control" type="text" name="amount[]" required></td>' +
                '</tr>';

            $('.appendTo').append(newRow);
        }

        $('body').on('click', '.trash', function () {
            $(this).closest('tr').remove();
        });


        //image preview
        const profile = document.querySelector('#profile');
        const preview = document.querySelector('#preview');
        profile.onchange = evt => {
            const [file] = profile.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }

    </script>
@endsection