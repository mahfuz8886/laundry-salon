@extends('backEnd.layouts.master')
@section('purchase_section', 'active menu-open')
@section('items', 'active menu-open')
@section('manage_item', 'active')
@section('title', 'edit item')

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
                        <form action="{{ route('superadmin.salon.updateItem') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                <h5 class="text-primary"><b>@lang('common.update_item')</b></h5>
                                </div>
                                <div class="card-body">
                                
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label for="itemName">Item Name</label>
                                        <input type="text" class="form-control" name="item_name" id="itemName" value="{{ old('item_name', $item->name) }}" required>
                                        <input type="hidden" name="rowId" value="{{ $item->id }}">
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="unit">@lang('common.unit_type')</label>
                                        <select id="unit" class="form-control" name="unit">
                                          <option value="">@lang('common.choose')</option>
                                          @foreach($units as $unit)
                                          <option {{ $item->unit_id==$unit->id? 'selected':'' }} value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="sku">SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{ $item->sku??uniqid() }}" id="sku">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="desc">Description</label>
                                      <textarea name="description" id="editor1" cols="30" rows="10">{{ $item->description??'' }}</textarea>
                                    </div>
                                    
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label for="">Image</label>
                                        <input type="file" name="image" class="form-file">
                                        @if($item && $item->image)
                                        <p>
                                          <img class="img-fluid" style="width: 150px" src="{{ asset($item->image) }}" alt="Image">
                                        </p>
                                        @endif
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="status">@lang('common.status')</label>
                                        <select id="status" class="form-control" name="status">
                                          <option value="">@lang('common.choose')</option>
                                          <option {{ $item->status==1?'selected':'' }} value="1">@lang('common.active')</option>
                                          <option {{ $item->status==0?'selected':'' }} value="0">@lang('common.inactive')</option>
                                        </select>
                                      </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-primary">@lang('common.submit')</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection