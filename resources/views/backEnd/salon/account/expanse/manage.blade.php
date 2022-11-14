@extends('backEnd.layouts.master')
@section('account_section', 'active menu-open')
@section('expanse', 'active menu-open')
@section('expanse_list', 'active')
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
                                                <label>@lang('common.invoice_no')</label>
                                                <input type="text" name="invoice_no" value="{{ $_GET['invoice_no']??'' }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label> @lang('common.date_from') </label>
                                                <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label> @lang('common.date_to') </label>
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
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.date')</th>
                                                <th>@lang('common.invoice_no')</th>
                                                <th>@lang('common.total')</th>
                                                <th>@lang('common.payment_method')</th>
                                                <th>@lang('common.head_types')</th>
                                                <th class="pl-4">@lang('common.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($income_lists as $income_list)
                                                <tr>
                                                    <td>
                                                        {{ date('d-M-Y', strtotime($income_list->issue_date)) }}
                                                    </td>
                                                    <td> {{ $income_list->invoice_no }} </td>
                                                    <td> {{ $income_list->total }} </td>
                                                    <td>
                                                        @if ($income_list->payment_method == 1)
                                                            Cash
                                                        @elseif($income_list->payment_method == 2)
                                                            Bank
                                                        @elseif($income_list->payment_method == 3)
                                                            Mobile Banking
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach ($income_list->expanse_salon_transection as $item)
                                                            {{ $item->account_head->head_name .", " }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a class="pr-2" href="{{ route('superadmin.account.expanseSalonEdit', $income_list->id) }}"><i class="fa fa-edit text-primary"></i></a>
                                                        <a class="pr-2" href="{{ route('superadmin.account.expanseSalonDelete', $income_list->id) }}"><i class="fa fa-trash text-danger"></i></a>
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
