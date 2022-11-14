@extends('backEnd.layouts.master')
@section('parcel', 'active menu-open')
@section('multiple_parcel_pick', 'active')
@section('title', 'Multiple parcel pick')
@section('extracss')
    <style>
        .table th,
        .table td {
            white-space: nowrap !important;
        }

        .table td {
            padding: 2px 10px !important;
            margin: 0px !important;
        }
    </style>
@endsection
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="profile-edit mrt-30">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="" class="filte-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <select name="merchant_id" id="merchant_id" class="form-control select2">
                                <option value=""> @lang('common.select_merchant')</option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" @if (request()->get('merchant_id') == $merchant->id) selected @endif>
                                        {{ $merchant->companyName }}
                                        ({{ $merchant->firstName }}-{{ $merchant->phoneNumber }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success"> @lang('common.search') </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">

            @if (!empty($allparcel))
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form action="" method="post">
                        @csrf
                        <div>
                            <button type="submit" class="btn btn-sm btn-info"> @lang('common.select_parcel_picked')</button> <br>
                        </div>
                        <div class="">
                            <table id="" class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all"> @lang('common.select_all')
                                        </th>
                                        <th>@lang('common.sl')</th>
                                        <th>@lang('common.track_id')</th>
                                        <th>@lang('common.date')</th>
                                        <th>@lang('common.company_name')</th>
                                        <th>@lang('common.mobile_no') </th>
                                        <th width="150">@lang('common.address') </th>
                                        <th>@lang('common.status')</th>
                                        <th>@lang('common.total')</th>
                                        <th>@lang('common.charge')</th>
                                        <th>@lang('common.sub_total')</th>
                                        <th>@lang('common.last_update')</th>
                                        <th>@lang('common.note')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allparcel as $key => $value)
                                        <tr>
                                            <td>
                                                @if ($value->status == 1)
                                                    <input type="checkbox" name="parcel_select[]" class="parcel_check"
                                                        value="{{ $value->id }}">
                                                @endif
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->trackingCode }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->companyName }}</td>
                                            <td>{{ $value->recipientPhone }}</td>
                                            <td>
                                                @if ($value->delivery_address)
                                                    {{ $value->delivery_address . ',' }}
                                                @endif
                                                @if ($value->area)
                                                    {{ $value->area . ',' }}
                                                @endif
                                                @if ($value->thana)
                                                    {{ $value->thana . ',' }}
                                                @endif
                                                @if ($value->district)
                                                    {{ $value->district . ',' }}
                                                @endif
                                                @if ($value->division)
                                                    {{ $value->division . '.' }}
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $parcelstatus = App\Parceltype::find($value->status);
                                                @endphp
                                                {{ $parcelstatus->title }}
                                            </td>
                                            <td> {{ $value->cod }}</td>
                                            <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                            <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }}</td>
                                            <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>

                                            <td>
                                                @php
                                                    $parcelnote = App\Parcelnote::where('parcelId', $value->id)
                                                        ->orderBy('id', 'DESC')
                                                        ->first();
                                                @endphp
                                                @if (!empty($parcelnote))
                                                    {{ $parcelnote->note }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- {{ $allparcel->appends($_GET)->links() }} --}}
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#select-all').click(function(event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        })
    </script>
@endsection
