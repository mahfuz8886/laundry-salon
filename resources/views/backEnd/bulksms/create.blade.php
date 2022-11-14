@extends('backEnd.layouts.master')
@section('bulk_sms', 'active menu-open')
@section('bulk_sms_manage', 'active')
@section('title', 'Sms Send')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">@lang('common.welcome') !! {{ auth::user()->name }}</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('common.dashborad')</a></li>
                        <li class="breadcrumb-item active"><a href="#">@lang('common.sms_send')</a></li>
                        <li class="breadcrumb-item active">@lang('common.create')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="manage-button">
                        <div class="body-title">
                            <h5> @lang('common.sms_send')</h5>
                        </div>
                        <div class="quick-button">
                            <div class="btn-group">
                                <!-- <button type="button" class="btn  btn-actions shadow btn-primary show-form"> <i
                                        class="fas fa-sms"></i> @lang('common.submit_message')</button>
                                <button type="button" class="btn btn-primary  shadow btn-actions show-list"> <i
                                        class="far fa-list-alt"></i> @lang('common.message_list')</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row sms-form ">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.sms_send')</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="{{ url('editor/sms/send') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="phonenumber">@lang('common.mobile_no') <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phonenumber') }}" name="phonenumber" id="phonenumber">
                                                <small><i>
                                                @lang('common.eg') : 01900000000,01700000000;</i>
                                                </small>
                                                @if ($errors->has('phonenumber'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="sms">@lang('common.message_body') <span class="text-danger">*</span> </label>
                                                <textarea type="text" class="form-control {{ $errors->has('sms') ? ' is-invalid' : '' }}" value="{{ old('sms') }}"
                                                    name="sms" id="sms"></textarea>

                                                @if ($errors->has('sms'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('sms') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <!-- form group -->
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">@lang('common.send')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row sms-lists">
                <div class="col-md-10 mx-auto box-content rounded-lg shadow">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-success">
                                    <th class="border-top-0  ">#</th>
                                    <th class="border-top-0  ">@lang('common.mobile_no')</th>
                                    <th class="border-top-0  ">@lang('common.message_body')</th>
                                    <th class="border-top-0 text-center ">@lang('common.status')</th>
                                    <th class="border-top-0 text-center  ">@lang('common.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lists as $list)
                                    <tr>
                                        <td>SC-00{{ $list->id }}</td>
                                        <td>0{{ $list->number }}</td>
                                        <td>
                                            {{ substr($list->sms, 0, 35) }} @if (strlen($list->sms) > 35)
                                                ....<button sms_data="{{ $list->sms }}"
                                                    class="btn btn-sm rounded-pill btn-light readbtn "> @lang('common.read_full')</button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="{{ $list->status == 1 ? 'badge badge-pill badge-success' : 'badge badge-pill badge-danger' }}">{{ $list->status == 1 ? 'sended' : 'not send' }}</span>

                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-outline-light border-0 btn-for-sms-dropdown"
                                                    style="transition: all .3s;" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-chevron-down"></i>
                                                </a>
                                                <div class="dropdown-menu rounded-lg border-0 shadow"
                                                    aria-labelledby="dropdownMenuButton" style="min-width:7rem!important">
                                                    <a class="dropdown-item"
                                                        href="{{ url('editor/sms/resend') }}/{{ $list->id }}"><i
                                                            class="far fa-paper-plane"></i> @lang('common.resend')</a>
                                                    <form action="{{ url('editor/sms/deleteSMS') }}" method="post">
                                                        <input type="hidden" name="deleted_id" value="{{ $list->id }}">
                                                        @csrf
                                                        <button class="dropdown-item mt-2 " style="outline:none"
                                                            onclick="return confirm('Are You Sure ?')"><i
                                                                class="fas fa-trash-alt"></i> @lang('common.delete')</button>
                                                    </form>

                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-4  justify-content-right">
                        {{ $lists->links() }}
                    </div>
                </div>
            </div>
            <div class="row mt-5">
            </div>
        </div>
    </section>
@endsection
