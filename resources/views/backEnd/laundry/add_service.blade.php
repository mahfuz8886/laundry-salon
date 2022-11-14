@extends('backEnd.layouts.master')
@section('product_section', 'active menu-open')
@section('service', 'active menu-open')
@section('service_add', 'active')
@section('title', 'Add Service')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="box-content">
                        <form action="{{ route('superadmin.laundry.storeService') }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                <h5 class="text-primary"><b>@lang('common.add_service')</b></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">@lang('common.service_name')</label>
                                                <input type="text" name="service_name" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('common.status')</label>
                                                <select type="text" name="status" id="" class="form-control" required>
                                                    <option value="">@lang('common.select')</option>
                                                    <option value="Active">@lang('common.active')</option>
                                                    <option value="Inactive">@lang('common.inactive')</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-sm mt-3">@lang('common.add_now')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="box-content">
                        <div class="card">
                            <div class="card-header">
                              <h5 class="text-primary"><b>@lang('common.service_list')</b></h5>
                            </div>
                            <div class="card-body" style="padding: 0px !important">
                                <div class="teble-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="pl-4">@lang('common.action')</th>
                                                <th>@lang('common.service_name')</th>
                                                <th>@lang('common.status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $service)
                                            <tr>
                                                <td class="pl-4"><a href="{{ route('superadmin.laundry.getService', $service->id) }}"><i class="fa fa-edit text-primary"></i></a></td>
                                                <td>{{ $service->service_name }}</td>
                                                <td>{{ $service->status }}</td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
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