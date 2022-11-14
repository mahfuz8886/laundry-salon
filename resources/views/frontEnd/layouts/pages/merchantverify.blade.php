@extends('frontEnd.layouts.master')
@section('title','Verify')
@section('content')
<!-- contact -->
    <div class="contact py-5" >
        <div class="container pb-xl-5 pb-lg-3">
            <div class="register-page">
            <div class="row">
                <div class="col-lg-12 mt-lg-0 mt-5">
                    <!-- contact form grid -->
                    <div class="contact-top1">
                        <form action="{{url('merchant/verify/save')}}" method="POST" class="contact-wthree-do">
                         @csrf
                        <h1>Verify</h1><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" placeholder="Exp. 123 " name="verifypin" required="">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-cont-quicktech btn-block mt-4">
                                        Submit
                                     </button>
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