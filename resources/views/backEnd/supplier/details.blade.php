@extends('backEnd.layouts.master')
@section('supplier', 'active menu-open')
@section('supplier_manage', 'active')
@section('title', 'Create supplier')
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
                                        <h3 class="card-title"> @lang('common.supplier_details') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <label for="image"> @lang('common.supplier') @lang('common.photo')  </label>
                                                    <div>
                                                        <img src="{{ asset($supplier->image) }}" class="img-rounded"
                                                            id="image_show" alt="Photo" width="100" height="100">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>@lang('common.name')</th>
                                                    <td>{{$supplier->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.email_address')</th>
                                                    <td>{{$supplier->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.mobile_no')</th>
                                                    <td>{{$supplier->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.father_name')</th>
                                                    <td>{{$supplier->fathers_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.mother_name')</th>
                                                    <td>{{$supplier->mothers_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.division')</th>
                                                    <td>{{$supplier->division->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.district')</th>
                                                    <td>{{$supplier->district->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.thana')</th>
                                                    <td>{{$supplier->thana->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.address')</th>
                                                    <td>{{$supplier->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>@lang('common.status')</th>
                                                    <td>
                                                        @if($supplier->status==1)
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

