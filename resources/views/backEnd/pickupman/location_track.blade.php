<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title> Pickupman Current Location </title>
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet"
        href="{{ asset('public/backEnd/') }}/plugins/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('public/backEnd/') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('public/backEnd/') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <style>
        .btn-for-sms-dropdown:active,
        .btn-for-sms-dropdown:hover,
        .btn-for-sms-dropdown:focus {
            transform: rotate(180deg);
            color: blue;

        }

        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active,
        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus,
        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
            background-color: #000000;
            color: #ffffff;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
    </style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link"><i class="far fa-clock"></i>
                        <?php echo date('D'); ?> <?php echo date('d M Y'); ?> <span id="time" class="time"></span></a>
                </li>
                <!-- nav item end -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" target="_blank" class="nav-link"><i class="fa fa-globe"></i>
                        @lang('common.website')</a>
                </li>
                <!-- nav item end -->
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item has-treeview">
                    <a class="nav-link anchor" title="Screen Lock">
                        <i class="fas fa-lock"></i>
                    </a>
                </li>
                <!-- nav item end -->
                <li class="nav-item has-treeview">
                    <a id="goFS" class="nav-link anchor" title="Full Screen">
                        <i class="fas fa-expand"></i>
                    </a>
                </li>
                <!-- nav item end -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('password/change') }}" class="nav-link" title="Change Password">
                        <i class="fas fa-key"></i>
                    </a>
                </li>
                <!-- nav item end -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('logout') }}" title="Logout"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
                <li style="padding-right: 10px;">
                    <div style="display: flex;justify-content: end;height: 100%;align-items: center;">
                        @if (Session::get('locale') == 'en')
                            <a href="{{ url('locale/bn') }}" class="mlang text-light"><i class="fas fa-globe" aria-hidden="true"></i> বাংলা</a>
                        @else
                            <a href="{{ url('locale/en') }}" class="mlang text-light"><i class="fas fa-globe" aria-hidden="true"></i> English</a>
                        @endif
                    </div>
                </li>
                <!-- nav item end -->
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/superadmin/dashboard') }}" class="brand-link">
                <span class="brand-text text-success font-weight-light">Sensor Courier</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="user-image">
                        <img src="{{ asset(auth::user()->image) }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="user-info">
                        <a href="#" class="d-block">{{ auth::user()->name }}</a>
                        <i class="fas fa-circle"></i>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                @include('backEnd.layouts.left_sidebar')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper" style="padding: 25px;border-radius:5px">
            <div id="map"></div>
        </div>
        <footer class="main-footer">
            <strong>Copyright Sensor Courier. Design Development by &copy;<a href="https://www.onepointitbd.com"
                    target="_blank">One Point IT Solution</a></strong>
            All rights reserved.
        </footer>
      </div>
    

    <!-- jQuery -->
    <script src="{{ asset('public/backEnd/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/backEnd/') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/backEnd/') }}/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/dist/js/adminlte.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/backEnd/') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('public/backEnd/') }}/plugins/fastclick/fastclick.js"></script>
    <!-- Datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('public/backEnd/') }}/dist/js/demo.js"></script>
    <script>
        function initMap() {
            $.ajax({
                method: "GET",
                url: "{{ url('admin/pickupman/get-pickupmans') }}",
            }).done(function( response ) {
                // console.log(response);
                var myLatLng = {lat: 23.684994, lng: 90.356331};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: myLatLng
                });
                response.forEach(function(position){
                    // console.log(position['longitude']);
                    if(position['latitude'] !=null && position['longitude']!=null){
                        var marker = new google.maps.Marker({
                            position: {
                                'lat' : parseFloat(position['latitude']),
                                'lng' : parseFloat(position['longitude'])
                            },
                            map: map,
                            title: position['name'],
                            animation: google.maps.Animation.BOUNCE
                        });
                    }
                });

            });
        }

    </script>
    <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwHTmBRUNZ0ooOf5xiRzofXwQQ-h7Afgc&callback=initMap">
    </script>


  </body>