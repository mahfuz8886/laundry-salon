 <!--
Theme Name: One Point It Solutions
Author: One point it solutions
Author URI: https://www.onepointitbd.com/;
Description: One point It solutions  maintain standard quality for Website and Creative Design
Version: 65.0.0
-->
 <!DOCTYPE html>
 <html lang="zxx">

 <head>
     <title>Sensor Courier </title>
     <!-- Meta tag Keywords -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="UTF-8" />
     <!-- //Meta tag Keywords -->
     @foreach ($whitelogo as $wlogo)
         <link rel="shortcut icon" href="{{ asset($wlogo->image) }}">
     @endforeach
     <!-- Custom-Files -->
     <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/bootstrap.css">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <style>
         .select2-container .select2-selection--single {
             height: 35px;
         }

     </style>
     <!-- Bootstrap-Core-CSS -->
     <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/assets/css/owl.carousel.min.css">
     <!-- Bootstrap-Core-CSS -->
     <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/assets/css/owl.theme.css">
     <!-- Bootstrap-Core-CSS -->
     <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/toastr.min.css">
     <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/style.css" type="text/css" media="all" />
     <!-- Style-CSS -->
     <link href="{{ asset('public/frontEnd/') }}/css/font-awesome.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.css">
     <!-- Font-Awesome-Icons-CSS -->
     <!-- //Custom-Files -->
     <!-- Web-Fonts -->
     <link
         href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext"
         rel="stylesheet">
     <!-- //Web-Fonts -->
     <style>
         select.form-control:not([size]):not([multiple]) {
             height: calc(2.25rem + 5px);
         }

         .header {
             background: rgb(175, 138, 84);
             background: linear-gradient(90deg, rgba(175, 138, 84, 1) 0%, rgba(41, 147, 57, 1) 66%, rgba(0, 212, 255, 1) 100%);
             border-bottom: 1px solid #289239;
         }

         .container-fluid {
             width: 100%;
             padding-right: 0px;
             padding-left: 0px;
             margin-right: 0;
             margin-left: 0;
         }

         #logo img {
             border-radius: 50%;
         }

         .quicktech-traking {
             min-width: 50%;
             background: transparent;
             padding: 10px;
             margin-top: 0px;
             border-radius: 5px;
         }

         .postyourad.mLang {
             position: absolute;
             left: 52%;
             top: 70px;
             border: 0px solid #000;
             padding: 3px;
             border-radius: 5px;
             display: none;
         }

         .postyourad.mLang a:hover {
             color: red;
         }

         .mLogin {
             border: 0px solid #dddddd;
         }

         .phoneIcon {
             margin-right: 50px;
         }

     </style>
     <link href="{{ asset('public/frontEnd/') }}/css/footer.css" rel="stylesheet">
     @yield('style')
     <link href="{{ asset('public/frontEnd/') }}/css/responsive.css" rel="stylesheet">
 </head>

 <body>
    <!-- main banner -->

    <div class="main-top" id="home">
        <!-- header -->
        <div class="header-address d-flex justify-content-center align-items-center bg-custome-green">
            <span class="p-2 text-light"> <i class="fa fa-envelope text-warning drop-anim"></i> {{ $setting->email }}</span>
            <span class="p-2 text-light"> <i class="fa fa-phone text-warning drop-anim"></i> {{ $setting->mobile_no }}</span>
        </div>

        <header>
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand text-success" href="{{ url('/') }}">
                        <img style="width: 55px;" src="{{ asset($setting->logo) }}" alt="Sensor Courier">  
                        @lang('common.sensor_courier')
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">@lang('common.home')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" data-target=".tracking-area" href="javascript::void">@lang('common.track_parcel')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#hub-address">@lang('common.hub_address')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services">@lang('common.our_features')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#our-services">@lang('common.our_services')</a>
                            </li>

                        </ul>
                        <div class="form-inline">
                            @if (Auth::user())
                                <li class="mLogin mt-2 btn btn-sm btn-danger">
                                    <a href="{{ url('superadmin/main_dashboard') }}">
                                        @lang('common.my_account')
                                    </a>
                                </li>
                            @elseif(Session::get('merchantId'))
                                <li class="mLogin mt-2 btn btn-sm btn-danger">
                                    <a href="{{ url('merchant/dashboard') }}">
                                        @lang('common.my_account')
                                    </a>
                                </li>
                            @elseif(Session::get('deliverymanId'))
                                <li class="mLogin mt-2 btn btn-sm btn-danger">
                                    <a href="{{ url('deliveryman/dashboard') }}">
                                        @lang('common.my_account')
                                    </a>
                                </li>
                            @elseif(Session::get('agentId'))
                                <li class="mLogin mt-2 btn btn-sm btn-danger">
                                    <a href="{{ url('agent/dashboard') }}">
                                        @lang('common.my_account')
                                    </a>
                                </li>
                            @endif
                            <a href="{{ url('user/login') }}" class="mLogin mt-2 btn btn-sm btn-danger">
                                @lang('common.login')
                            </a>

                            @if (Session::get('locale') == 'en')
                                <a href="{{ url('locale/bn') }}" class="mLogin mt-2"><i
                                        class="fa fa-language" aria-hidden="true"></i> বাংলা</a>
                            @else
                                <a href="{{ url('locale/en') }}" class="mLogin mt-2"><i
                                        class="fa fa-language" aria-hidden="true"></i> EN</a>
                            @endif

                            <!-- <input type="checkbox" id="drop" /> -->
                            <ul class="menu">
                                @if (Auth::user())
                                    <li class="login">
                                        <a href="{{ url('superadmin/main_dashboard') }}">
                                            @lang('common.my_account')
                                        </a>
                                    </li>
                                @elseif(Session::get('merchantId'))
                                    <li class="login">
                                        <a href="{{ url('merchant/dashboard') }}">
                                            @lang('common.my_account')
                                        </a>
                                    </li>
                                @elseif(Session::get('deliverymanId'))
                                    <li class="login">
                                        <a href="{{ url('deliveryman/dashboard') }}">
                                            @lang('common.my_account')
                                        </a>
                                    </li>
                                @elseif(Session::get('agentId'))
                                    <li class="login">
                                        <a href="{{ url('agent/dashboard') }}">
                                            @lang('common.my_account')
                                        </a>
                                    </li>
                                @else
                                    <li class="register">
                                        <a href="{{ url('merchant/register') }}">
                                            @lang('common.merchant_register')
                                        </a>
                                    </li>
                                @endif

                                <li class="login">
                                    <a href="{{ url('user/login') }}">
                                        @lang('common.login')
                                    </a>
                                </li>
                                <li>
                                    <div class="postyourad mlanghide">
                                        @if (Session::get('locale') == 'en')
                                            <a href="{{ url('locale/bn') }}" class="mlang"><i
                                                    class="fa fa-language" aria-hidden="true"></i> বাংলা</a>
                                        @else
                                            <a href="{{ url('locale/en') }}" class="mlang"><i
                                                    class="fa fa-language" aria-hidden="true"></i> EN</a>
                                        @endif
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="tracking-wrapper">
                    <div class="quicktech-traking tracking-area collapse">
                        <form action="{{ url('/track/parcel/') }}" method="POST"
                            class="quicktech-traking-wthree pt-2">
                            @csrf
                            <div class="d-flex quicktech-traking-wthree-field">
                                <input class="form-control w-75" type="text" placeholder="@lang('common.parcel_id')" name="trackparcel"
                                    required="">

                                <button class="quicktech-btn w-50 " type="submit"><span class="fa fa-map-marker"></span>
                                @lang('common.track_parcel')
                                </button>
                            </div>
                        </form>
                        <div class="remove-icon-wrapper">
                            <i class="fa fa-remove track-remover" data-toggle="collapse" data-target=".tracking-area"></i>
                        </div>
                    </div>
                </div>

            </div>
        </header>
        <!-- //header -->
    </div>

        @yield('content')

        <!--footer starts from here-->
        <footer class="footer">
            <div class="container bottom_border">
                <div class="row">
                    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2"> @lang('common.important_link') </h5>
                        <ul class="footer_ul_amrc">
                            @foreach ($pagelistleft as $key => $value)
                                <li><a
                                        href="{{ url('/pages/' . $value->slug . '/' . $value->id) }}">@lang('createpage.name' . $value->id)</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2"> @lang('common.qr_code') </h5>
                        <a href="#" download="" style="max-height: 150px">
                            <img src="{{ asset('public/') }}/qr_code.jpeg" height="100" class="img-fluid "
                                style="max-height: 100px !important">
                        </a>
                        <!--headin5_amrc-->
                        {{-- <ul class="footer_ul_amrc">
                        @foreach ($pagelistright as $key => $value)
                            <li>
                                <a href="{{ url('/pages/' . $value->slug . '/' . $value->id) }}">
                                    @lang('createpage.name'.$value->id)
                                </a>
                            </li>
                        @endforeach
                        </ul> --}}
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">@lang('common.contact') </h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                            <li>
                                <a href="#">
                                    {{ Session::get('locale') == 'bn' ? $setting->address_bn : $setting->address }}
                                </a>
                            </li>
                            <li><a href="#"> {{ $setting->email }} </a></li>
                            <li><a href="#"> {{ $setting->mobile_no }} </a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-12 col text-center">
                        <h5 class="headin5_amrc col_white_amrc pt2"> @lang('common.download_app')  </h5>
                        <ul class="text-center">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <a href="{{ asset('public/sensorcourier.apk') }}" download="sensorcourier.apk">
                                        <img src="{{ asset('public/') }}/playstore.png"
                                            class="img-fluid " style="border-radius: 0.5rem !important"
                                            height="100">
                                    </a> --}}
                                        <a href="https://play.google.com/store/apps/details?id=com.sensorcourier.scourier"
                                            target="_blank">
                                            <img src="{{ asset('public/') }}/playstore.png" class="img-fluid "
                                                style="border-radius: 0.5rem !important" height="100">
                                        </a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="social-icons-footer mb-md-0 mb-3">
                                            <br>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="{{ $setting->facebook ?? '' }}" target="_blank">
                                                        <span class="fa fa-facebook"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $setting->twitter ?? '' }}" target="_blank">
                                                        <span class="fa fa-twitter"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $setting->google_plus ?? '' }}" target="_blank">
                                                        <span class="fa fa-google-plus"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $setting->instagram ?? '' }}" target="_blank">
                                                        <span class="fa fa-instagram"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <!-- footer social icons -->

                            <!-- //footer social icons -->
                        </ul>
                    </div>
                </div>
            </div>


            <div class="container">
                <p class="text-center">
                    © <?= date('Y') ?> Sensor Courier. All rights reserved | Design & Developed By
                    <a href="https://www.onepointitbd.com/" target="_blank">
                        One Point IT Solutions.
                    </a>
                </p>
            </div>

        </footer>
    

    <!-- move to up button -->
    <div>
        <a href="#home" class="move-to-top text-center">
            <span class="fa fa-level-up text-light" aria-hidden="true"></span>
        </a>
    </div>

    <!-- jQuery, Bootstrap JS -->
    <script src="{{ asset('public/frontEnd/') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/dist/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    {!! Toastr::message() !!}
    @yield('script')

    <script>
        new WOW().init();
    </script>
    <script>
        $('.top_banner').owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            nav: false,
            autoplayHoverPause: false,
            margin: 0,
            smartSpeed: 1000,
            autoplayTimeout: 5000,
            mouseDrag: true,
        });
    </script>

    <script>
        $('.closebtn').click(function() {
            $('.top_banner').hide();
        })
    </script>

    <script>
        $('.ins_show').click(function() {
            $('.ins_pament').show();
            $('.bank').hide();
            $('.nagad').hide();
        })
        $('.ins_hide').click(function() {
            $('.ins_pament').hide();
            $('.nagad').hide();
        })
        $('#bank').click(function() {
            $('.bank').show();
            $('.ins_pament').hide();
            $('.nagad').hide();

        })
        $('#nagad').click(function() {
            $('.ins_pament').hide();
            $('.bank').hide();
            $('.nagad').show();
        })

        $(document).ready(function() {
            $(window).scroll(function(){
                var aTop = 400;
                if($(this).scrollTop()>=aTop){
                    $('.move-to-top').css('opacity','1');
                }else {
                    $('.move-to-top').css('opacity','0');
                }
            });
        });


    </script>

 </body>

 </html>
