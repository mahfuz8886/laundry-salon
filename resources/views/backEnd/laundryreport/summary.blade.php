@extends('backEnd.layouts.master')
@section('report_section', 'active menu-open')
@section('lsummary', 'active')
@section('title', 'Summary report')

@section('extracss')
    <style>
        .total-inventory {
            height: 250px;
            overflow-y: auto;
        }
    </style>

    {{-- <style type="text/css" media="print">
    @page {
        size: auto;
        / auto is the initial value /

        / this affects the margin in the printer settings /
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }
    }
</style> --}}
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
            <div class="card hide-section">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Report Type</label>
                                    <select name="type" id="type" class="form-control"
                                        onchange="showHideDate(this.value)" required>
                                        <option {{ $_GET && $_GET['type'] == 'today' ? 'selected' : '' }} value="today">
                                            @lang('common.today')</option>
                                        <option {{ $_GET && $_GET['type'] == 'datewise' ? 'selected' : '' }}
                                            value="datewise">
                                            @lang('common.datewise')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" disabled name="date_from" value="{{ $_GET['date_from'] ?? '' }}"
                                        class="datearea flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" disabled name="date_to" value="{{ $_GET['date_to'] ?? '' }}"
                                        class="datearea flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Search" name="submit">
                                    {{-- <button type="button" class="btn btn-success btn-sm" onclick="printWindow(this)"> <i class="fas fa-print"></i> Print </button> --}}
                                    <button type="button" class="btn btn-success btn-sm" onclick="printDiv(this)"> <i
                                            class="fas fa-print"></i> Print </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            {{-- print part --}}
            <div class="print" id="print">
                <h3 class="text-primary bg-info p-2 rounded">Orders Information</h3>
                <div class="row">
                    {{-- pending orders --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary text-uppercase">Total pending orders : <b>{{ $totalPending }}</b>
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.order_id')</th>
                                                <th>@lang('common.customer_name')</th>
                                                <th>@lang('common.mobile_no')</th>
                                                <th>@lang('common.order_datetime')</th>
                                                <th>@lang('common.quantity')</th>
                                                <th>@lang('common.amount')</th>
                                                <th>@lang('common.address')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pendingOrders as $item)
                                                @php
                                                    $customer = App\Customer::where('id', $item->customer_id)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $customer->firstName ?? '' }}</td>
                                                    <td>{{ $customer->phoneNumber ?? '' }}</td>
                                                    <td>{{ date('D F Y', strtotime($item->order_datetime)) }}</td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalQty = $orderItems->sum('qty');
                                                        @endphp
                                                        {{ $totalQty ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalAmount = $orderItems->sum('total');
                                                        @endphp
                                                        {{ $totalAmount ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderAddress = App\OrderShipping::where('order_id', $item->id)
                                                                ->with('division')
                                                                ->with('district')
                                                                ->with('thana')
                                                                ->first();
                                                        @endphp
                                                        {{ $orderAddress->address ?? '' }},{{ $orderAddress->thana->name ?? '' }},{{ $orderAddress->district->name ?? '' }},{{ $orderAddress->division->name ?? '' }}.
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">@lang('common.data_not_found')</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ready for pickup order --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary text-uppercase">Total Ready for pick orders :
                                    <b>{{ $totalForPick }}</b>
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.order_id')</th>
                                                <th>@lang('common.customer_name')</th>
                                                <th>@lang('common.quantity')</th>
                                                <th>@lang('common.amount')</th>
                                                <th>@lang('common.address')</th>
                                                <th>@lang('common.pickupman')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($readyForPickOrders as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @php
                                                            $customer = App\Customer::where('id', $item->customer_id)->first();
                                                            //echo $customer->firstName;
                                                        @endphp
                                                        {{ $customer->firstName ?? '' }}
                                                    </td>

                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalQty = $orderItems->sum('qty');
                                                        @endphp
                                                        {{ $totalQty ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalAmount = $orderItems->sum('total');
                                                        @endphp
                                                        {{ $totalAmount ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderAddress = App\OrderShipping::where('order_id', $item->id)
                                                                ->with('division')
                                                                ->with('district')
                                                                ->with('thana')
                                                                ->first();
                                                        @endphp
                                                        {{ $orderAddress->address ?? '' }},{{ $orderAddress->thana->name ?? '' }},{{ $orderAddress->district->name ?? '' }},{{ $orderAddress->division->name ?? '' }}.
                                                    </td>
                                                    <td>
                                                        @php
                                                            $pman = App\Pickupman::where('id', $item->pman_id)->first();
                                                            if ($pman) {
                                                                $name = $pman->name . ' - ' . $pman->phone;
                                                                echo $name ?? '';
                                                            } else {
                                                                echo 'not assign yet';
                                                            }
                                                            
                                                        @endphp
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">@lang('common.data_not_found')</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- picked order --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary text-uppercase">Total picked orders : <b>{{ $totalPicked }}</b>
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.order_id')</th>
                                                <th>@lang('common.customer_name')</th>
                                                <th>@lang('common.quantity')</th>
                                                <th>@lang('common.amount')</th>
                                                <th>@lang('common.address')</th>
                                                <th>@lang('common.pickupman')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pickedOrders as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @php
                                                            $customer = App\Customer::where('id', $item->customer_id)->first();
                                                            //echo $customer->firstName;
                                                        @endphp
                                                        {{ $customer->firstName ?? '' }}
                                                    </td>

                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalQty = $orderItems->sum('qty');
                                                        @endphp
                                                        {{ $totalQty ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalAmount = $orderItems->sum('total');
                                                        @endphp
                                                        {{ $totalAmount ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderAddress = App\OrderShipping::where('order_id', $item->id)
                                                                ->with('division')
                                                                ->with('district')
                                                                ->with('thana')
                                                                ->first();
                                                        @endphp
                                                        {{ $orderAddress->address ?? '' }},{{ $orderAddress->thana->name ?? '' }},{{ $orderAddress->district->name ?? '' }},{{ $orderAddress->division->name ?? '' }}.
                                                    </td>
                                                    <td>
                                                        @php
                                                            $pman = App\Pickupman::where('id', $item->pman_id)->first();
                                                            if ($pman) {
                                                                $name = $pman->name . ' - ' . $pman->phone;
                                                                echo $name ?? '';
                                                            } else {
                                                                echo 'not assign yet';
                                                            }
                                                            
                                                        @endphp
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">@lang('common.data_not_found')</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ready for delivery order --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary text-uppercase">Total Ready for delivery orders :
                                    <b>{{ $totalForDelivery }}</b>
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.order_id')</th>
                                                <th>@lang('common.customer_name')</th>
                                                <th>@lang('common.quantity')</th>
                                                <th>@lang('common.amount')</th>
                                                <th>@lang('common.address')</th>
                                                <th>@lang('common.deliveryman')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($forDeliveryOrders as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @php
                                                            $customer = App\Customer::where('id', $item->customer_id)->first();
                                                            //echo $customer->firstName;
                                                        @endphp
                                                        {{ $customer->firstName ?? '' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalQty = $orderItems->sum('qty');
                                                        @endphp
                                                        {{ $totalQty ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalAmount = $orderItems->sum('total');
                                                        @endphp
                                                        {{ $totalAmount ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderAddress = App\OrderShipping::where('order_id', $item->id)
                                                                ->with('division')
                                                                ->with('district')
                                                                ->with('thana')
                                                                ->first();
                                                        @endphp
                                                        {{ $orderAddress->address ?? '' }},{{ $orderAddress->thana->name ?? '' }},{{ $orderAddress->district->name ?? '' }},{{ $orderAddress->division->name ?? '' }}.
                                                    </td>
                                                    <td>
                                                        @php
                                                            $dman = App\Deliveryman::where('id', $item->dman_id)->first();
                                                            if ($dman) {
                                                                $name = $dman->name . ' - ' . $dman->phone;
                                                                echo $name ?? '';
                                                            } else {
                                                                echo 'not assign yet';
                                                            }
                                                            
                                                        @endphp
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">@lang('common.data_not_found')</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- delivered order --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-primary text-uppercase">Total Delivered orders :
                                    <b>{{ $totalDelivered }}</b>
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('common.order_id')</th>
                                                <th>@lang('common.customer_name')</th>
                                                <th>@lang('common.quantity')</th>
                                                <th>@lang('common.amount')</th>
                                                <th>@lang('common.address')</th>
                                                <th>@lang('common.deliveryman')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_amount = 0;
                                            @endphp
                                            @forelse ($deliveredOrders as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        @php
                                                            $customer = App\Customer::where('id', $item->customer_id)->first();
                                                            //echo $customer->firstName;
                                                        @endphp
                                                        {{ $customer->firstName ?? '' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalQty = $orderItems->sum('qty');
                                                        @endphp
                                                        {{ $totalQty ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderItems = App\OrderItem::where('order_id', $item->id)->get();
                                                            $totalAmount = $orderItems->sum('total');
                                                        @endphp
                                                        {{ $totalAmount ?? 0 }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $orderAddress = App\OrderShipping::where('order_id', $item->id)
                                                                ->with('division')
                                                                ->with('district')
                                                                ->with('thana')
                                                                ->first();
                                                        @endphp
                                                        {{ $orderAddress->address ?? '' }},{{ $orderAddress->thana->name ?? '' }},{{ $orderAddress->district->name ?? '' }},{{ $orderAddress->division->name ?? '' }}.
                                                    </td>
                                                    <td>
                                                        @php
                                                            $dman = App\Deliveryman::where('id', $item->dman_id)->first();
                                                            if ($dman) {
                                                                $name = $dman->name . ' - ' . $dman->phone;
                                                                echo $name ?? '';
                                                            } else {
                                                                echo 'not assign yet';
                                                            }
                                                            
                                                        @endphp
                                                    </td>

                                                </tr>
                                                @php
                                                    $total_amount = $total_amount + $totalAmount;
                                                @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">@lang('common.data_not_found')</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <h5 class="text-primary text-uppercase">Total Amount : <b>{{ $total_amount }}</b></h5>
                            </div>
                        </div>
                    </div>

                </div>

                <h3 class="text-primary bg-info p-2 rounded">Inventory Information</h3>
                <div class="row">
                    <div class="col-md-6">
                        {{-- total add inventory --}}
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-primary text-uppercase">Total add inventory :
                                        <b>{{ $totalAddInventory }}</b>
                                    </h5>
                                    <div class="table-responsive total-inventory">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    {{-- <th>@lang('common.order_id')</th> --}}
                                                    <th>@lang('common.item')</th>
                                                    <th>@lang('common.quantity')</th>
                                                    <th>@lang('common.added_date')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($addInventories as $item)
                                                    @php
                                                        $itemInfo = App\LaundryItem::where('id', $item->item_id)->first();
                                                    @endphp
                                                    <tr>
                                                        {{-- <td>{{ $item->id }}</td> --}}
                                                        <td>{{ $itemInfo->name ?? '' }}</td>
                                                        <td>{{ $item->quantity ?? '' }}</td>
                                                        <td>{{ date('D F Y', strtotime($item->created_at)) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">@lang('common.data_not_found')</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- total use inventory --}}
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-primary text-uppercase">Total use inventory :
                                        <b>{{ $totalUses }}</b>
                                    </h5>
                                    <div class="table-responsive total-inventory">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    {{-- <th>@lang('common.order_id')</th> --}}
                                                    <th>@lang('common.item')</th>
                                                    <th>@lang('common.quantity')</th>
                                                    <th>@lang('common.uses_date')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($usesInventories as $item)
                                                    @php
                                                        $itemInfo = App\LaundryItem::where('id', $item->item_id)->first();
                                                    @endphp
                                                    <tr>
                                                        {{-- <td>{{ $item->id }}</td> --}}
                                                        <td>{{ $itemInfo->name ?? '' }}</td>
                                                        <td>{{ $item->quantity ?? '' }}</td>
                                                        <td>{{ date('D F Y', strtotime($item->created_at)) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">@lang('common.data_not_found')</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- print part --}}

        </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function showHideDate(type) {
            let selectType = type;
            let dateArea = document.querySelectorAll('.datearea');

            if (selectType == 'today') {
                for (var i = 0; i < dateArea.length; i++) {
                    dateArea[i].setAttribute('disabled', true);
                    dateArea[i].removeAttribute('required');
                }

            } else if (selectType == 'datewise') {
                for (var i = 0; i < dateArea.length; i++) {
                    dateArea[i].removeAttribute('disabled');
                    dateArea[i].setAttribute('required', '');
                }
            }
        }


        function printDiv(ele) {
            //let hideSection = document.querySelector('.hide-section');
            //hide befor print
            // hideSection.style.display = 'none';
            // button.style.display = 'none';

            //now print window
            //let hideSection = document.querySelector('.hide-section');
            //window.print();

            //show after print
            // hideSection.style.display = 'block';
            // button.style.display = 'inline-block';


            var prtContent = document.getElementById("print");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();

        }

        setInterval(() => {
            window.location.reload();
        }, 180000);
    </script>
@endsection
