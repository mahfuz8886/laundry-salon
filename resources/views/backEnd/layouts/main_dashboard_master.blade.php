<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laundry || @yield('title', 'Dashbaord')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/frontEnd/') }}/images/faveicon.png">
    <!-- fabeicon css -->
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
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/summernote/summernote-bs4.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/select2/css/select2.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/owlcarousel/owl.theme.default.min.css">
    <!-- owl.theme.default.min -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- flatpickr -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/toastr.min.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        @media (min-width: 576px){
            .content-wrapper, .main-footer, .main-header {
                transition: margin-left .3s ease-in-out;
                margin-left: 0px !important;
                z-index: 3000;
            }
        }

        .wrapper {
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .dash-card {
            transition: .3s all;
            margin: 15px;
        }

        .dash-card:hover {
            transform: scale(1.08);
        }

    </style>
</head>

<body onload="startTime()" style="background: url({{ asset('public/'.$setting->mainbg) }});">
    <div class="wrapper" >
        {{-- navbar --}}
        <nav class="navbar navbar-expand-sm navbar-light bg-light" style="box-shadow: 0px 0px 10px #d9d9d9;">
            <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{ asset($setting->logo) }}" width="30" height="30" alt="">
              <span><b>Laundry</b></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a href="{{ url('/') }}" class="nav-link"><i class="far fa-clock"></i>
                      <?php echo date('D'); ?> <?php echo date('d M Y'); ?> <span id="time" class="time"></span></a>
                </li>
                <li class="nav-item active">
                  <a href="{{ url('/') }}" target="_blank" class="nav-link"><i class="fa fa-globe"></i>
                      @lang('common.website')</a>
                </li>
              </ul>
              <div class="form-inline my-2 my-lg-0 ml-auto">
                <a href="{{ route('logout') }}" title="Logout"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        @lang('common.logout')
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
            </div>
        </nav>
        {{-- navbar --}}

        <div class="content-wrapper">
            @yield('content')
        </div>

        {{-- <footer class="main-footer">
            <strong>Copyright Laundry. Design Development by &copy;<a href="https://www.onepointitbd.com"
                    target="_blank">One Point IT Solution</a></strong>
            All rights reserved.
        </footer> --}}

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
        <!-- Summernote -->
        <script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
        </script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('public/backEnd/') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- FastClick -->
        <script src="{{ asset('public/backEnd/') }}/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('public/backEnd/') }}/plugins/owlcarousel/owl.carousel.min.js"></script>
        <!-- Datatable -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
        <!-- flatpicker -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            $(function() {
                flatpickr("#flatpicker", {
                    minDate: "today",
                });
            })
        </script>
        <script>
            flatpickr(".flatDate", {});
        </script>
        <script>
            flatpickr(".mydatesNew", {});
        </script>
        <script src="{{ asset('public/backEnd/') }}/plugins/select2/js/select2.full.min.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('public/backEnd/') }}/plugins/chart.js/Chart.min.js"></script>
        <script src="{{ asset('public/backEnd/') }}/plugins/sparklines/sparkline.js"></script>
        <script src="{{ asset('public/backEnd/') }}/dist/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        <script src="{{ asset('public/backEnd/') }}/dist/js/demo.js"></script>

        @yield('script')
        <!-- ChartJS -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2();
                $('.multi_select2').select2({
                    closeOnSelect: false,
                });

                $('#example1').DataTable({
                    "paging": true,
                    "lengthMenu": [
                        [10, 25, 50, 100, 200, -1],
                        [10, 25, 50, 100, 200, "All"]
                    ],
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    search: {
                        regex: false,
                        smart: false
                    }

                });

                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "lengthMenu": [
                        [10, 25, 50, 100, 200, -1],
                        [10, 25, 50, 100, 200, "All"]
                    ],
                    search: {
                        regex: false,
                        smart: false
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'pageLength',
                        'colvis',
                        {
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                    ],
                });


                $(document).ready(function() {
                    $('#example3').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "{{ url('server-side') }}",
                        search: {
                            regex: false,
                            smart: false
                        }
                    });
                });



            })
        </script>
        <script type="text/javascript">
            $("#search_data").on('keyup', function() {
                var keyword = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ url('/') }}/search_data/" + keyword,
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        console.log(data);
                        $("#live_data_show").html('');
                        $("#live_data_show").html(data);
                    }
                });
            });
        </script>
        <script>
            function percelDelivery(that) {
                if (that.value == "4") {
                    document.getElementsByClassName("customerpaid").style.display = "block";
                } else {
                    document.getElementsByClassName("customerpaid").style.display = "none";
                }
            }
        </script>
        <script>
            function myPrintFunction() {
                window.print();
            }
        </script>
        <script>
            jQuery("#My-Button").click(function() {
                jQuery(':checkbox').each(function() {
                    if (this.checked == true) {
                        this.checked = false;
                    } else {
                        this.checked = true;
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'pageLength',
                        {
                            extend: 'copy',
                            text: 'Copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                            }
                        },
                        {
                            extend: 'excel',
                            text: 'Excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                            }
                        },
                        {
                            extend: 'csv',
                            text: 'Csv',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                            }
                        },

                        {
                            extend: 'print',
                            text: 'Print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
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
                    select: true,
                    search: {
                        regex: false,
                        smart: false
                    }
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
        </script>
        <!-- page script -->
        <script>
            $(function() {
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
                var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
                var lineChartData = jQuery.extend(true, {}, areaChartData)
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
                var barChartData = jQuery.extend(true, {}, areaChartData)
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
                var stackedBarChartData = jQuery.extend(true, {}, barChartData)

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
            });

            var a_sms_form = $('.sms-form');
            var sms_lists = $('.sms-lists');
            $('.show-form').click(function() {
                a_sms_form.show();
                sms_lists.hide();
            })
            $('.show-list').click(function() {
                a_sms_form.hide();
                sms_lists.show();
            })






            $('body').on('click', '.modal_data_active', function() {
                var priceId = $(this).attr('P_id');
                var Picked_id = $(this).attr('Picked_id');
                var Paid_id = $(this).attr('paid_id');

                var return_id = $(this).attr('return_id');
                var segment = $(this).attr('segment');
                var start_date = $(this).attr('start_date');
                var end_date = $(this).attr('end_date');
                var title = $(this).attr('order_title');
                $('.modal_title_parcel').html(title);


                $('.priceModal_Body').html(
                    '<div class="text-center"><div class="spinner-grow text-danger" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>'
                );


                if (typeof(Picked_id) != "undefined") {
                    $.ajax({
                        method: "GET",
                        url: "{{ url('superadmin/') }}/" + segment + "?Picked_id=" + Picked_id +
                            '&start_date=' + start_date + '&end_date=' + end_date,
                        dataType: 'json',
                        success: function(response) {
                            $('.priceModal_Body').html(response.dataTable);
                            console.log(response.mainData);
                        }
                    })
                }




                if (typeof(Paid_id) != "undefined") {
                    $.ajax({
                        method: "GET",
                        url: "{{ url('superadmin/') }}/" + segment + "?Paid_id=" + Paid_id + '&start_date=' +
                            start_date + '&end_date=' + end_date,
                        dataType: 'json',
                        success: function(response) {
                            $('.priceModal_Body').html(response.dataTable);
                            console.log(response.mainData);
                        }
                    })
                }




                if (typeof(priceId) != "undefined") {
                    $.ajax({
                        method: "GET",
                        url: "{{ url('superadmin/') }}/" + segment + "?priceId=" + priceId + '&start_date=' +
                            start_date + '&end_date=' + end_date,
                        dataType: 'json',
                        success: function(response) {
                            $('.priceModal_Body').html(response.dataTable);
                            console.log(response.mainData);
                        }
                    })
                }

                if (typeof(return_id) != "undefined") {
                    $.ajax({
                        method: "GET",
                        url: "{{ url('superadmin/') }}/" + segment + "?return_id=" + return_id +
                            '&start_date=' + start_date + '&end_date=' + end_date,
                        dataType: 'json',
                        success: function(response) {
                            $('.priceModal_Body').html(response.dataTable);
                            console.log(response.mainData);
                        }
                    })
                }




            });


            $('.readbtn').click(function() {
                var rootData = $(this).attr('sms_data');
                alert(rootData);
            });

            //add parcel event
            $(document).ready(function() {
                $('.percelType').change(function() {
                    const ptype = $('.percelType').val();

                    const prepaid =
                        '<div class="form-group"><label for="name">Actual Price</label><input type="number"  value="" class="form-control actual_price-value"  name="actual_price" placeholder="Actual Price" required></div>';
                    const cod =
                        '<div class="form-group"><label for="name">COD amount</label><input type="number" max="5000" class="calculate cod form-control{{ $errors->has('cod') ? ' is-invalid' : '' }}" value="{{ old('cod') }}" name="cod" min="0" placeholder="COD Amount" required>
                    @if ($errors->has('cod'))
                        <
                        span class = "invalid-feedback" > < strong > {{ $errors->first('cod') }} <
                            /strong></span >
                    @endif <
                    /div>';

                    if (ptype == 1) {
                        $('.amount_input').empty();
                        $('.amount_input').append(prepaid);
                    } else {
                        $('.amount_input').empty();
                        $('.amount_input').append(cod);
                    }
                });
            });
        </script>
</body>

</html>
