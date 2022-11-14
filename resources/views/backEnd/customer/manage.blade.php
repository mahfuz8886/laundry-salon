@extends('backEnd.layouts.master')
@section('customer', 'active menu-open')
@section('customer_manage', 'active')
@section('title', 'Manage customer')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="manage-button">
                    <div class="body-title">
                        <h5>@lang('common.customer') @lang('common.manage')</h5>
                    </div>
                    <div class="quick-button">
                        <a href="{{ route('superadmin.addCustomer') }}"
                            class="btn btn-sm btn-primary btn-actions btn-create">
                            <i class="fa fa-plus"></i> @lang('common.add_new')
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <form method="GET" action="">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control select2">
                                                    <option value="">@lang('common.select')</option>
                                                    <option {{ $_GET && $_GET['status'] == 1 ? 'selected':'' }} value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile No</label>
                                                <input type="text" name="mobile" value="{{ $_GET['mobile']??'' }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label> @lang('common.type') </label>
                                                <select name="customer_type" class="form-control select2">
                                                    <option value="">@lang('common.select')</option>
                                                    <option value="Regular" {{ $_GET && $_GET['customer_type'] == 'Regular' ? 'selected':'' }}> @lang('common.regular') </option>
                                                    <option value="Corporate" {{ $_GET && $_GET['customer_type'] == 'Corporate' ? 'selected':'' }}> @lang('common.corporate') </option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
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
                            <div class="card-body">
                                <div class="teble-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="pl-4">@lang('common.action')</th>
                                                <th>@lang('common.status')</th>
                                                <th>@lang('common.id')</th>
                                                <th>@lang('common.name')</th>
                                                <th>@lang('common.mobile_no')</th>
                                                <th>@lang('common.email_address')</th>
                                                <th>@lang('common.registered_by')</th>
                                                <th>@lang('common.image')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $customer)
                                            <tr>
                                                <td class="pl-4">
                                                    <a class="pr-2" href="{{ route('superadmin.getCustomer', $customer->id) }}"><i class="fa fa-edit text-primary"></i></a>
                                                    <a class="pr-2" href="{{ route('superadmin.detailsCustomer', $customer->id) }}"><i class="fa fa-desktop text-primary"></i></a>
                                                    @if ($customer->customer_type == 'Corporate')
                                                    <a class="pr-2" href="{{ route('superadmin.add_or_edit_corporate_customer_product', $customer->id) }}"> <i class="fab fa-product-hunt"></i> </a>
                                                    @endif
                                                </td>
                                                <td>{{ $customer->status==1?'Active':'Inactive' }}</td>
                                                <td>{{ $customer->id }}</td>
                                                <td>{{ $customer->firstName }}</td>
                                                <td>{{ $customer->phoneNumber }}</td>
                                                <td>{{ $customer->emailAddress }}</td>
                                                <td>{{ $customer->register_by }}</td>
                                                <td>
                                                    <img style="width: 60px;height:40px;border:1px dotted black" src="{{ asset($customer->logo) }}" alt="">
                                                </td>
                                                
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        {{ $customers->appends($_GET)->links() }}
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
