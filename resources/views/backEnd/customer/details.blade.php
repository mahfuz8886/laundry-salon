@extends('backEnd.layouts.master')
@section('customer', 'active menu-open')
@section('customer_manage', 'active')
@section('title', 'Create customer')
@section('content')
    <!-- Main content -->
    <section class="content">
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h3 class="card-title"> @lang('common.customer_details') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <label for="image"> @lang('common.customer') @lang('common.photo')  </label>
                                                    <div>
                                                        <img src="{{ asset($customer->logo) }}" class="img-rounded"
                                                            id="image_show" alt="Photo" width="100" height="100">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>@lang('common.name')</th>
                                                    <td>{{$customer->firstName}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.email_address')</th>
                                                    <td>{{$customer->emailAddress}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.mobile_no')</th>
                                                    <td>{{$customer->phoneNumber}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.father_name')</th>
                                                    <td>{{$customer->fathers_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.mother_name')</th>
                                                    <td>{{$customer->mothers_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.customer_type')</th>
                                                    <td>{{$customer->customer_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.origin')</th>
                                                    <td>{{$customer->origin}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.division')</th>
                                                    <td>{{$address->division->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.district')</th>
                                                    <td>{{$address->district->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.thana')</th>
                                                    <td>{{$address->thana->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.address')</th>
                                                    <td>{{$address->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.status')</th>
                                                    <td>
                                                        @if($customer->status==1)
                                                        Active
                                                        @else
                                                        Inactive
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
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

