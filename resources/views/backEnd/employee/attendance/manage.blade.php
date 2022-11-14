@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee_attendance', 'menu-open')
@section('employee_attendance_manage', 'active')
@section('title', 'Employee Attendance')
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
                                                <label> Employee </label>
                                                <select name="employee_id" class="form-control select2">
                                                    <option value="">@lang('common.select')</option>
                                                    @foreach($employees as $item)
                                                    <option {{ $_GET && $_GET['employee_id']==$item->id? 'selected':''}} value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label> Date From </label>
                                                <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label> Date To </label>
                                                <input type="date" name="date_to" value="{{ $_GET['date_to']??'' }}" class="flatDate form-control flatpickr-input" value="">
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
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                {{-- <th class="pl-4">@lang('common.action')</th> --}}
                                                <th>@lang('common.date')</th>
                                                <th>@lang('common.name')</th>
                                                <th>@lang('common.status')</th>
                                                <th>@lang('common.start_time')</th>
                                                <th>@lang('common.end_time')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach($heads as $item)
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

                                            @endforeach --}}

                                            @foreach ($attendances as $attendance)
                                                <tr>
                                                    <td> {{ date('d-M-Y', strtotime($attendance->date)) }} </td>
                                                    <td> {{ $attendance->employee->name ?? '' }} </td>
                                                    <td> {{ $attendance->present == 1 ? 'Present' : 'Absent' }} </td>
                                                    <td> {{ ($attendance->in_time != NULL) ? date("g:i a", strtotime($attendance->in_time)) : '' }} </td>
                                                    <td> {{ ($attendance->in_time != NULL) ? date("g:i a", strtotime($attendance->out_time)) : '' }} </td>
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
