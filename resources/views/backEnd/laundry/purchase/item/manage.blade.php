@extends('backEnd.layouts.master')
@section('purchase_section', 'active menu-open')
@section('items', 'active menu-open')
@section('manage_item', 'active')
@section('title', 'Items')

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
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="">
                        <div class="row">
                        
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">@lang('common.choose')</option>
                                        <option {{$_GET && $_GET['status'] == 1? 'selected':''}} value="1">@lang('common.active')</option>
                                        <option value="0">@lang('common.inactive')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Item name</label>
                                    <input type="text" name="name" value="{{ $_GET['name']??'' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.action')</th>
                                    <th>@lang('common.status')</th>
                                    <th>@lang('common.name')</th>
                                    <th>@lang('common.unit_type')</th>
                                    <th>@lang('common.sku')</th>
                                    <th>@lang('common.description')</th>
                                    <th>@lang('common.image')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('superadmin.laundry.getItem', $item->id) }}" class="mr-2"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>{{ $item->status==1? 'Active':'Inactive' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->unit->unit_type }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal{{ $item->id }}">Show description</button>
                                        <div class="modal fade" id="modal{{$item->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title">@lang('common.description')</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  {!! $item->description !!}
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><img class="img-fluid" style="width: 60px;border:1px dotted black" src="{{ asset($item->image) }}" alt="Image"></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $items->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection