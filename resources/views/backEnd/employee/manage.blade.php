@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee_manage', 'active')
@section('employee', 'menu-open')
@section('title', 'Manage Employee')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card custom-card">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.employee') @lang('common.manage')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/employee/add') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            <i class="fa fa-plus"></i> @lang('common.add_new')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">@lang('common.id')</th>
                                                <th width="10%">@lang('common.photo')</th>
                                                <th width="5%">@lang('common.name')</th>
                                                {{-- <th width="10px">@lang('common.email_address')</th> --}}
                                                <th width="10%">@lang('common.mobile_no')</th>
                                                @if (Session::get('section')=='salon')
                                                <th width="5%">@lang('common.total_commission')</th>
                                                <th width="5%">@lang('common.total_paid_commission')</th>
                                                <th width="5%">@lang('common.today_commission')</th>
                                                @else
                                                <th width="10px">@lang('common.email_address')</th>
                                                @endif
                                                <th width="10%">@lang('common.status')</th>
                                                <th width="10%">@lang('common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($show_datas as $key => $value)
                                                {{-- @foreach ($value->account_head as $item)
                                                    
                                                @endforeach --}}
                                                {{-- {{  $value->account_head->tot_commission }} --}}
                                                @php
                                                    if($value->origin == 2) {
                                                        $total_commission = $value->account_head->tot_commission;
                                                        $total_commission = $total_commission->sum('amount');

                                                        $total_paid_commission = $value->account_head->tot_paid_commission;
                                                        $total_paid_commission = $total_paid_commission->sum('amount');
                                                        $today_commission = $value->account_head->today_commission->sum('amount');
                                                    }
                                                @endphp

                                                 <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ url($value->image) }}" width="60" height="60" alt="Photo">
                                                    </td>
                                                    <td>{{ $value->name }}</td>
                                                    {{-- <td>{{ $value->email }}</td> --}}
                                                    <td>{{ $value->phone }}</td>

                                                    {{-- <td>  --}}
                                                        @if ($value->origin == 2)
                                                            <td> {{ $total_commission }} </td>
                                                        @endif
                                                    {{-- </td> --}}

                                                    {{-- <td> --}}
                                                        @if ($value->origin == 2)
                                                            <td> {{ $total_paid_commission }} </td>
                                                        @endif
                                                    {{-- </td> --}}

                                                    <td>
                                                        @if ($value->origin == 2)
                                                            {{ $today_commission }}
                                                        @else
                                                            {{ $value->email }}
                                                        @endif
                                                    </td>
                                                    <td>@if ($value->status == 1) @lang('common.active') @else @lang('common.inactive') @endif</td>
                                                    <td>
                                                        <ul class="action_buttons d-flex">
                                                            @if ($value->origin == 2)
                                                                <li>
                                                                    <a class="edit_icon bg-success text-light"
                                                                        href="{{ url('admin/employee/commission/' . $value->id) }}"
                                                                        title="Pay">
                                                                        {{-- <i class="fab fa-cc-amazon-pay"></i> --}}
                                                                        Pay
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <a class="edit_icon"
                                                                    href="{{ url('admin/employee/details/' . $value->id) }}"
                                                                    title="Details"><i class="fa fa-eye"></i></a>
                                                            </li>
                                                            <li>
                                                                @if ($value->status == 1)
                                                                    <form action="{{ url('admin/employee/inactive') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="unpublished"><i
                                                                                class="fa fa-thumbs-up"></i></button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('admin/employee/active') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_down"
                                                                            title="published"><i
                                                                                class="fa fa-thumbs-down"></i></button>
                                                                    </form>
                                                                @endif
                                                            </li>
                                                            <li>
                                                                <a class="edit_icon"
                                                                    href="{{ url('admin/employee/edit/' . $value->id) }}"
                                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                            </li>
                                                            @if(Session::get('section')=='salon')
                                                            <li>
                                                                <button type="button" class="edit_icon bg-dark"
                                                                    onclick="loadModal({{ $value->id }})"
                                                                    title="Assign service"><i class="fa fa-gear"></i></button>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Section  -->
    <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assign Service</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('admin/employee/assign-service')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="d-block">Services</label>
                                <select name="service[]" multiple class="form-control select2 w-100" id="" required>
                                    @php
                                    $services = App\SalonService::where('status', 'Active')->get();    
                                    @endphp
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="employee_id" id="empId">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        function loadModal(params) {
            $('#empId').val(params);
            $("#assignModal").modal('show');
        }
    </script>
@endsection
