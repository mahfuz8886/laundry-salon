<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>@yield('title') | Laundry</title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        {{-- <link rel="shortcut icon" href="../../favicon.png"> --}}

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/font-awesome/css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/css/font-electro.css')}}">

        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/animate.css/animate.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/hs-megamenu/src/hs.megamenu.css')}}">
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
        
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/fancybox/jquery.fancybox.css')}}">
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/ion-rangeslider/css/ion.rangeSlider.css')}}">
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/slick-carousel/slick/slick.css')}}">
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/toastr.min.css">
        <!-- CSS Electro Template -->
        <link rel="stylesheet" href="{{ asset('public/frontEnd/template/css/theme.css')}}">
    </head>

    <body>

        <!-- ========== HEADER ========== -->
        <header id="header" class="u-header u-header-left-aligned-nav">
            <div class="u-header__section">
                <!-- Topbar -->
                <div class="u-header-topbar py-2 d-none d-xl-block bg-light border-bottom-1">
                    <div class="container">
                        <div class="d-flex align-items-center">
                            <div class="topbar-left">
                                <a href="{{ url('/') }}" class="text-gray-70 font-size-13 u-header-topbar__nav-link">Welcome to {{ $setting->name }}</a>
                            </div>
                            <div class="topbar-right ml-auto">
                                <ul class="list-inline mb-0">
                                    {{-- <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-map-pointer mr-1"></i> Store Locator</a>
                                    </li>--}}
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border full-bg">
                                        <a href="#" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Track Your Order</a>
                                    </li>
                                    
                                    
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border full-bg">
                                        @if(Session::get('merchantId'))
                                            <a class="text-success" href="{{ url('merchant/dashboard') }}"> <i class="fa fa-home"></i> @lang('common.my_account')</a>
                                        @else
                                        <!-- Account Sidebar Toggle Button -->
                                        <span class="u-header-topbar__nav-link">
                                        <a class="text-success" href="https://laundryexp.com/login">Admin Login</a>
                                        <span>&nbsp|&nbsp</span>
                                        <a class="text-primary" href="https://laundryexp.com/pickupman/login">Pickupman Login</a>
                                        <span>&nbsp|&nbsp</span>
                                        <a class="text-secondary" href="https://laundryexp.com/deliveryman/login">Deliveryman Login</a>
                                        <span>&nbsp|&nbsp</span>
                                        <a class="text-info" href="{{ url('merchant/register') }}">Register</a>
                                        or <a class="text-success" href="{{ url('merchant/login') }}">Sign in</a></span>
                                        <!-- End Account Sidebar Toggle Button -->
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Topbar -->

                <!-- Logo-Search-header-icons -->
                <div class="py-2 py-xl-5 bg-light">
                    <div class="container my-0dot5 my-xl-0">
                        <div class="row align-items-center">
                            <!-- Logo-offcanvas-menu -->
                            <div class="col-auto">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                                    <!-- Logo -->
                                    <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ url('/') }}">
                                        <img style="width: 60px" class="img-fluid mr-1" src="{{asset($setting->logo)}}">
                                    </a>
                                    <!-- End Logo -->

                                    <!-- Fullscreen Toggle Button -->
                                    <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                        aria-controls="sidebarHeader"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarHeader1"
                                        data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInLeft"
                                        data-unfold-animation-out="fadeOutLeft"
                                        data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>
                                    <!-- End Fullscreen Toggle Button -->
                                </nav>
                                <!-- End Nav -->

                                <!-- ========== HEADER SIDEBAR ========== -->
                                <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                                    <div class="u-sidebar__scroller">
                                        <div class="u-sidebar__container">
                                            <div class="u-header-sidebar__footer-offset pb-0">
                                                <!-- Toggle Button -->
                                                <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                                    <button type="button" class="close ml-auto"
                                                        aria-controls="sidebarHeader"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                        data-unfold-event="click"
                                                        data-unfold-hide-on-scroll="false"
                                                        data-unfold-target="#sidebarHeader1"
                                                        data-unfold-type="css-animation"
                                                        data-unfold-animation-in="fadeInLeft"
                                                        data-unfold-animation-out="fadeOutLeft"
                                                        data-unfold-duration="500">
                                                        <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                                    </button>
                                                </div>
                                                <!-- End Toggle Button -->

                                                <!-- Content -->
                                                <div class="js-scrollbar u-sidebar__body">
                                                    <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                        <!-- Logo -->
                                                        <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="../home/index.html" aria-label="Electro">
                                                            {{-- sidemenu logo --}}
                                                        </a>
                                                        <!-- End Logo -->

                                                        <!-- List -->
                                                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                            @foreach ($categories as $item)
                                                               
                                                            <li>
                                                                <a class="u-header-collapse__nav-link" href="{{ url('/') }}">
                                                                    {{$item->cat_name}}
                                                                </a>
                                                            </li>
                                                            
                                                            @endforeach
                                                        </ul>
                                                        <!-- End List -->
                                                    </div>
                                                </div>
                                                <!-- End Content -->
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <!-- ========== END HEADER SIDEBAR ========== -->
                            </div>
                            <!-- End Logo-offcanvas-menu -->
                            
                            <!-- Primary Menu -->
                            <div class="col d-none d-xl-block">
                                <!-- Nav -->
                                <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                                    <!-- Navigation -->
                                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                        <ul class="navbar-nav u-header__navbar-nav">
                                            <!-- Home -->
                                            <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                                data-event="hover"
                                                data-animation-in="slideInUp"
                                                data-animation-out="fadeOut">
                                                <a id="HomeMegaMenu" class="nav-link u-header__nav-link" href="{{ url('/') }}" aria-haspopup="true" aria-expanded="false" aria-labelledby="HomeSubMenu">@lang('common.home')</a>
                                            </li>
                                            <!-- End Home -->

                                            <!-- Pages -->
                                            <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                data-event="click"
                                                data-animation-in="slideInUp"
                                                data-animation-out="fadeOut">
                                                <a id="pagesMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false">@lang('common.branch')</a>

                                                <!-- Home - Mega Menu -->
                                                <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="pagesMegaMenu">
                                                    <div class="row u-header__mega-menu-wrapper">
                                                        @foreach($hubs as $hub)
                                                        <div class="col-md-3">
                                                            <a href="{{ url('/') }}"><span class="u-header__sub-menu-title @if($hub->is_default) default-hub @else nondefault-hub @endif">{{ $hub->title }}</span></a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- End Home - Mega Menu -->
                                            </li>
                                            <!-- End Pages -->

                                            <!-- Blog -->
                                            <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                                data-event="hover"
                                                data-animation-in="slideInUp"
                                                data-animation-out="fadeOut">
                                                <a id="blogMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="blogSubMenu">Blog</a>

                                                <!-- Blog - Submenu -->
                                                <ul id="blogSubMenu" class="hs-sub-menu u-header__sub-menu" aria-labelledby="blogMegaMenu" style="min-width: 230px;">
                                                    <li><a class="nav-link u-header__sub-menu-nav-link" href="../blog/blog-v1.html">Blog v1</a></li>
                                                    <li><a class="nav-link u-header__sub-menu-nav-link" href="../blog/blog-v2.html">Blog v2</a></li>
                                                    <li><a class="nav-link u-header__sub-menu-nav-link" href="../blog/blog-v3.html">Blog v3</a></li>
                                                    <li><a class="nav-link u-header__sub-menu-nav-link" href="../blog/blog-full-width.html">Blog Full Width</a></li>
                                                    <li><a class="nav-link u-header__sub-menu-nav-link" href="../blog/single-blog-post.html">Single Blog Post</a></li>
                                                </ul>
                                                <!-- End Submenu -->
                                            </li>
                                            <!-- End Blog -->

                                            <!-- About us -->
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="about.html">About us</a>
                                            </li>
                                            <!-- End About us -->

                                            <!-- FAQs -->
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="faq.html">FAQs</a>
                                            </li>
                                            <!-- End FAQs -->

                                            <!-- Contact Us -->
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="contact-v1.html">Contact Us</a>
                                            </li>
                                            <!-- End Contact Us -->
                                        </ul>
                                    </div>
                                    <!-- End Navigation -->
                                </nav>
                                <!-- End Nav -->
                            </div>
                            <!-- End Primary Menu -->

                            <!-- Customer Care -->
                            <div class="d-none d-xl-block col-md-auto">
                                <div class="d-flex">
                                    <i class="ec ec-support font-size-50 text-primary"></i>
                                    <div class="ml-2">
                                        <div class="phone">
                                            <strong>Support</strong> <a href="tel:{{ $setting->mobile_no }}" class="text-gray-90">{{ $setting->mobile_no }}</a>
                                        </div>
                                        <div class="email">
                                            E-mail: <a href="mailto:{{ $setting->email }}=Help Need" class="text-gray-90">{{ $setting->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customer Care -->

                            <!-- Header Icons -->
                            <div class="d-xl-none col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                                <div class="d-inline-flex">
                                    <ul class="d-flex list-unstyled mb-0 align-items-center">
                                        <!-- Search -->
                                        <li class="col d-xl-none px-2 px-sm-3 position-static">
                                            <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Search"
                                                aria-controls="searchClassic"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-target="#searchClassic"
                                                data-unfold-type="css-animation"
                                                data-unfold-duration="300"
                                                data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                <span class="ec ec-search"></span>
                                            </a>

                                            <!-- Input search for mobile--> 
                                            <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                                <form class="js-focus-state input-group px-3">
                                                    <input class="form-control" type="search" placeholder="Search Product">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End Input -->
                                        </li>
                                        <!-- End Search -->

                                        <li class="col d-none d-xl-block"><a href="#" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                        
                                        @if(Session::get('merchantId'))
                                            <li class="col d-xl-none px-2 px-sm-3"><a href="{{ url('merchant/dashboard') }}" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>
                                        @else
                                        <li class="col d-xl-none px-2 px-sm-3"><a href="#footer-menu" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="">Login</a></li>
                                        @endif
                                        
                                        <li class="col pr-xl-0 px-2 px-sm-3">
                                            <a href="{{ route('product.cartpage') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                
                                                <span class="width-22 height-22 bg-dark position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white cartQuantity">
                                                    @php
                                                        $totalQuantity = App\CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity')
                                                    @endphp
                                                    {{ $totalQuantity }}
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->

                        </div>
                    </div>
                </div>
                <!-- End Logo-Search-header-icons -->

                <!-- Vertical-and-Search-Bar -->
                <div class="d-none d-xl-block bg-primary">
                    <div class="container">
                        <div class="row align-items-stretch min-height-50">
                            <!-- Vertical Menu -->
                            <div class="col-md-auto d-none d-xl-flex align-items-end">
                                <div class="max-width-270 min-width-270">
                                    <!-- Basics Accordion -->
                                    
                                </div>
                            </div>
                            <!-- End Vertical Menu -->
                            <!-- Search bar -->
                            <div class="col align-self-center">
                                <!-- Search-Form -->
                                <form class="js-focus-state" action="{{ url('/') }}" method="GET">
                                    <label class="sr-only" for="searchProduct">Search</label>
                                    <div class="input-group">
                                        <input type="search" value="{{ $_GET['search_value']??'' }}" class="form-control py-2 pl-5 font-size-15 border-0 height-40 rounded-left-pill" name="search_value" id="searchProduct" placeholder="Search for Products" aria-label="Search for Products" aria-describedby="searchProduct1">
                                        <div class="input-group-append">
                                            <!-- Select -->
                                            <select name="branch" class="js-select selectpicker dropdown-select custom-search-categories-select"
                                                data-style="btn height-40 text-gray-60 font-weight-normal border-0 rounded-0 bg-white px-5 py-2">
                                                @foreach($hubs as $hub)
                                                <option {{ Session::get('default_branch')==$hub->id? 'selected':'' }} value="{{ $hub->id }}">{{ $hub->title }}</option>
                                                @endforeach
                                            </select>
                                            <!-- End Select -->
                                            <button class="btn btn-dark height-40 py-2 px-3 rounded-right-pill" type="submit" id="searchProduct1">
                                                <span class="ec ec-search font-size-24"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End Search-Form -->
                            </div>
                            <!-- End Search bar -->
                            <!-- Header Icons -->
                            <div class="col-md-auto align-self-center">
                                <div class="d-flex">
                                    <ul class="d-flex list-unstyled mb-0">
                                        
                                        <li class="col"><a href="#" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                        <li class="col pr-0">
                                            <a href="{{ route('product.cartpage') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                <span class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-12 top-8 font-weight-bold font-size-12 cartQuantity">{{ $totalQuantity }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->
                        </div>
                    </div>
                </div>
                <!-- End Vertical-and-secondary-menu -->
            </div>
        </header>
        <!-- ========== END HEADER ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <div class="row">
                <div class="col-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif


                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif


                    @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif


                    @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif


                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="p-3 bg-danger text-light">:message</div>')) !!}
                    @endif
                </div>
            </div>

            @yield('content')
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

        <!-- ========== FOOTER ========== -->
        <footer class="bg-custom">
            
            <!-- Footer-bottom-widgets -->
            <div class="pt-8 pb-4 bg-gray-13">
                <div class="container mt-1">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-6">
                                {{-- <a href="#" class="d-inline-block">
                                    <svg version="1.1" x="0px" y="0px" width="156px" height="37px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52">
                                        <ellipse fill-rule="evenodd" clip-rule="evenodd" fill="#FDD700" cx="170.05" cy="36.341" rx="5.32" ry="5.367"></ellipse>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#333E48" d="M30.514,0.71c-0.034,0.003-0.066,0.008-0.056,0.056
                                            C30.263,0.995,29.876,1.181,29.79,1.5c-0.148,0.548,0,1.568,0,2.427v36.459c0.265,0.221,0.506,0.465,0.725,0.734h6.187
                                            c0.2-0.25,0.423-0.477,0.669-0.678V1.387C37.124,1.185,36.9,0.959,36.701,0.71H30.514z M117.517,12.731
                                            c-0.232-0.189-0.439-0.64-0.781-0.734c-0.754-0.209-2.039,0-3.121,0h-3.176V4.435c-0.232-0.189-0.439-0.639-0.781-0.733
                                            c-0.719-0.2-1.969,0-3.01,0h-3.01c-0.238,0.273-0.625,0.431-0.725,0.847c-0.203,0.852,0,2.399,0,3.725
                                            c0,1.393,0.045,2.748-0.055,3.725h-6.41c-0.184,0.237-0.629,0.434-0.725,0.791c-0.178,0.654,0,1.813,0,2.765v2.766
                                            c0.232,0.188,0.439,0.64,0.779,0.733c0.777,0.216,2.109,0,3.234,0c1.154,0,2.291-0.045,3.176,0.057v21.277
                                            c0.232,0.189,0.439,0.639,0.781,0.734c0.719,0.199,1.969,0,3.01,0h3.01c1.008-0.451,0.725-1.889,0.725-3.443
                                            c-0.002-6.164-0.047-12.867,0.055-18.625h6.299c0.182-0.236,0.627-0.434,0.725-0.79c0.176-0.653,0-1.813,0-2.765V12.731z
                                            M135.851,18.262c0.201-0.746,0-2.029,0-3.104v-3.104c-0.287-0.245-0.434-0.637-0.781-0.733c-0.824-0.229-1.992-0.044-2.898,0
                                            c-2.158,0.104-4.506,0.675-5.74,1.411c-0.146-0.362-0.451-0.853-0.893-0.96c-0.693-0.169-1.859,0-2.842,0h-2.842
                                            c-0.258,0.319-0.625,0.42-0.725,0.79c-0.223,0.82,0,2.338,0,3.443c0,8.109-0.002,16.635,0,24.381
                                            c0.232,0.189,0.439,0.639,0.779,0.734c0.707,0.195,1.93,0,2.955,0h3.01c0.918-0.463,0.725-1.352,0.725-2.822V36.21
                                            c-0.002-3.902-0.242-9.117,0-12.473c0.297-4.142,3.836-4.877,8.527-4.686C135.312,18.816,135.757,18.606,135.851,18.262z
                                            M14.796,11.376c-5.472,0.262-9.443,3.178-11.76,7.056c-2.435,4.075-2.789,10.62-0.501,15.126c2.043,4.023,5.91,7.115,10.701,7.9
                                            c6.051,0.992,10.992-1.219,14.324-3.838c-0.687-1.1-1.419-2.664-2.118-3.951c-0.398-0.734-0.652-1.486-1.616-1.467
                                            c-1.942,0.787-4.272,2.262-7.134,2.145c-3.791-0.154-6.659-1.842-7.524-4.91h19.452c0.146-2.793,0.22-5.338-0.279-7.563
                                            C26.961,15.728,22.503,11.008,14.796,11.376z M9,23.284c0.921-2.508,3.033-4.514,6.298-4.627c3.083-0.107,4.994,1.976,5.685,4.627
                                            C17.119,23.38,12.865,23.38,9,23.284z M52.418,11.376c-5.551,0.266-9.395,3.142-11.76,7.056
                                            c-2.476,4.097-2.829,10.493-0.557,15.069c1.997,4.021,5.895,7.156,10.646,7.957c6.068,1.023,11-1.227,14.379-3.781
                                            c-0.479-0.896-0.875-1.742-1.393-2.709c-0.312-0.582-1.024-2.234-1.561-2.539c-0.912-0.52-1.428,0.135-2.23,0.508
                                            c-0.564,0.262-1.223,0.523-1.672,0.676c-4.768,1.621-10.372,0.268-11.537-4.176h19.451c0.668-5.443-0.419-9.953-2.73-13.037
                                            C61.197,13.388,57.774,11.12,52.418,11.376z M46.622,23.343c0.708-2.553,3.161-4.578,6.242-4.686
                                            c3.08-0.107,5.08,1.953,5.686,4.686H46.622z M160.371,15.497c-2.455-2.453-6.143-4.291-10.869-4.064
                                            c-2.268,0.109-4.297,0.65-6.02,1.524c-1.719,0.873-3.092,1.957-4.234,3.217c-2.287,2.519-4.164,6.004-3.902,11.007
                                            c0.248,4.736,1.979,7.813,4.627,10.326c2.568,2.439,6.148,4.254,10.867,4.064c4.457-0.18,7.889-2.115,10.199-4.684
                                            c2.469-2.746,4.012-5.971,3.959-11.063C164.949,21.134,162.732,17.854,160.371,15.497z M149.558,33.952
                                            c-3.246-0.221-5.701-2.615-6.41-5.418c-0.174-0.689-0.26-1.25-0.4-2.166c-0.035-0.234,0.072-0.523-0.045-0.77
                                            c0.682-3.698,2.912-6.257,6.799-6.547c2.543-0.189,4.258,0.735,5.52,1.863c1.322,1.182,2.303,2.715,2.451,4.967
                                            C157.789,30.669,154.185,34.267,149.558,33.952z M88.812,29.55c-1.232,2.363-2.9,4.307-6.13,4.402
                                            c-4.729,0.141-8.038-3.16-8.025-7.563c0.004-1.412,0.324-2.65,0.947-3.726c1.197-2.061,3.507-3.688,6.633-3.612
                                            c3.222,0.079,4.966,1.708,6.632,3.668c1.328-1.059,2.529-1.948,3.9-2.99c0.416-0.315,1.076-0.688,1.227-1.072
                                            c0.404-1.031-0.365-1.502-0.891-2.088c-2.543-2.835-6.66-5.377-11.704-5.137c-6.02,0.288-10.218,3.697-12.484,7.846
                                            c-1.293,2.365-1.951,5.158-1.729,8.408c0.209,3.053,1.191,5.496,2.619,7.508c2.842,4.004,7.385,6.973,13.656,6.377
                                            c5.976-0.568,9.574-3.936,11.816-8.354c-0.141-0.271-0.221-0.604-0.336-0.902C92.929,31.364,90.843,30.485,88.812,29.55z">
                                        </path>
                                    </svg>
                                </a> --}}
                            </div>
                            <div class="mb-4">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <i class="ec ec-support text-primary font-size-56"></i>
                                    </div>
                                    <div class="col pl-3">
                                        <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                        <a href="" class="font-size-20 text-gray-90"> {{ $setting->mobile_no }} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-1 font-weight-bold">Contact info</h6>
                                <address class="">
                                    {{ $setting->address }}
                                </address>
                            </div>
                            <div class="my-4 my-md-4">
                                <ul class="list-inline mb-0 opacity-7">
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-facebook-f btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-google btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-twitter btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                            <span class="fab fa-github btn-icon__inner"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        <li><a class="list-group-item list-group-item-action" href=""> About Us </a></li>
                                        <li><a class="list-group-item list-group-item-action" href=""> Blog </a></li>
                                        <li><a class="list-group-item list-group-item-action" href=""> Branch </a></li>
                                        <li><a class="list-group-item list-group-item-action" href=""> Contact Us </a></li>
                                        <!--<li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">TV & Audio</a></li>-->
                                        <!--<li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Gadgets</a></li>-->
                                        <!--<li><a class="list-group-item list-group-item-action" href="../shop/product-categories-5-column-sidebar.html">Car Electronic & GPS</a></li>-->
                                    </ul>
                                    <!-- End List Group -->
                                </div>
                                
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        <li><a class="list-group-item list-group-item-action" href="">My Account</a></li>
                                        <!--<li><a class="list-group-item list-group-item-action" href="../shop/track-your-order.html">Order Tracking</a></li>-->
                                        <!--<li><a class="list-group-item list-group-item-action" href="../shop/wishlist.html">Wish List</a></li>-->
                                        <li><a class="list-group-item list-group-item-action" href="">Customer Service</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="">Returns / Exchange</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="">FAQs</a></li>
                                        <li><a class="list-group-item list-group-item-action" href="">Product Support</a></li>
                                    </ul>
                                    <!-- End List Group -->
                                </div>

                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold" id="footer-menu">Login Information</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        
                                        <li><a class="list-group-item list-group-item-action" href="https://laundryexp.com/login">Admin Login</a></li>
                                        
                                        <li><a class="list-group-item list-group-item-action" href="https://laundryexp.com/pickupman/login">Pickupman Login</a></li>
                                        
                                        <li><a class="list-group-item list-group-item-action" href="https://laundryexp.com/deliveryman/login">Deliveryman Login</a></li>
                                        
                                        <li><a class="list-group-item list-group-item-action" href="{{ url('merchant/register') }}">Customer Registation</a></li>
                                        
                                        <li><a class="list-group-item list-group-item-action" href="{{ url('merchant/login') }}">Customer Login</a></li>
                                        
                                    </ul>
                                    <!-- End List Group -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-bottom-widgets -->
            <!-- Footer-copy-right -->
            <div class="bg-gray-14 py-2">
                <div class="container">
                    <div class="flex-center-between d-block d-md-flex">
                        <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">{{ $setting->name }}</a> - All rights Reserved</div>
                        <!--<div class="text-md-right">-->
                        <!--    <span class="d-inline-block bg-white border rounded p-1">-->
                        <!--        <img class="max-width-5" src="../../assets/img/100X60/img1.jpg" alt="Image Description">-->
                        <!--    </span>-->
                        <!--    <span class="d-inline-block bg-white border rounded p-1">-->
                        <!--        <img class="max-width-5" src="../../assets/img/100X60/img2.jpg" alt="Image Description">-->
                        <!--    </span>-->
                        <!--    <span class="d-inline-block bg-white border rounded p-1">-->
                        <!--        <img class="max-width-5" src="../../assets/img/100X60/img3.jpg" alt="Image Description">-->
                        <!--    </span>-->
                        <!--    <span class="d-inline-block bg-white border rounded p-1">-->
                        <!--        <img class="max-width-5" src="../../assets/img/100X60/img4.jpg" alt="Image Description">-->
                        <!--    </span>-->
                        <!--    <span class="d-inline-block bg-white border rounded p-1">-->
                        <!--        <img class="max-width-5" src="../../assets/img/100X60/img5.jpg" alt="Image Description">-->
                        <!--    </span>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <!-- End Footer-copy-right -->
        </footer>
        <!-- ========== END FOOTER ========== -->

        <!-- ========== SECONDARY CONTENTS ========== -->
        <!-- Account Sidebar Navigation -->
        {{-- <aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
            <div class="u-sidebar__scroller">
                <div class="u-sidebar__container">
                    <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                        <!-- Toggle Button -->
                        <div class="d-flex align-items-center pt-4 px-7">
                            <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="ec ec-close-remove"></i>
                            </button>
                        </div>
                        <!-- End Toggle Button -->

                        <!-- Content -->
                        <div class="js-scrollbar u-sidebar__body">
                            <div class="u-sidebar__content u-header-sidebar__content">
                                <form class="js-validate">
                                    <!-- Login -->
                                    <div id="login" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome Back!</h2>
                                        <p>Login to manage your account.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signinEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signinEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signinEmail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                              <label class="sr-only" for="signinPassword">Password</label>
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinPasswordLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="password" id="signinPassword" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                                   data-msg="Your password is invalid. Please try again."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                              </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="d-flex justify-content-end mb-4">
                                            <a class="js-animation-link small link-muted" href="javascript:;"
                                               data-target="#forgotPassword"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Forgot Password?</a>
                                        </div>

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Login</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Do not have an account?</span>
                                            <a class="js-animation-link small text-dark" href="javascript:;"
                                               data-target="#signup"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Signup
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                        </div>

                                        <!-- Login Buttons -->
                                        <div class="d-flex">
                                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                              <span class="fab fa-facebook-square mr-1"></span>
                                              Facebook
                                            </a>
                                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                              <span class="fab fa-google mr-1"></span>
                                              Google
                                            </a>
                                        </div>
                                        <!-- End Login Buttons -->
                                    </div>

                                    <!-- Signup -->
                                    <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome to Electro.</h2>
                                        <p>Fill out the form to get started.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupPassword">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                                    data-msg="Your password is invalid. Please try again."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                        <span class="fas fa-key"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                                data-msg="Password does not match the confirm password."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Already have an account?</span>
                                            <a class="js-animation-link small text-dark" href="javascript:;"
                                                data-target="#login"
                                                data-link-group="idForm"
                                                data-animation-in="slideInUp">Login
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                        </div>

                                        <!-- Login Buttons -->
                                        <div class="d-flex">
                                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                                <span class="fab fa-facebook-square mr-1"></span>
                                                Facebook
                                            </a>
                                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                                <span class="fab fa-google mr-1"></span>
                                                Google
                                            </a>
                                        </div>
                                        <!-- End Login Buttons -->
                                    </div>
                                    <!-- End Signup -->

                                    <!-- Forgot Password -->
                                    <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                            <h2 class="h4 mb-0">Recover Password.</h2>
                                            <p>Enter your email address and an email with instructions will be sent to you.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="recoverEmail">Your email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="recoverEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="recoverEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Recover Password</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Remember your password?</span>
                                            <a class="js-animation-link small" href="javascript:;"
                                               data-target="#login"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Login
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Forgot Password -->
                                </form>
                            </div>
                        </div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </aside> --}}
        <!-- End Account Sidebar Navigation -->
        <!-- ========== END SECONDARY CONTENTS ========== -->

        <!--Shipping address modal-->	
    	<div class="modal fade modalStyle modalShippingAddress" id="modalShippingAddress" tabindex="-1" role="dialog" aria-hidden="true">
    		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">
    				<span class="d-block ml-auto" data-dismiss="modal"><i class="fas fa-times p-3"></i></span>
    				<div class="modal-body modalStyle-body">
    				    <h4 class="mb-4" style="margin: 5px 0 15px 0px; text-align:center">Shipping address | <a class="add_new_address btn btn-primary btn-xs" href="javascript:;" onclick="openAddressForm()">Add new address</a></h4>
    					
                        {{-- add address --}}
                        <div class="add_new_address_form text-left" style="display: none;">
    						<span class="add_new_address_form_error" style="color:red;"></span>
                            <form action="{{ route('product.createAddress') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="form_control_1">Full Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" value="" name="fullname" required="" placeholder="Enter your first and last name"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">Mobile Number <span class="required">*</span></label>
                                            <input type="text" class="form-control" value="" name="shipping_mobile_no" required="" placeholder="Enter your mobile number"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="form_control_1">Region <span class="required">*</span></label>
                                            <select class="form-control" name="region_id" required="" onchange="loadCityByRegion(this.value);">
                                                @php
                                                $divisions = App\Division::where('status', 1)->get();
                                                @endphp
                                                <option value="">@lang('common.select')</option>
                                                @foreach($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">City <span class="required">*</span></label>
                                            <select class="form-control" name="city_id" id="district_id" required="" onchange="loadAreaByCity(this.value);">
                                                <option value="">Choose your city</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">Area <span class="required">*</span></label>
                                            <select class="form-control" name="area_id" id="thana_id" required="">
                                                <option value="">Choose your area</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">Address<span class="required">*</span></label>
                                            <input type="text" name="address" class="form-control" value="" required="" placeholder="Enter your address"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="form_control_1">Select a label for effective delivery</label><br>
                                            <input type="radio" name="type" value="Home" required="" checked="" class="radio2"/> Home
                                            <input class="ml-2" type="radio" name="type" value="Office" required="" class="radio2"/> Office
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group text-right">
                                            <input onclick="closeAddressForm()" class="btn btn-dark btn-xs cancel_new_address width-auto" type="button" value="Cancel">
                                            <input class="btn btn-primary btn-xs submit_new_address width-auto" type="submit" name="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
    					</div>

                        {{-- existing address --}}
    					<div class="address_list text-left">
                            @php
                                $customerAddresses = App\CustomerAddress::where('customer_id', Session::get('merchantId'))->with('division')->with('district')->with('thana')->get();
                            @endphp
                            <form action="{{ route('product.addShipping') }}" method="post">
                                @csrf
                                <table class="table table-bordered mb-4">
                                    <thead>
                                        <tr>
                                            <td width="20"></td>
                                            <td>Full Name</td>
                                            <td>Address</td>
                                            <td>Mobile Number</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customerAddresses as $i => $item)
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="radio" @if($i == 0) checked="" @endif name="address_id" required="" value="{{ $item->id??0 }}" class="radio2"/>
                                                </td>
                                                <td>{{ $item->fullname??''}}</td>
                                                <td>
                                                    <span class="btn btn-primary btn-xs address-type">{{ $item->type?? '' }}</span> <span>{{ $item->address??''}}, {{ $item->thana->name??''}}, {{ $item->district->name??''}}, {{ $item->division->name??''}}.</span>
                                                </td>
                                                <td>{{ $item->mobile_no??''}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Address is empty</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="form-group new-button mb-0">
                                    <input type="hidden" class="shipping_billing_type" name="address_type" value="shipping" />
                                    <input class="ps-btn btn-primary change_address" type="submit" name="submit" value="Confirm" />
                                    <input class="ps-btn btn-dark closed_modal_address" data-dismiss="modal" type="button" value="Cancel" />
                                </div>
                            </form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<!--=====  End of Set shipping address modal  ======-->

        <!-- Go to Top -->
        <a class="js-go-to u-go-to" href="#"
            data-position='{"bottom": 15, "right": 15 }'
            data-type="fixed"
            data-offset-top="400"
            data-compensation="#header"
            data-show-effect="slideInUp"
            data-hide-effect="slideOutDown">
            <span class="fas fa-arrow-up u-go-to__inner"></span>
        </a>
        <!-- End Go to Top -->


        <!-- JS Global Compulsory -->
        <script src="{{ asset('public/frontEnd/template/vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/bootstrap/bootstrap.min.js')}}"></script>

        <!-- JS Implementing Plugins -->
        <script src="{{ asset('public/frontEnd/template/vendor/appear.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/jquery.countdown.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/svg-injector/dist/svg-injector.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        
        <script src="{{ asset('public/frontEnd/template/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/typed.js/lib/typed.min.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/slick-carousel/slick/slick.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
        {{-- <script src="{{ asset('public/backEnd/') }}/plugins/select2/js/select2.full.min.js"></script> --}}

        <!-- JS Electro -->
        <script src="{{ asset('public/frontEnd/template/js/hs.core.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.countdown.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.header.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.hamburgers.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.unfold.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.focus-state.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.malihu-scrollbar.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.validation.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.fancybox.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.onscroll-animation.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.slick-carousel.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.quantity-counter.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.show-animation.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.svg-injector.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.go-to.js')}}"></script>
        <script src="{{ asset('public/frontEnd/template/js/components/hs.selectpicker.js')}}"></script>
        <script src="{{ asset('public/backEnd/') }}/dist/js/toastr.min.js"></script>
        <script src="{{ asset('public/frontEnd/template/js/theme-custom.js')}}"></script>
        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- {!! Toastr::message() !!} --}}
        @yield('script')

        
        <!-- JS Plugins Init. -->
        <script>
            $(window).on('load', function () {
                // initialization of HSMegaMenu component
                $('.js-mega-menu').HSMegaMenu({
                    event: 'hover',
                    direction: 'horizontal',
                    pageContainer: $('.container'),
                    breakpoint: 767.98,
                    hideTimeOut: 0
                });
            });

            $(document).on('ready', function () {
                // initialization of header
                $.HSCore.components.HSHeader.init($('#header'));

                // initialization of animation
                $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    afterOpen: function () {
                        $(this).find('input[type="search"]').focus();
                    }
                });

                // initialization of popups
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of countdowns
                var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                    yearsElSelector: '.js-cd-years',
                    monthsElSelector: '.js-cd-months',
                    daysElSelector: '.js-cd-days',
                    hoursElSelector: '.js-cd-hours',
                    minutesElSelector: '.js-cd-minutes',
                    secondsElSelector: '.js-cd-seconds'
                });

                // initialization of malihu scrollbar
                $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

                // initialization of forms
                $.HSCore.components.HSFocusState.init();

                // initialization of form validation
                $.HSCore.components.HSValidation.init('.js-validate', {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupPassword'
                        }
                    }
                });

                // initialization of show animations
                $.HSCore.components.HSShowAnimation.init('.js-animation-link');

                // initialization of fancybox
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of slick carousel
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

                // initialization of go to
                $.HSCore.components.HSGoTo.init('.js-go-to');

                // initialization of hamburgers
                $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    beforeClose: function () {
                        $('#hamburgerTrigger').removeClass('is-active');
                    },
                    afterClose: function() {
                        $('#headerSidebarList .collapse.show').collapse('hide');
                    }
                });

                $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
                    e.preventDefault();

                    var target = $(this).data('target');

                    if($(this).attr('aria-expanded') === "true") {
                        $(target).collapse('hide');
                    } else {
                        $(target).collapse('show');
                    }
                });

                // initialization of forms
                // $.HSCore.components.HSRangeSlider.init('.js-range-slider');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

                // initialization of select picker
                $.HSCore.components.HSSelectPicker.init('.js-select');
            });
        </script>

        <script>

            function loadCityByRegion(regionId) {
                var division_id = regionId;
                var options = '<option value=""> Select city </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            }

            function loadAreaByCity(distictId) {
                var district_id = distictId;
                var options = '<option value=""> Select area </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                });
            }

            $(function() {
                $('.select2').select2();
                // $('body').on('click', '.identification_type', function() {
                //     var identification_type = $('input[name="identification_type"]:checked').val();
                //     if (identification_type == 1) {
                //         $('.nid_part').show();
                //         $('.birth_certificate_part').hide();
                //         $('.driving_licence_part').hide();
                //     } else if (identification_type == 2) {
                //         $('.nid_part').hide();
                //         $('.birth_certificate_part').show();
                //         $('.driving_licence_part').hide();
                //     } else {
                //         $('.nid_part').hide();
                //         $('.birth_certificate_part').hide();
                //         $('.driving_licence_part').show();
                //     }
                // })

                // Get District
                // $('body').on('change', '#division_id', function() {
                //     var division_id = $('#division_id').val();
                //     var options = '<option value=""> Select district </option>';
                //     $.ajax({
                //         method: "GET",
                //         url: "{{ route('get_division_districts') }}",
                //         data: {
                //             'division_id': division_id
                //         },
                //     }).done(function(response) {
                //         // console.log(response);
                //         response.forEach(function(item, i) {
                //             options += '<option value="' + item.id + '"> ' + item.name +
                //                 ' </option>';
                //         });
                //         $('#district_id').html(options);
                //     });
                // })
                // Get Thana
                // $('body').on('change', '#district_id', function() {
                //     var district_id = $('#district_id').val();
                //     var options = '<option value=""> Select thana </option>';
                //     $.ajax({
                //         method: "GET",
                //         url: "{{ route('get_district_thanas') }}",
                //         data: {
                //             'district_id': district_id
                //         },
                //     }).done(function(response) {
                //         // console.log(response);
                //         response.forEach(function(item, i) {
                //             options += '<option value="' + item.id + '"> ' + item.name +
                //                 ' </option>';
                //         });
                //         $('#thana_id').html(options);
                //     });
                // })
                // Get Area
                // $('body').on('change', '#thana_id', function() {
                //     var thana_id = $('#thana_id').val();
                //     var options = '<option value=""> Select area </option>';
                //     $.ajax({
                //         method: "GET",
                //         url: "{{ route('get_thana_areas') }}",
                //         data: {
                //             'thana_id': thana_id
                //         },
                //     }).done(function(response) {
                //         // console.log(response);
                //         response.forEach(function(item, i) {
                //             options += '<option value="' + item.id + '"> ' + item.name +
                //                 ' </option>';
                //         });
                //         $('#area_id').html(options);
                //     });

                // })

            })
        </script>

    </body>
</html>
