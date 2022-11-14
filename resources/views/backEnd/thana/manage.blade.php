@extends('backEnd.layouts.master')
@section('area', 'active menu-open')
@section('thana_manage', 'active')
@section('title', 'Thana Edit')
@section('content')
    <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Welcome !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/login') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/thana/manage') }}">Thanas</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="manage-button">
                        <div class="body-title">
                            <h5>@lang('common.thana') @lang('common.manage')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('admin/thana/add') }}" class="btn btn-primary btn-actions btn-create">
                            @lang('common.create')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.id')</th>
                                            <th>@lang('common.name')</th>
                                            <th> @lang('common.district') </th>
                                            <th> @lang('common.division') </th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($show_data as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->district->name??'' }}</td>
                                                <td>{{ $value->division->name??'' }}</td>
                                                <td>@if ($value->status == 1) @lang('common.active') @else @lang('common.inactive') @endif</td>
                                                <td>
                                                    <ul class="action_buttons dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown">@lang('common.action_button')
                                                            <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                @if ($value->status == 1)
                                                                    <form action="{{ url('admin/thana/inactive') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="unpublished"><i
                                                                                class="fa fa-thumbs-up"></i> @lang('common.active')</button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('admin/thana/active') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_down"
                                                                            title="published"><i
                                                                                class="fa fa-thumbs-down"></i>
                                                                                @lang('common.inactive')</button>
                                                                    </form>
                                                                @endif
                                                            </li>
                                                            <li>
                                                                <a class="edit_icon"
                                                                    href="{{ url('admin/thana/edit/'. $value->id) }}"
                                                                    title="Edit"><i class="fa fa-edit"></i> @lang('common.edit')</a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ url('admin/thana/delete') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="hidden_id"
                                                                        value="{{ $value->id }}">
                                                                    <button type="submit"
                                                                        onclick="return confirm('Are you delete this this?')"
                                                                        class="trash_icon" title="Delete"><i
                                                                            class="fa fa-trash"></i> @lang('common.delete')</button>
                                                                </form>
                                                            </li>
                                                        </ul>
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
@endsection
