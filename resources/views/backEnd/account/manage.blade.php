@extends('backEnd.layouts.master')
@section('account_section', 'active menu-open')
@section('account_head', 'active menu-open')
@section('head_list', 'active')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
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
                                                <label>Head Type</label>
                                                <select name="type" class="form-control select2">
                                                    <option value="">@lang('common.choose')</option>
                                                    @foreach($headTypes as $item)
                                                    <option {{ $_GET && $_GET['type']==$item->id? 'selected':''}} value="{{ $item->id }}">{{ $item->type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label>Head Name</label>
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
                                                <th>@lang('common.head_id')</th>
                                                <th>@lang('common.user_name')</th>
                                                <th>@lang('common.head_name')</th>
                                                <th>@lang('common.type')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($heads as $item)
                                            <tr>
                                                <td class="pl-4">
                                                    @if($item->role_id== 1)
                                                    <a class="pr-2" href="{{ route('superadmin.account.getItem', $item->id) }}"><i class="fa fa-edit text-primary"></i></a>
                                                    @endif
                                                </td>
                                                <td>{{ $item->status==1?'Active':'Inactive' }}</td>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    @php
                                                    if($item->head_type == 1) {
                                                        $customer_name = App\Customer::where('id', $item->user_id)->first();
                                                        if($customer_name) {
                                                            echo $customer_name->firstName;
                                                        }
                                                    }elseif ($item->head_type == 2) {
                                                        $dman = App\Deliveryman::where('id', $item->user_id)->first();
                                                        if($dman) {
                                                            echo $dman->name;
                                                        }
                                                    }elseif ($item->head_type == 5) {
                                                        $supplier = App\Supplier::where('id', $item->user_id)->first();
                                                        if($supplier) {
                                                            echo $supplier->name;
                                                        }
                                                    }elseif ($item->head_type == 6) {
                                                        $pman = App\Pickupman::where('id', $item->user_id)->first();
                                                        if($pman) {
                                                            echo $pman->name;
                                                        }
                                                    }elseif ($item->head_type == 7) {
                                                        $emp = App\Employee::where('id', $item->user_id)->first();
                                                        if($emp) {
                                                            echo $emp->name;
                                                        }
                                                    }else {
                                                        echo 'Administrator';
                                                    }  
                                                    @endphp

                                                </td>
                                                <td>{{ $item->head_name }}</td>
                                                <td>
                                                    @php
                                                        $headType = DB::table('account_head_types')->where('status', 1)->where('id', $item->head_type)->first();
                                                        if($headType) {
                                                            echo $headType->type_name;
                                                        }
                                                    @endphp
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
        </div>
    </section>




@endsection
