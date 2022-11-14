@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('agent_add', 'active')
@section('title', 'Agent Detail')
@section('extracss')
    <style>
        .table th {
            padding: 5px 10px !important;
        }

        .table td {
            padding: 5px 10px !important;
        }

    </style>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.agent') @lang('common.details')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/agent/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.personal_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <label for="image"> @lang('common.agent') @lang('common.photo') </label>
                                                    <div>
                                                        <img src="{{ url($agent->image) }}" alt="Photo" width="100"
                                                            height="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="200"> @lang('common.name') </th>
                                                        <td>{{ $agent->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.email_address') </th>
                                                        <td>{{ $agent->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.mobile_no') </th>
                                                        <td>{{ $agent->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.alternative') @lang('common.mobile_no')</th>
                                                        <td>{{ $agent->alternative_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.nid_number') </th>
                                                        <td>{{ $agent->nid_no }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.designation') </th>
                                                        <td>{{ $agent->designation }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title"> @lang('common.others_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="200">@lang('common.division')</th>
                                                        <td>{{ $agent->division->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">@lang('common.district')</th>
                                                        <td>{{ $agent->district->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.thana') </th>
                                                        <td>
                                                            @foreach ($agent->thanaDetails() ?? [] as $thana)
                                                                <span class="badge badge-info">{{ $thana->name }}</span>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.status') </th>
                                                        <td>
                                                            @if ($agent->status == 1)
                                                            @lang('common.active')
                                                            @else
                                                            @lang('common.inactive')
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
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
    <script></script>
@endsection
