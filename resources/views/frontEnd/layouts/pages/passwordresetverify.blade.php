@extends('frontEnd.layouts.master')
@section('title','Password Reset Verify')
@section('content')
 
 <div class="section-auth-common section-padding bg-gray" style="padding:50px 0">
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="">
                    <div class="row">
            <div class="col-sm-2">
            
            </div>
            <div class="col-sm-8">
                <div class="auth-common-right">
                <div class="form-content">
                    
                    <form action="{{url('auth/merchant/reset/password')}}" method="POST" class="contact-wthree-do">
                        @csrf
                        <div class="heading mb-lg-2 mb-2">
                            <h3 class="head">Reset Forget Password</h3>
                        </div>
                          <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control contact-formquickTechls {{ $errors->has('verifyPin') ? ' is-invalid' : '' }}" type="text" value="{{old('verifyPin')}}" placeholder="Verify Pin" name="verifyPin" required="">
                                         @if ($errors->has('verifyPin'))
                                            <span class="invalid-feedback">
                                              <strong>{{ $errors->first('verifyPin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control contact-formquickTechls {{ $errors->has('newPassword') ? ' is-invalid' : '' }}" type="password" value="{{old('newPassword')}}" placeholder="New Password" name="newPassword" required="">
                                         @if ($errors->has('newPassword'))
                                            <span class="invalid-feedback">
                                              <strong>{{ $errors->first('newPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary btn-cont-quicktech btn-block mt-2">Savel Change</button>
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