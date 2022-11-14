@extends('backEnd.layouts.master')
@section('merchant', 'active menu-open')
@section('merchant_manage', 'active')
@section('title', 'Manage Merchant')
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
                                        <h5>@lang('common.manage')</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.id')</th>
                                            <th>@lang('common.name')</th>
                                            <th>@lang('common.company_name')</th>
                                            <th>@lang('common.mobile_no')</th>
                                            <th>@lang('common.email_address')</th>
                                            <th>@lang('common.status')</th>
                                            <th>@lang('common.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($merchants as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->firstName }} {{ $value->lastName }}</td>
                                                <td>{{ $value->companyName }}</td>
                                                <td>{{ $value->phoneNumber }}</td>
                                                <td>{{ $value->emailAddress }}</td>
                                                <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <ul class="action_buttons dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-toggle="dropdown">@lang('common.action_button')
                                                            <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                @if ($value->status == 1)
                                                                    <form action="{{ url('editor/merchant/inactive') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_up"
                                                                            title="unpublished"><i
                                                                                class="fa fa-thumbs-up"></i>
                                                                                @lang('common.inactive')</button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ url('editor/merchant/active') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="hidden_id"
                                                                            value="{{ $value->id }}">
                                                                        <button type="submit" class="thumbs_down"
                                                                            title="published"><i
                                                                                class="fa fa-thumbs-down"></i>
                                                                                @lang('common.active')</button>
                                                                    </form>
                                                                @endif
                                                            </li>
                                                            <li>
                                                                <a class="thumbs_up"
                                                                    href="{{ url('editor/merchant/edit/' . $value->id) }}"
                                                                    title="Edit"><i class="fa fa-edit"></i> @lang('common.edit')</a>
                                                            </li>
                                                            <li>
                                                                <a class="edit_icon"
                                                                    href="{{ url('editor/merchant/view/' . $value->id) }}"
                                                                    title="View"><i class="fa fa-eye"></i> @lang('common.view')</a>
                                                            </li>
                                                            <li>
                                                                <a class="edit_icon"
                                                                    href="{{ url('editor/merchant/payment/invoice/' . $value->id) }}"
                                                                    title="View"><i class="fa fa-list"></i> @lang('common.payments')</a>
                                                            </li>
                                                            <li>
                                                                <a class="edit_icon"
                                                                    href="{{ url('report/merchant-based-parcels?merchant_id=' . $value->id) }}"
                                                                    title="View"><i class="fa fa-list"></i> @lang('common.parcel_report') </a>
                                                            </li>
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
