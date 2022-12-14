<!DOCTYPE html>
<html lang="zxx">

<head>
    <title> Pickupman | @yield('title', 'Move Everywhere')</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Startup Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->
    @foreach ($whitelogo as $wlogo)
        <link rel="shortcut icon" href="{{ asset($wlogo->image) }}">
    @endforeach
    <!-- Custom-Files -->
    <link rel="stylesheet" href="{{ asset('public/frontEnd') }}/css/bootstrap4.min.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="{{ asset('public/frontEnd') }}/css/merchant.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd') }}/css/swiper-menu.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 35px;
        }
    </style>
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <!-- Style-CSS -->
    <link href="{{ asset('public/frontEnd') }}/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //Custom-Files -->
    <script src="{{ asset('public/frontEnd/') }}/js/jquery_3.4.1_jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    @yield('styles')
</head>

<body>
    @php
        $pickupmanInfo = App\Pickupman::find(Session::get('pickupmanId'));
    @endphp
    <section class="mobile-menu ">
        <div class="swipe-menu default-theme">
            <div class="postyourad">
                <a href="{{ url('merchant/dashboard') }}">
                    @foreach ($whitelogo as $key => $value)
                        <img src="{{ asset($value->image) }}" alt="Your logo" />
                    @endforeach
                </a>
                <a href="{{ url('pickupman/dashboard') }}" class="mobile-username">{{ $pickupmanInfo->names }}</a>
            </div>
            <!--Navigation Icon-->
            <div class="nav-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="codehim-nav">
                <ul class="menu-item">
                    <li>
                        <a href="{{ url('/') }}" class=""> @lang('common.website') </a>
                    </li>
                    <li><a href="{{ url('pickupman/dashboard') }}">@lang('common.dashborad')</a>
                    </li>
                    <li>
                        <a href="{{ url('pickupman/parcels') }}" class="mcreate_parcel">
                        @lang('common.orders')
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ url('pickupman/multipickup-parcels') }}" class="mcreate_parcel">
                            @lang('common.multiple_pickup_parcels')
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pickupman/payments/all') }}" class="mcreate_parcel">
                        @lang('common.payments')
                        </a>
                    </li>
                    <li><a href="{{ url('pickupman/logout') }}" class="agent-logout">@lang('common.logout')</a>
                    </li> --}}
                </ul>
                <!--//Tab-->
            </nav>
        </div>
    </section>
    <!-- mobile menu end -->
    <section class="main-area">
        <div class="dash-sidebar">
            <div class="sidebar-inner">
                <div class="profile-inner">
                    <div class="profile-pic">
                        <a href="#"><img src="{{ asset('public/frontEnd') }}/images/avator.png" alt=""></a>
                    </div>
                    <div class="profile-id">
                        <p>{{ $pickupmanInfo->name }}: {{ $pickupmanInfo->id }}</p>
                    </div>
                    {{-- <div class="dashboard-button">
                        <a href="{{ url('pickupman/dashboard') }}">@lang('common.dashborad')</a>
                    </div> --}}
                </div>
                <div class="side-list">
                    <ul>
                        <li>
                            <a href="{{ url('/pickupman/dashboard') }}" class="text-left @yield('dashboard')">
                                <div class="dashboard-button"><i class="fa fa-home"></i> &nbsp; @lang('common.dashborad') </div>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ url('pickupman/pending-parcels') }}" class="text-left @yield('pending_parcels')">
                                <div class="dashboard-button"><i class="fa fa-car"></i> &nbsp; @lang('common.my_assignable_parcel')
                                </div>

                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ url('pickupman/parcels') }}" class="text-left @yield('parcels')">
                                <div class="dashboard-button"><i class="fas fa-shopping-cart"></i> &nbsp; @lang('common.orders')</div>

                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ url('pickupman/multipickup-parcels') }}" class="text-left @yield('multipickup_parcels')">
                                <div class="dashboard-button"><i class="fa fa-car"></i> &nbsp; @lang('common.multiple_pickup_parcels') </div>

                            </a>
                        </li>
                        <li>
                            <a href="{{ url('pickupman/payments/all') }}" class="text-left @yield('my_payments')">
                                <div class="dashboard-button"><i class="fa fa-car"></i> &nbsp; @lang('common.payments')</div>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="{{ url('pickupman/profile/settings') }}">
                                <div class="dashboard-button"><i class="fa fa-cogs"></i> &nbsp; </div>
                                Settings
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ url('pickupman/logout') }}" class="text-left">
                                <div class="dashboard-button"><i class="fa fa-sign-out-alt"></i> &nbsp; @lang('common.logout')</div>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->
        <div class="dashboard-body">
            <div class="heading-bar">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="pik-inner">
                            <ul>
                                <li>
                                    <a href="{{ url('/') }}" class="btn btn-sm btn-primary mt-3"> @lang('common.website') </a>
                                </li>
                                {{-- <li>
                                    <div class="dash-logo">
                                        @foreach ($whitelogo as $key => $value)
                                            <a href="{{ url('merchant/dashboard') }}"><img
                                                    src="{{ asset($value->image) }}" alt=""></a>
                                        @endforeach
                                    </div>

                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="heading-right">
                            <ul>
                                {{-- <li>
                                    <div class="track-area">
                                        <form action="{{ url('/pickupman/parcel/track') }}" method="POST">
                                            @csrf
                                            <input class="form-control" type="text" name="trackid"
                                                placeholder="Search your track number..." search>
                                            <button>Submit</button>
                                        </form>
                                    </div>

                                </li> --}}
                                <li class="nav-item has-treeview">
                                    <a href="{{ url('pickupman/parcels') }}" class="nav-link" title="All orders">
                                        <i class="fas fa-bell"><sup class="notification"></sup></i>
                                    </a>
                                </li> 
                                <li class="profile-area" style="margin-right: 0px !important;">
                                    <div class="profile">
                                        <a class=""><img
                                                src="{{ asset('public/frontEnd') }}/images/avator.png" alt="">

                                        </a>
                                        <ul>
                                            {{-- <li><a href="{{ url('pickupman/profile/edit') }}">Setting</a></li> --}}
                                            <li><a href="{{ url('pickupman/logout') }}">@lang('common.logout')</a></li>
                                        </ul>
                                    </div>

                                </li>
                                <li style="margin-right: 0px !important;">
                                    <div style="display: flex;justify-content: end;height: 100%;align-items: center;">
                                        @if (Session::get('locale') == 'en')
                                            <a href="{{ url('locale/bn') }}" class="mlang text-primary"><i class="fas fa-globe" aria-hidden="true"></i> ???????????????</a>
                                        @else
                                            <a href="{{ url('locale/en') }}" class="mlang text-primary"><i class="fas fa-globe" aria-hidden="true"></i> English</a>
                                        @endif
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main-body">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
            <!-- Column End-->
        </div>
    </section>

    <!--Next Day Pick Modal end -->
    <script type="text/javascript" src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/swiper-menu.js"></script>
    <script src="{{ asset('public/backEnd/') }}/dist/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <!-- Datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('public/backEnd/') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('public/backEnd/') }}/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    @yield('script')
    <!-- Web-Fonts -->
    <script>
        $(function() {
            $('.select2').select2();
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: 'Electronics',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Chrome',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [{
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = $.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            var stackedBarChart = new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })
        })
    </script>
    <script>
        function calculate_result() {
            $.ajax({
                type: "GET",
                url: "{{ url('cost/calculate/result') }}",
                dataType: "html",
                success: function(deliverycharge) {
                    $('.calculate_result').html(deliverycharge)
                }
            });
        }
        $('.calculate').on('keyup paste click', function() {
            var cod = $('.cod').val();
            var weight = $('.weight').val();
            if (cod, weight) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    url: "{{ url('cost/calculate') }}/" + cod + '/' + weight,
                    dataType: "json",
                    success: function(deliverycharge) {
                        return calculate_result();
                    }
                });
            }
        });
    </script>
    <script>
        flatpickr(".flatDate", {});
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'Csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },

                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print all',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    },
                    {
                        extend: 'colvis',
                    },

                ],
                select: true
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{-- fetch new orders --}}
    <script>
        var audioUrl = "{{asset('public/music/notification.mp3')}}";
        var audio = new Audio(audioUrl);
        var newOrder = document.querySelector('.notification');
        var url = "{{route('pickupman.laundry.getNewAssignOrders')}}";
        // console.log(url);
        async function callApi() {
            var res = await fetch(url, {
                Method: 'GET'
            });
            var data = await res.json();
            if(data.total > 0) {
                audio.autoplay = true; 
                audio.play();
                newOrder.innerText = data.total;
            }
           
        }
        const timerVariable = setInterval(() => {
            callApi();
        }, 3000);
    </script>
</body>

</html>
