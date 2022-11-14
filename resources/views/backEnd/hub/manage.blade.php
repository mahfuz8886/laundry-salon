@extends('backEnd.layouts.master')
@section('website', 'active menu-open')
@section('hub', 'active')
@section('title', 'Manage Hub')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">@lang('common.welcome') !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('login') }}">@lang('common.dashborad')</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('editor/hub/manage') }}">@lang('common.hub')</a></li>
                        <li class="breadcrumb-item active">@lang('common.manage')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="manage-button">
                        <div class="body-title">
                            <h5>@lang('common.hub') @lang('common.manage')</h5>
                        </div>
                        <div class="quick-button">
                            <a href="{{ url('editor/hub/create') }}" class="btn btn-primary btn-actions btn-create">
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
                                            <th>@lang('common.title')</th>
                                            <th>@lang('common.description')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($show_data as $key => $value)
                                            @php
                                                $hasDefault = false;
                                                foreach ($show_data as $item) {
                                                    if($item->is_default) {
                                                        $hasDefault = true;
                                                    }
                                                }
                                                
                                            @endphp
                                            <tr class="@if($value->is_default) bg-success @else bg-light @endif">
                                                <td>{{ $loop->iteration }}</td>
                                                </td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->text }}</td>
                                                <td>@if ($value->status == 1) @lang('common.active') @else @lang('common.inactive') @endif</td>
                                                <td>
                                                    <ul class="action_buttons dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown">@lang('common.action')
                                                            <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-item">
                                                                @if(!$value->is_default && !$hasDefault)
                                                                <form action="{{ url('editor/hub/set-default') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="set default">
                                                                            <i class="fa fa-check-circle"></i> 
                                                                            @lang('common.default')
                                                                        </button>
                                                                </form>
                                                                @elseif($value->is_default)
                                                                <form action="{{ url('editor/hub/set-nondefault') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="set default">
                                                                            <i class="fa fa-remove"></i> 
                                                                            @lang('common.non_default')
                                                                        </button>
                                                                </form>
                                                                @endif
                                                            </li>
                                                            <li class="dropdown-item">
                                                                @if ($value->status == 1)
                                                                    <form action="{{ url('editor/hub/inactive') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="unpublished"><i
                                                                                class="fa fa-thumbs-up"></i> @lang('common.active')</button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('editor/hub/active') }}"
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
                                                            <li class="dropdown-item">
                                                                <a class="edit_icon"
                                                                    href="{{ url('editor/hub/edit/' . $value->id) }}"
                                                                    title="Edit"><i class="fa fa-edit"></i> @lang('common.edit')</a>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <form action="{{ url('editor/hub/delete') }}"
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
