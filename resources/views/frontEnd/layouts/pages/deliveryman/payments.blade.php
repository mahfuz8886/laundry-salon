@extends('frontEnd.layouts.pages.deliveryman.master')
@section('title', 'Dashboard')
@section('my_payments', 'active')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <a href="{{ url('deliveryman/payments/paid') }}" class="btn btn-sm btn-success">
                @lang('common.paid_payments')
            </a>
            <a href="{{ url('deliveryman/payments/due') }}" class="btn btn-sm btn-warning">
                @lang('common.due_payments')
            </a>
        </div>
    </div>
    <div class="profile-edit mrt-30">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="">
                    <table id="" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('common.sl')</th>
                                <th>@lang('common.track_id')</th>
                                <th class="text-right">@lang('common.total_collection')</th>
                                <th class="text-right">@lang('common.deliveryman_total')</th>
                                <th class="text-right">@lang('common.paid') </th>
                                <th class="text-right">@lang('common.due') </th>
                                <th>@lang('common.status')</th>
                                {{-- <th> Action </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parcels as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->trackingCode }}</td>
                                    <td class="text-right"> {{ $value->cod }}</td>
                                    <td class="text-right"> {{ $value->deliveryman_amount }}</td>
                                    <td class="text-right"> {{ $value->deliveryman_paid }}</td>
                                    <td class="text-right"> {{ $value->deliveryman_due }}</td>
                                    <td> {{ $value->parcelStatus->title??'' }}</td>
                                    {{-- <td>
                                        <a href="http://" target="_blank" class="btn btn-primary btn-sm">
                                            Invoice
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="2"> @lang('common.total') </th>
                                <th class="text-right"> {{ $parcels->sum('cod') }} </th>
                                <th class="text-right"> {{ $parcels->sum('deliveryman_amount') }} </th>
                                <th class="text-right"> {{ $parcels->sum('deliveryman_paid') }} </th>
                                <th class="text-right"> {{ $parcels->sum('deliveryman_due') }} </th>
                                <th> </th>
                                {{-- <th> </th> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{ $parcels->links() }}
            </div>
        </div>
    </div>
@endsection
