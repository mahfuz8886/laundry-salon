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
                        <h3 class="border-bottom text-uppercase text-primary mb-3">@lang('common.product_details')</h3>
                        
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="product_name">@lang('common.product_name'): </label>
                                    {{$product->product_name }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sku">@lang('common.sku'): </label>
                                    {{ old('sku', $product->sku) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status">@lang('common.status'): </label>
                                    {{$product->status}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="category">@lang('common.category'): </label>
                                    {{ $product->category->cat_name }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price_range">@lang('common.price_range')(@lang('common.website')): </label>
                                    {{ $product->price_range }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="shipping_charge">@lang('common.shipping_charge'): </label>
                                    {{ $product->shipping_charge }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="shipping_charge">@lang('common.type'): </label>
                                    @if ($product->product_show_id == 1)
                                         @lang('common.website') 
                                    @elseif($product->product_show_id == 2)
                                         @lang('common.corporate')
                                    @elseif($product->product_show_id == 3)
                                         @lang('common.both_web_and_corporate')
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="branch_area">@lang('common.branch_area'): </label>
                                    <p>
                                        @foreach($branches as $branch)
                                            <span style="color:rgb(248, 248, 248);padding:4px;background:rgb(48, 47, 47);border-radius:3px">{{ $branch->hub->title }}</span>
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                <label for="description">@lang('common.description')</label>
                                <textarea class="form-control" name="description" id="editor1" placeholder="Additional description write here">{{ $product->description }}</textarea>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.service')</th>
                                            <th>@lang('common.amount')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="appendTo">
                                        
                                        @foreach($services as $value)
                                        <tr>
                                            <td>
                                                {{ $value->serviceName->service_name }}
                                            </td>
                                            <td>
                                                {{ $value->amount }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                    </div>
                </div>
                
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
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