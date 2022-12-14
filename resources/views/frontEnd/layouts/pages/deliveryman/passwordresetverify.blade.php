@extends('frontEnd.layouts.master')
@section('title','Forget Verify')
@section('content')
 <!-- Hero Area Start -->
 
  <section id="quickTech-carrier" class="section-padding bg-gray" style="padding:50px 0">
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="modal-content">
                    <div class="row">
            <div class="col-sm-2">
               
            </div>
            <div class="col-sm-8">
                <div class="auth-common-right">
                <div class="form-content">
                    <h4>Forget Password</h4>
                    <form action="{{url('auth/deliveryman/reset/password')}}" method="POST">
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
                                      <button type="submit" class="btn submit contact-submit mt-2">Savel Change</button>
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