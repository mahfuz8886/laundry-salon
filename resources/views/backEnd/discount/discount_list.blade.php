@extends('backEnd.layouts.master')
@section('discount_section', 'active menu-open')
@section('laundry_discount', 'menu-open')
@section('manage_ldiscount', 'active')
@section('title', 'Manage discount')

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
                            <a href="{{ route('superadmin.laundry.addDiscount') }}" class="btn btn-sm btn-primary">@lang('common.add_new_discount')</a>
                        </p>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-primary border-bottom"><b>@lang('common.discount_list')</b></h5>
                                <form method="GET" action="">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control select2">
                                                    <option value="">@lang('common.select')</option>
                                                    <option {{ $_GET && $_GET['status'] == 1 ? 'selected':'' }} value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Product ID</label>
                                                <input type="number" name="pid" value="{{ $_GET['pid']??'' }}" class="form-control">
                                            </div>
                                        </div> --}}

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Customer ID</label>
                                                <input type="number" name="cid" value="{{ $_GET['cid']??'' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
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
                                                <th>@lang('common.product_name')</th>
                                                <th>@lang('common.customer_name')</th>
                                                <th>@lang('common.discount')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($discounts as $discount)
                                            <tr>
                                                <td class="pl-4">
                                                    <a class="pr-2" href="{{ route('superadmin.laundry.getDiscount', $discount->customer_id) }}"><i class="fa fa-edit text-primary"></i></a>
                                                </td>
                                                <td>{{ $discount->status==1? 'Active':'Inactive' }}</td>
                                                <td>
                                                    {{ $discount->product->product_name ?? '' }}
                                                    @php
                                                        $serviceInfo = App\LaundryProductService::where('id', $discount->service->laundry_service_id)->first();
                                                    @endphp
                                                    <p>Service type: {{ $serviceInfo->service_name ?? '' }}</p>
                                                </td>
                                                <td>{{ $discount->customer->firstName ?? '' }}</td>
                                                <td>{{ $discount->discount }} %</td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {{ $discounts->appends($_GET)->links() }}
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