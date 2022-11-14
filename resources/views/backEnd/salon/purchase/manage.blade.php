@extends('backEnd.layouts.master')
@section('purchase_section', 'active menu-open')
@section('purchase', 'active menu-open')
@section('manage_purchase', 'active')
@section('title', 'Items')

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
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date To</label>
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.action')</th>
                                    <th>@lang('common.invoice_no')</th>
                                    <th>@lang('common.supplier')</th>
                                    <th>@lang('common.branch')</th>
                                    <th>@lang('common.purchase_date')</th>
                                    <th>@lang('common.invoice_total')</th>
                                    <th>@lang('common.discount')</th>
                                    <th>@lang('common.payable')</th>
                                    <th>@lang('common.paid')</th>
                                    <th>@lang('common.due')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('superadmin.salon.getPurchase', $item->id) }}" class="mr-2"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('superadmin.salon.detailsPurchase', $item->id) }}" class="mr-2"><i class="fa fa-desktop"></i></a>
                                        </td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>
                                            @php
                                            $supplier = App\Supplier::where('id', $item->supplier_id)->first();
                                            echo $supplier->name;
                                            @endphp
                                        </td>
                                        <td>{{ $item->branch->title??'' }}</td>
                                        <td>{{ $item->purchase_date }}</td>
                                        <td>{{ $item->invoice_total }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>{{ $item->payable }}</td>
                                        <td>{{ $item->paid }}</td>
                                        <td>{{ $item->due }}</td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{-- {{ $items->appends($_GET)->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection