@extends('frontEnd.layouts.master')
@section('title', 'Home')
@section('content')
@section('style')
    <link href="{{ asset('public/frontEnd/') }}/css/hub.css" rel="stylesheet">
    <style>
        .carousel-item {
            width: 100%;
            margin: 5px 0px;
            border: 1px solid #ddd;
            padding: 3px;
        }

        .carousel-item img {
            width: 100%;
            max-height: 450px;
        }

        .sponsor-item {
            height: 100px;
        }

        #owl-demo .item {
            margin: 10px 5px;
            color: #FFF;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            text-align: center;
            height: 100px;
            border: 1px solid #dddddd;
            box-shadow: 0 0 5px #80808061;
            padding: 15px;
            background: repeating-linear-gradient(45deg, #1a830726, transparent 100px);
        }

        #owl-demo .item img {
            width: 90%;
            height: 90%;
        }

        .slogan {
            padding: 10px;
            border: none;
            height: auto;

            /* border-radius: 10px; */
            /* border-top-right-radius: 10px;
                    border-bottom-left-radius: 10px;
                    border-bottom-right-radius: 10px; */
        }

        .slogan_content {
            padding: 10px;
            border: none;
            height: auto;
            text-align: justify;
        }

        .wrimagecard {
            margin-top: 0;
            margin-bottom: 1.5rem;
            text-align: left;
            position: relative;
            background: #eeeeee;
            box-shadow: 12px 15px 20px 0px rgba(46, 61, 73, 0.15);
            border-radius: 4px;
            transition: all 0.3s ease;
            /* border: 1px dashed #ddd; */
        }

        a.wrimagecard:hover,
        .wrimagecard-topimage:hover {
            box-shadow: 2px 4px 8px 0px rgba(46, 61, 73, 0.2);
        }

        .wrimagecard-topimage_title {
            padding: 20px 24px;
            height: 80px;
            padding-bottom: 0.75rem;
            position: relative;
        }

        .wrimagecard-topimage a {
            border-bottom: none;
            text-decoration: none;
            color: #525c65;
            transition: color 0.3s ease;
        }

    </style>
@endsection

