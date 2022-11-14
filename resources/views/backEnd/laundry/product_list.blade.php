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
                        <p class="text-right">
                            <a href="{{ route('superadmin.laundry.addProduct') }}" class="btn btn-sm btn-primary">@lang('common.add_new_product')</a>
                        </p>
                        <div class="card">
                            <div class="card-header">
                              <h5 class="text-primary border-bottom"><b>@lang('common.product_list')</b></h5>
                              <form method="GET" action="">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control select2">
                                                    <option value="">@lang('common.select')</option>
                                                    <option @if (Request::get('status')) {{ $_GET['status'] == 'Active' ? 'selected':''  }} @endif value="Active">Active</option>
                                                    <option @if (Request::get('status')) {{ $_GET['status'] == 'Inactive' ? 'selected':''  }} @endif value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" name="name" value="{{ $_GET['name']??'' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label><br>
                                                <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body" style="padding: 0px !important">
                                <div class="teble-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="pl-4">@lang('common.action')</th>
                                                <th>@lang('common.status')</th>
                                                <th>@lang('common.id')</th>
                                                <th>@lang('common.product_name')</th>
                                                <th>@lang('common.category_name')</th>
                                                <th>@lang('common.sku')</th>
                                                <th>@lang('common.image')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                                <td class="pl-4">
                                                    <a class="pr-2" href="{{ route('superadmin.laundry.getProduct', $product->id) }}"><i class="fa fa-edit text-primary"></i></a>
                                                    <a class="pr-2" href="{{ route('superadmin.laundry.detailsProduct', $product->id) }}"><i class="fa fa-desktop text-primary"></i></a>
                                                </td>
                                                <td>{{ $product->status }}</td>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category->cat_name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>
                                                    <img style="width: 60px;height:40px;border:1px dotted black" src="{{ asset($product->image) }}" alt="" data-toggle="tooltip" data-html="true" title="<img src='{{ asset($product->image) }}'>">
                                                </td>
                                                
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {{ $products->appends($_GET)->links() }}
                                    </div>
                                </div>
                            </div>
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

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

    </script>
@endsection