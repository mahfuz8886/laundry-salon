@extends('frontEnd.layouts.pages.agent.agentmaster')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('content')
    <section class="section-padding dashboard-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="stats-reportList-inner">
                        <div class="row">
                            <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
                                <a href="{{ url('agent/parcels') }}">
                                    <div class="stats-reportList bg-dark">
                                        <div class="stats-per-item">
                                            <h5>@lang('common.total_parcel')</h5>
                                            <h3>{{ $totalparcel }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
                                <a href="{{ url('agent/parcels?parcel_type=deliverd') }}">
                                    <div class="stats-reportList bg-success">
                                        <div class="stats-per-item">
                                            <h5>@lang('common.total_delivered')</h5>
                                            <h3>{{ $totaldelivery }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
                                <a href="{{ url('agent/parcels?parcel_type=hold') }}">
                                    <div class="stats-reportList bg-secondary">
                                        <div class="stats-per-item">
                                            <h5>@lang('common.total_hold')</h5>
                                            <h3>{{ $totalhold }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
                                <a href="{{ url('agent/parcels?parcel_type=cancelled') }}">
                                    <div class="stats-reportList bg-warning">
                                        <div class="stats-per-item">
                                            <h5>@lang('common.total_cancelled')</h5>
                                            <h3>{{ $totalcancel }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
                                <a href="{{ url('agent/parcels?parcel_type=return-pending') }}">
                                    <div class="stats-reportList bg-info">
                                        <div class="stats-per-item">
                                            <h5>@lang('common.return_pending')</h5>
                                            <h3>{{ $returnpendin }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- col end -->
                            <div class="col-lg-4 colo-md-4 col-sm-4 col-6">
                                <a href="{{ url('agent/parcels?parcel_type=return-to-merchant') }}">
                                    <div class="stats-reportList bg-danger">
                                        <div class="stats-per-item">
                                            <h5>@lang('common.return_to_merchant')</h5>
                                            <h3>{{ $returnmerchant }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- col end -->
                        </div>
                    </div>
                    <!-- dashboard payment -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>@lang('common.parcel_statistics')</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                @foreach ($parceltypes as $parceltype)
                    '{{ $parceltype->title }}',
                @endforeach],
                datasets: [{
                    label: 'Parcel Statistics',
                    backgroundColor: ['#1D2941', '#5F45DA', '#670A91', '#096709', '#FFAC0E', '#AAB809',
                        '#2094A0', '#9A8309', '#C21010'
                    ],
                    borderColor: ['#1D2941', '#5F45DA', '#670A91', '#096709', '#FFAC0E', '#AAB809',
                        '#2094A0', '#9A8309', '#C21010'
                    ],
                    @foreach ($parceltypes as $parceltype)
                        @php
                            $parcelcount = App\Parcel::where(['status' => $parceltype->id, 'agentId' => Session::get('agentId')])->count();
                        @endphp {{ $parcelcount }},
                    @endforeach]
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@endsection
