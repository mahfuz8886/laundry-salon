@extends('backEnd.layouts.master')
@section('bulk_sms', 'active menu-open')
@section('bulk_sms_balance', 'active')
@section('title', 'SMS Balance')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <br><br>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="info-box box-bg-1">
                                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text"> @lang('common.general_sms_balance') </span>
                                                <span class="info-box-number">
                                                    @lang('common.your_sms_limit'): {{ $sms_balance['sms_limit'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="info-box box-bg-2">
                                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text"> OTP SMS Balance </span>
                                                <span class="info-box-number">
                                                    @lang('common.your_sms_limit'): {{ $otp_balance }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