{{-- @foreach ($banner as $key => $value)

    <div class="banner_quicktechlspvt position-relative desktop-hide">
        <div class="container">
            <div class="banner-img">
                <div class="row justify-content-end">
                    <div class="col-md-4 ">
                        <div class="quicktech-traking ">
                            <p class="sub-tittle text-center ">
                                @lang('common.trackparcel')
                            </p>

                            <form action="{{ url('/track/parcel/') }}" method="POST"
                                class="quicktech-traking-wthree pt-2">
                                @csrf
                                <div class="d-flex quicktech-traking-wthree-field">
                                    <input class="form-control" type="text" placeholder="পার্সেল আইডি"
                                        name="trackparcel" required="">

                                    <button class="quicktech-btn  w-50" type="submit"><span
                                            class="fa fa-map-marker"></span> ট্র্যাক
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="quicktech-app">
                            <a href="#"><img src="{{ asset('public/frontEnd/') }}/images/Play-store.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //banner -->

    </div>
    <!-- //main banner -->
@endforeach --}}
@section('content')
    {{-- slider --}}
    <div class="row">
        <div class="col-12">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($sliders as $key => $slider)
                    <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="active"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner borderd">
                    @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="{{ $slider->name }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><b>{{ $slider->name }}</b></h5>
                                <p class="text-light">{{ $slider->slider_sdesc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"> </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>


     {{-- packages section --}}
     <div class="container">
        <!-- Tab Prodcut Section -->
        <div class="mb-6 mt-6">
            <!-- Nav Classic -->
            <div class="position-relative bg-white text-center z-index-2">
                <ul class="nav nav-classic nav-tab justify-content-start" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active js-animation-link" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true"
                            data-target="#pills-one-example1"
                            data-link-group="groups"
                            data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                @lang('common.top_packages')
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <!-- End Nav Classic -->
            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach($packages as $package)
                        <li class="col-6 col-md-4 col-lg-3 col-xl-3 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"><a href="#" class="font-size-12 text-gray-5"> {{ " For " . $package->duration . " Days" }} </a></div>
                                        <h5 class="mb-1 product-item__title"><a href="{{ url('package/details/'.$package->id) }}" class="text-blue font-weight-bold">{{ $package->package_name }}</a></h5>
                                        <div class="mb-2">
                                            <a href="{{ url('package/details/'.$package->id) }}" class="d-block text-center"><img class="img-fluid" src="{{ URL($package->image ?? 'public/avatar/avatar.png') }}{{-- {{ asset($product->image) }} --}}" alt="Image Description"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">৳ {{ $package->package_amount }}</div>
                                                {{ "Max. " . $package->package_quantity . " Pcs." }}
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="{{ url('package/details/'.$package->id) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                            <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <!-- End Tab Content -->
        </div>

        <div class="row mb-5">
            <div class="col-12">
                {{-- {{ $products->links() }} --}}
            </div>
        </div>
    </div>
     {{-- packages section --}}

    {{-- category --}}
    <!-- Top Categories this Week -->
    <div class="mb-6 bg-gray-7 py-6">
        <div class="container">
            <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-5">
                <h3 class="section-title mb-0 pb-2 font-size-22">@lang('common.top_categories')</h3>
            </div>
            <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                
                @foreach($categories as $category)
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="{{ route('product.categoryProduct', $category->slug) }}" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div class="pt-2">
                                    <img style="width: 100px;height:100px" class="img-fluid transform-rotate-15" src="{{ asset($category->image) }}" alt="Image Description">
                                </div>
                                <div class="ml-3 media-body">
                                    <h6 class="mb-0 text-gray-90">{{ $category->cat_name }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Top Categories this Week -->

    {{-- product section --}}
    <div class="container">
        <!-- Tab Prodcut Section -->
        <div class="mb-6">
            <!-- Nav Classic -->
            <div class="position-relative bg-white text-center z-index-2">
                <ul class="nav nav-classic nav-tab justify-content-start" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active js-animation-link" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true"
                            data-target="#pills-one-example1"
                            data-link-group="groups"
                            data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                @lang('common.top_products')
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <!-- End Nav Classic -->
            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach($products as $product)
                        <li class="col-6 col-md-4 col-lg-3 col-xl-3 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"><a href="#" class="font-size-12 text-gray-5">{{ $product->category->cat_name }}</a></div>
                                        <h5 class="mb-1 product-item__title"><a href="{{ url('product/details/'.$product->id.'/'.$product->slug) }}" class="text-blue font-weight-bold">{{ $product->product_name }}</a></h5>
                                        <div class="mb-2">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->slug) }}" class="d-block text-center"><img class="img-fluid" src="{{ asset($product->image) }}" alt="Image Description"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                <div class="text-gray-100">৳ {{ $product->price_range }}</div>
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                            <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <!-- End Tab Content -->
        </div>

        <div class="row mb-5">
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
        <!-- End Tab Prodcut Section -->
        <!-- Full banner -->
        {{-- <div class="mb-8">
            <a href="../shop/shop.html" class="d-block text-gray-90">
                <div class="bg-img-hero pt-3" style="background-image: url(../../assets/img/1400X143/img1.png);">
                    <div class="space-top-2-md p-4 pt-4 pt-md-5 pt-lg-6 pt-xl-5 pb-lg-4 px-xl-14 px-lg-6">
                        <div class="flex-horizontal-center overflow-auto overflow-md-visble">
                            <h1 class="text-lh-38 font-size-30 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">SHOP AND <strong>SAVE BIG</strong> ON HOTTEST TABLETS</h1>
                            <div class="flex-content-center ml-4 flex-shrink-0">
                                <div class="bg-primary rounded-lg px-6 py-2">
                                    <em class="font-size-14 font-weight-light">STARTING AT</em>
                                    <div class="font-size-30 font-weight-bold text-lh-1">
                                        <sup class="">$</sup>79<sup class="">99</sup>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
        <!-- End Full banner -->
    </div>

@endsection

@section('script')
{{-- <script>
    var owl = $('.owl-carousel');
    $(document).ready(function() {
        owl.owlCarousel({
            loop: true,
            autoplay: true,
            lazyLoad: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            resonsiveClass: true,
            animateOut: 'fadeIn',
            responsiveRefreshRate: true,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 3
                },
                1000: {
                    items: 6
                },
                1200: {
                    items: 6
                },
                1920: {
                    items: 6
                }
            }
        });
    });
    $('.customNextBtn').click(function() {
        owl.trigger('next.owl.carousel');
    })

    $('.customPrevBtn').click(function() {

        owl.trigger('prev.owl.carousel', [300]);
    });


    $('#nonloop').owlCarousel({

        loop: true,
        autoplay: true,
        lazyLoad: true,
        dots: false,
        rtl: true,
        autoplayTimeout: 1500,
        autoplayHoverPause: true,
        resonsiveClass: true,
        animateOut: 'fadeIn',
        responsiveRefreshRate: true,
        responsive: {
            0: {
                items: 3
            },
            768: {
                items: 6
            },
            1000: {
                items: 7
            },
            1200: {
                items: 8
            },
            1920: {
                items: 8
            }
        }
    });

    $('#nonloop').on('mousewheel', '.owl-stage', function(e) {
        if (e.deltaY > 0) {
            $('#nonloop').trigger('next.owl');
        } else {
            $('#nonloop').trigger('prev.owl');
        }
        e.preventDefault();
    });
</script> --}}
@endsection
