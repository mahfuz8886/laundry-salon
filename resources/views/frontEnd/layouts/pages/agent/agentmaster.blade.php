<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Sensor Courier | @yield('title', 'Move Everywhere')</title>
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
    @yield('style')
</head>

<body>
    @php
        $agentInfo = App\Agent::find(Session::get('agentId'));
    @endphp
    <section class="mobile-menu ">
        <div class="swipe-menu default-theme">
            <div class="postyourad">
                <a href="{{ url('merchant/dashboard') }}">
                    @foreach ($whitelogo as $key => $value)
                        <img src="{{ asset($value->image) }}" alt="Your logo" />
                    @endforeach
                </a>
                <a href="{{ url('agent/dashboard') }}" class="mobile-username">{{ $agentInfo->names }}</a>
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
                    <li>
                        <a href="{{ url('agent/dashboard') }}">@lang('common.dashborad')</a>
                    </li>
                    <li>
                        <a href="{{ url('agent/assignable-parcels') }}" class="agent_assignable_parcels">
                        @lang('common.my_assignable_parcel')
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('agent/parcels') }}" class="mcreate_parcel">
                        @lang('common.parcel')
                        </a>
                    </li>
                    <li><a href="{{ url('agent/logout') }}" class="agent-logout">@lang('common.logout')</a>
                    </li>
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
                        <p>{{ $agentInfo->name }}: {{ $agentInfo->id }}</p>
                    </div>
                </div>
                <div class="side-list">
                    <ul>
                        <li>
                            <a href="{{ url('/agent/dashboard') }}" class="text-left @yield('dashboard')">
                                <div class="dashboard-button"><i class="fa fa-home"></i> &nbsp; @lang('common.dashborad')</div>

                            </a>
                        </li>
                        <li>
                            <a href="{{ url('agent/assignable-parcels') }}" class="text-left  @yield('agent_assignable_parcels')">
                                <div class="dashboard-button"><i class="fa fa-car"></i> &nbsp; @lang('common.my_assignable_parcel') </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('agent/parcels') }}" class="text-left @yield('my_parcels')">
                                <div class="dashboard-button"><i class="fa fa-car"></i> &nbsp; @lang('common.parcel') </div>

                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ url('agent/profile/settings') }}">
                                <div class="list-icon"><i class="fa fa-cogs"></i></div>
                                Settings
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ url('agent/logout') }}" class="text-left">
                                <div class="dashboard-button"><i class="fa fa-sign-out-alt"></i> &nbsp; @lang('common.logout') </div>

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
                                        <form action="{{ url('/agent/parcel/track') }}" method="POST">
                                            @csrf
                                            <input class="form-control" type="text" name="trackid"
                                                placeholder="Search your track number..." search>
                                            <button>Submit</button>
                                        </form>
                                    </div>

                                </li> --}}
                                <li class="profile-area" style="margin-right: 0px !important;">
                                    <div class="profile">
                                        <a class=""><img
                                                src="{{ asset('public/frontEnd') }}/images/avator.png" alt="">

                                        </a>
                                        <ul>
                                            {{-- <li><a href="{{ url('agent/profile/edit') }}">Setting</a></li> --}}
                                            <li><a href="{{ url('agent/logout') }}">Logout</a></li>
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
            $('.select2').select2();
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
</body>

</html>
