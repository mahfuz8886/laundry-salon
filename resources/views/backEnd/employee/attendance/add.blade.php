@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee_attendance', 'menu-open')
@section('employee_attendance_add', 'active')
@section('title', 'Create Employee Attendance')
@section('extracss')
    <style>
        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            position: relative !important;
            left: 0 !important;
        }

        [type="radio"]:checked+label,
        [type="radio"]:not(:checked)+label {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            line-height: 20px;
            display: inline-block;
            color: #666;
            float: left;
            margin-right: 10px;
        }
    </style>
@endsection
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
            <form method="GET">
                @csrf
                <div class="card">
                    <h5 class="card-header text-uppercase">@lang('common.add_attendance')</h5>
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="head_name"> @lang('common.date') </label>
                                <input type="date" name="date" value="{{ $_GET['date'] ?? '' }}"
                                    class="flatDate form-control flatpickr-input">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="branch_id">@lang('common.branch')</label>
                                <select name="branch_id" id="branch_id" class="form-control" required>
                                    <option value="">@lang('common.choose')</option>
                                    @foreach ($allBranch as $item)
                                        <option
                                            {{ (($_GET && $_GET['branch_id']) || Session::get('default_branch')) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->title }}</option>
                                        {{-- <option value="{{ $item->id }}" @if ((($_GET && $_GET['branch_id']) || Session::get('default_branch')) == $item->id) selected @endif>{{ $item->title }}</option> --}}
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ url('admin/employee/attendance/store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>@lang('common.sl.')</th>
                                        <th>@lang('common.employee_name')</th>
                                        <th>@lang('common.status')</th>
                                        <th>@lang('common.start_time')</th>
                                        <th>@lang('common.end_time')</th>
                                    </tr>
                                </thead>

                                <tbody class="rowContainer">

                                    {{-- <tr class="item">
                                        <td>
                                            <input type="text" name="employee_id[]" class="form-control" required>
                                            <span> 1 </span>
                                        </td>
                                        <td>
                                            <span> Name </span>
                                        </td>
                                        <td>
                                            <input type="radio" id="html" name="present[]" value="1"
                                                class="form-check form-check-inline">
                                            <label for="html" class="form-check-label"> Present </label>
                                            <input type="radio" id="css" name="present[]" value="0"
                                                class="form-check form-check-inline">
                                            <label for="css" class="form-check-label"> Absent </label><br>
                                        </td>
                                        <td>
                                            <input type="time" name="in_time[]" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="time" name="out_time[]" class="form-control" required>
                                        </td>
                                    </tr> --}}

                                    @if ($_GET && $_GET['date'] && ($_GET && $_GET['branch_id']))
                                        @foreach ($employees as $key => $employee)
                                            <tr class="item">
                                                <td>
                                                    <input type="hidden" name="employee_id[]" class="form-control"
                                                        value="{{ $employee->id }}" required>
                                                    <input type="hidden" name="date" class="form-control"
                                                        value="{{ $_GET['date'] }}" required>
                                                    <span> {{ ++$loop->index }} </span>
                                                </td>
                                                <td>
                                                    <span> {{ $employee->name }} </span>
                                                </td>
                                                {{-- <td>
                                                    <input type="radio" id="html" name="present[]" value="1"
                                                        class="form-check form-check-input">
                                                    <label for="html" class="form-check-label"> Present </label>
                                                </td> --}}
                                                <td>
                                                    <input type="radio" name="present[{{ $key }}]" value="1"
                                                        class="" checked> <span> Present </span>
                                                    {{-- <label for="html" class=""> Present </label> --}}
                                                    <input type="radio" name="present[{{ $key }}]"
                                                        value="0" class=""> <span> Absent </span>
                                                    {{-- <label for="css" class=""> Absent </label><br> --}}

                                                </td>
                                                <td>
                                                    <input type="time" name="in_time[]" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="time" name="out_time[]" class="form-control">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center"> No Data Found. </td>
                                        </tr>
                                    @endif


                                </tbody>

                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">@lang('common.submit')</button>
                    </div>
                </div>
            </form>

        </div>
        </div>

    </section>
@endsection

@section('script')
    <script></script>
@endsection
