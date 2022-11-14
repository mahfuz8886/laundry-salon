@extends('frontEnd.layouts.master')
@section('title','Delivery Man Login')
@section('content')
<!-- contact -->
    <div class="contact py-5" >
        <div class="container pb-xl-5 pb-lg-3">
            <div class="register-page">
            <div class="row">
                <div class="col-lg-12 mt-lg-0 mt-5">
                    <!-- contact form grid -->
                    <div class="contact-top1">
                        <form action="{{url('auth/pickupman/login')}}" method="POST" class="contact-wthree-do">
                        @csrf

                        <div style="max-width: 400px;margin:auto">
                            <h1 class="text-center">@lang('common.login')</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Email or mobile" name="pickupman_user" required="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="@lang('common.password')" name="pickupman_password" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block mt-4">
                                        @lang('common.submit')
                                    </button>
                                </div>
                            </div>
                        </div>

                        </form>
                    </div>
                    <!-- //contact form grid ends here -->
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //contact-->
@endsection
