@extends('backEnd.layouts.master')
@section('product_section', 'active menu-open')
@section('service', 'active menu-open')
@section('manage_service', 'active')
@section('title', 'manage service')

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
                <div class="col-md-12">
                    <div class="box-content">
                        <div class="card">
                            <div class="card-header">
                              <h5 class="text-primary"><b>@lang('common.service_list')</b></h5>
                            </div>
                            <div class="card-body" style="">
                                <div class="teble-responsive">
                                    <table id="example1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="pl-4">@lang('common.action')</th>
                                                <th>@lang('common.status')</th>
                                                <th>@lang('common.service_name')</th>
                                                <th>@lang('common.category')</th>
                                                <th>@lang('common.start_time')</th>
                                                <th>@lang('common.end_time')</th>
                                                <th>@lang('common.duration')</th>
                                                <th>@lang('common.space_price')</th>
                                                <th>@lang('common.allow_m_booking')</th>
                                                <th>@lang('common.description')</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $service)
                                            <tr>
                                                <td class="pl-4"><a href="{{ route('superadmin.salon.getService', $service->id) }}"><i class="fa fa-edit text-primary"></i></a></td>
                                                <td>{{ $service->status }}</td>
                                                <td>{{ $service->service_name }}</td>
                                                <td>{{ $service->category->cat_name }}</td>
                                                <td>{{ date('h:i a', strtotime($service->start_time)) }}</td>
                                                <td>{{ date('h:i a', strtotime($service->end_time)) }}</td>
                                                <td>{{ $service->duration }} minutes</td>
                                                <td>{{ $service->price_per_space }}</td>
                                                <td>{{ $service->allow_multiple_booking==1? 'Yes':'No' }}</td>
                                                <td>
                                                    <i class="fas fa-eye text-info" data-toggle="modal" data-target="#modal{{ $service->id }}"></i>
                                                    <div class="modal fade" id="modal{{ $service->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title">@lang('common.description')</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $service->description !!}
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </td>
                                                
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $services->links() }}
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