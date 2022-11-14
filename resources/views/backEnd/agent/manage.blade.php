@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('agent_manage', 'active')
@section('title', 'Manage Agent')
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
                                        <h5>@lang('common.agent') @lang('common.manage')</h5>
                                    </div>
                                    @can('agent_add')
                                        <div class="quick-button">
                                            <a href="{{ url('admin/agent/add') }}"
                                                class="btn btn-primary btn-actions btn-create">
                                                <i class="fa fa-plus"></i> @lang('common.add_new')
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.id')</th>
                                            <th>@lang('common.name')</th>
                                            <th>@lang('common.email_address')</th>
                                            <th>@lang('common.mobile_no')</th>
                                            <th>@lang('common.thana')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($show_datas as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>
                                                    @foreach ($value->thanas as $item)
                                                        {{ $item->thana->name ?? '' }},
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        @lang('common.active')
                                                    @else
                                                        @lang('common.inactive')
                                                    @endif
                                                </td>
                                                <td>
                                                    <ul class="action_buttons">
                                                        <li>
                                                            <a class="edit_icon"
                                                                href="{{ url('admin/agent/details/' . $value->id) }}"
                                                                title="Details"><i class="fa fa-eye"></i></a>
                                                        </li>
                                                        @can('agent_edit')
                                                            <li>
                                                                @if ($value->status == 1)
                                                                    <form action="{{ url('admin/agent/inactive') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="unpublished"><i
                                                                                class="fa fa-thumbs-up"></i></button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('admin/agent/active') }}"
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
                                                                    href="{{ url('admin/agent/edit/' . $value->id) }}"
                                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                            </li>
                                                        @endcan

                                                        <!--<li>-->
                                                        <!--  <form action="{{ url('admin/agent/delete') }}" method="POST">-->
                                                        <!--    @csrf-->
                                                        <!--    <input type="hidden" name="hidden_id" value="{{ $value->id }}">-->
                                                        <!--    <button type="submit" onclick="return confirm('Are you delete this this?')" class="trash_icon" title="Delete"><i class="fa fa-trash"></i></button>-->
                                                        <!--  </form>-->
                                                        <!--</li>-->
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tfoot>
                                </table>
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




@endsection
