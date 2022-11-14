@extends('frontEnd.layouts.master')
@section('title', 'Login')
@section('style')
<style>
    .contact-wthree-do .form-control {
        padding: 5px 10px;
    }

    .register-page {
        padding: 10px;
    }
</style>
@endsection
@section('content')
<!-- contact -->
<div class="contact" style="background: aliceblue;padding:10% 5%">
    {{-- @if (session('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('error') }}
    </div>
    @endif --}}

    <!-- tab view -->
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-7">
                <img class="img-fluid" src="{{ asset('public/loginbg2.jpg') }}" alt="">
            </div>
            <div class="col-md-5">
                <div class="contact-top1">
                    <form action="{{ url('merchant/login') }}" method="POST" class="contact-wthree-do">
                        @csrf
                        <h4 class="text-center text-success"> @lang('common.login') </h4><br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="merchant_user"> @lang('common.mobile_email') <span
                                                class="text-danger">*</span> </label>
                                        <input
                                            class="form-control  {{ $errors->has('merchant_user') ? ' is-invalid' : '' }}"
                                            type="text" name="merchant_user" value="{{ old('merchant_user') }}"
                                            required="">

                                        @if ($errors->has('merchant_user'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('merchant_user') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label> @lang('common.password') <span class="text-danger">*</span> </label>
                                    <i class="fa fa-eye" id="merchant_toggle"
                                        style="position:absolute;right:25px; top:40px; cursor: pointer;"></i>
                                    <input class="form-control" type="password" name="merchant_password"
                                        id="merchant_password" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ url('merchant/forget/password') }}"
                                    style="margin-top:10px; display: inline-block;">@lang('common.forget_password')</a>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-md btn-primary mt-4 d-block w-100">
                                    @lang('common.login')
                                </button>
                            </div>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- tab view -->



<!-- <div class="container pb-xl-5 pb-lg-3">
    <div class="row">
        <div class="col-md-6 mt-lg-0 mt-5">
            <div class="register-page">
                <div class="contact-top1">
                    <form action="{{ url('merchant/login') }}" method="POST" class="contact-wthree-do">
                        @csrf
                        <h3 class="text-center"> @lang('common.merchant_login') </h3><br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="merchant_user"> @lang('common.mobile_email') <span
                                                class="text-danger">*</span> </label>
                                        <input
                                            class="form-control  {{ $errors->has('merchant_user') ? ' is-invalid' : '' }}"
                                            type="text" name="merchant_user" value="{{ old('merchant_user') }}"
                                            required="">

                                        @if ($errors->has('merchant_user'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('merchant_user') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label> @lang('common.password') <span class="text-danger">*</span> </label>
                                    <i class="fa fa-eye" id="merchant_toggle"
                                        style="position:absolute;right:25px; top:40px; cursor: pointer;"></i>
                                    <input class="form-control" type="password" name="merchant_password"
                                        id="merchant_password" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 text-left">
                                <button type="submit" class="btn btn-md btn-primary mt-4">
                                    @lang('common.login')
                                </button>
                            </div>
                            <div class="col-md-6 text-center mt-3">
                                <a href="{{ url('merchant/forget/password') }}"
                                    style="margin-top:10px; display: inline-block;">@lang('common.forget_password')</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-lg-0 mt-5">
            <div class="register-page">
                <div class="contact-top1">
                    <form action="{{ url('auth/deliveryman/login') }}" method="POST" class="contact-wthree-do">
                        @csrf
                        <h3 class="text-center"> @lang('common.deliveryman_rider') </h3><br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deliveryman_user">@lang('common.mobile_email')<span
                                                class="text-danger">*</span> </label>
                                        <input
                                            class="form-control  {{ $errors->has('deliveryman_user') ? ' is-invalid' : '' }}"
                                            type="text" name="deliveryman_user" value="{{ old('deliveryman_user') }}"
                                            required="">

                                        @if ($errors->has('deliveryman_user'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('deliveryman_user') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label> @lang('common.password') <span class="text-danger">*</span> </label>
                                    {{-- <i class="fa fa-eye" id="deliveryman_toggle"
                                                style="position:absolute;right:25px; top:40px; cursor: pointer;"></i> --}}
                                    <input class="form-control" type="password" name="deliveryman_password"
                                        id="deliveryman_password" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 text-left">
                                <button type="submit" class="btn btn-md btn-primary mt-4">
                                    @lang('common.login')
                                </button>
                            </div>
                            {{-- <div class="col-md-6 text-center mt-3">
                                        <a href="{{url('deliveryman/forget/password')}}" style="margin-top:10px;
                            display: inline-block;">Forget Password</a>
                        </div> --}}
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div> -->

<!-- <div class="container pb-xl-5 pb-lg-3">
    <div class="row">
        <div class="col-md-6 mt-lg-0 mt-2">
            <div class="register-page">
                <div class="contact-top1">
                    <form action="{{ url('auth/pickupman/login') }}" method="POST" class="contact-wthree-do">
                        @csrf
                        <h3 class="text-center"> @lang('common.pickupman_login') </h3><br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pickupman_user"> @lang('common.mobile_email') <span
                                                class="text-danger">*</span> </label>
                                        <input
                                            class="form-control  {{ $errors->has('pickupman_user') ? ' is-invalid' : '' }}"
                                            type="text" name="pickupman_user" value="{{ old('pickupman_user') }}"
                                            required="">

                                        @if ($errors->has('pickupman_user'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pickupman_user') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <label> @lang('common.password') <span class="text-danger">*</span> </label>

                                    <input class="form-control" type="password" name="pickupman_password" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 text-left">
                                <button type="submit" class="btn btn-md btn-primary mt-4">
                                    @lang('common.login')
                                </button>
                            </div>
                            {{-- <div class="col-md-6 text-center mt-3">
                                        <a href="{{url('pickupman/forget/password')}}" style="margin-top:10px; display:
                            inline-block;">Forget Password</a>
                        </div> --}}
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-lg-0 mt-2">
        <div class="register-page">
            <div class="contact-top1">
                <form action="{{ url('auth/agent/login') }}" method="POST" class="contact-wthree-do">
                    @csrf
                    <h3 class="text-center"> @lang('common.agent_login') </h3><br>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="agent_user"> @lang('common.mobile_email') <span
                                            class="text-danger">*</span> </label>
                                    <input class="form-control  {{ $errors->has('agent_user') ? ' is-invalid' : '' }}"
                                        type="text" name="agent_user" value="{{ old('agent_user') }}" required="">

                                    @if ($errors->has('agent_user'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('agent_user') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-12">
                                <label> @lang('common.password') <span class="text-danger">*</span> </label>
                                <input class="form-control" type="password" name="agent_password" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary mt-4">
                                @lang('common.login')
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div> -->

<!-- <div class="container pb-xl-5 pb-lg-3">
            <div class="row">
                <div class="col-md-6 mt-lg-0 mt-2">
                    <div class="register-page">
                        <div class="contact-top1">
                            <form action="{{ url('login') }}" method="POST" class="contact-wthree-do">
                                @csrf
                                <h3 class="text-center"> @lang('common.admin_login') </h3><br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email"> @lang('common.mobile_email') <span
                                                        class="text-danger">*</span> </label>
                                                <input
                                                    class="form-control  {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    type="text" name="email"
                                                    value="{{ old('email') }}" required="">

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <label> @lang('common.password') <span class="text-danger">*</span> </label>
                                            <input class="form-control" type="password"
                                                name="password" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 text-left">
                                        <button type="submit" class="btn btn-md btn-primary mt-4">
                                        @lang('common.login')
                                        </button>
                                    </div>
                                    {{-- <div class="col-md-6 text-center mt-3">
                                        <a href="{{url('forget/password')}}" style="margin-top:10px; display: inline-block;">Forget Password</a>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

</div>
<!-- //contact-->
@endsection

@section('script')
<script>
    const merchant_toggle = document.querySelector('#merchant_toggle');
    const merchant_password = document.querySelector('#merchant_password');

    merchant_toggle.addEventListener('click', function (e) {
        const type = merchant_password.getAttribute('type') === 'password' ? 'text' : 'password';
        merchant_password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
@endsection