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
                                    <input type="date" name="date_from" value="{{ $_GET['date_from'] ?? '' }}"
                                        class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" name="date_to" value="{{ $_GET['date_to'] ?? '' }}"
                                        class="flatDate form-control flatpickr-input" value="">
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
                                    <th>@lang('common.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('superadmin.salon.getPurchase', $item->id) }}"
                                                class="mr-2"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('superadmin.salon.detailsPurchase', $item->id) }}"
                                                class="mr-2"><i class="fa fa-desktop"></i></a>
                                        </td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>
                                            @php
                                                $supplier = App\Supplier::where('id', $item->supplier_id)->first();
                                                echo $supplier->name;
                                            @endphp
                                        </td>
                                        <td>{{ $item->branch->title ?? '' }}</td>
                                        <td>{{ $item->purchase_date }}</td>
                                        <td>{{ $item->invoice_total }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>{{ $item->payable }}</td>
                                        <td>{{ $item->paid }}</td>
                                        <td>{{ $item->due }}</td>
                                        <td>
                                            @if ($item->due > 0)
                                                <a type="button" class="btn btn-primary btn-sm text-white paid_by_invoice"
                                                    data-toggle="modal" data-target="#exampleModalCenter"
                                                    data-id="{{ $item->id }}">
                                                    Pay
                                                </a>
                                            @endif
                                        </td>
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

    {{-- modal for paid salary --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Pay Due </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL('superadmin/salarysheet/salary-paid') }}" method="post" id="pay-form">
                        @csrf
                        <div class="form-group col-md-8">
                            <label for="head_name"> @lang('common.date') </label>
                            <input type="text" name="invoice_no" id="invoice_no">
                            <input type="date" name="pay_date" value="{{ old('pay_date') }}"
                                class="flatDate form-control flatpickr-input">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="payment_method">@lang('common.payment_method')</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="">@lang('common.choose')</option>
                                <option value="1" @if (old('payment_method') == 1) selected @endif>
                                    @lang('common.cash')</option>
                                <option value="2" @if (old('payment_method') == 2) selected @endif>
                                    @lang('common.bank')</option>
                                <option value="3" @if (old('payment_method') == 3) selected @endif>
                                    @lang('common.bkash')</option>
                                <option value="4" @if (old('payment_method') == 4) selected @endif>
                                    @lang('common.rocket')</option>
                                <option value="5" @if (old('payment_method') == 5) selected @endif>
                                    @lang('common.nagad')</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal for paid salary --}}


@endsection

@section('script')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(document).ready(function() {
            $('.paid_by_invoice').on('click', function() {
                var invoice_no = $(this).data('id');
                $('#invoice_no').val(invoice_no);
                //console.log(invoice_no);
            });
            $('.close').on('click', function() {
                $('#pay-form')[0].reset();
            });
        });

    </script>
@endsection
