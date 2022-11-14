@extends('frontEnd.layouts.master')
@section('title','Forget Password')
@section('content')
 
 <!-- Hero Area End -->
    <div class="section-auth-common section-padding bg-gray" style="padding:50px 0">
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="">
                    <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="auth-common-right">

                <div class="form-content">
                    <h4>Forget Password</h4>
                    <p>Welcome back, please login to your account.</p>
                    <form action="{{url('auth/merchant/password/reset')}}" method="post" class="contact-wthree-do">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control contact-formquickTechls {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}" type="text" value="{{old('phoneNumber')}}" placeholder="Phone Number" name="phoneNumber" required="">
                                     @if ($errors->has('phoneNumber'))
                                        <span class="invalid-feedback">
                                          <strong>{{ $errors->first('phoneNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-cont-quicktech btn-block mt-2">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</div> 
    @endsection