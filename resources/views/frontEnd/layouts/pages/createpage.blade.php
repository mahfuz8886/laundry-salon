@extends('frontEnd.layouts.master')
@section('title','Create Page')
@section('content')
<!-- //main banner -->
    <section class="py-5 contact-area" style="min-height: 700px;">
        <div class="container">
            <h2 class="contact-title text-center border-bottom pb-4">@lang('createpage.title'.$pagedetails->id)</h2>
            <div class="row pt-5">
                <div class="col-md-4">
                    <img class="img-fluid" src="{{ asset('public/team.png') }}" alt="">
                </div>
            	<div class="col-md-8">
            		<div class="page-des">
                        {!!__('createpage.text'.$pagedetails->id)!!}
            		</div>
            	</div>
            </div>
        </div>
    </section>
@endsection