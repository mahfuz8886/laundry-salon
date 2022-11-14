@extends('backEnd.layouts.master')
@section('account_section', 'active menu-open')
@section('account_head', 'active menu-open')
@section('add_head', 'active')
@section('title', 'Add account head')

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
                <h5 class="card-header text-uppercase">@lang('common.add_account_head')</h5>
                <div class="card-body">
                    <form action="{{ route('superadmin.account.storeHead') }}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="headType">Head Type</label>
                            <select name="head_type" id="headType" class="form-control" required>
                                <option value="">@lang('common.choose')</option>
                                @foreach($headTypes as $item)
                                <option value="{{ $item->id }}" @if (old('head_type') == $item->id) selected @endif>{{ $item->type_name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="head_name">Head Name</label>
                            <input type="text" name="head_name" class="form-control" id="head_name" placeholder="Account head name" value="{{ old('head_name') }}" required>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="status">@lang('common.status')</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">@lang('common.choose')</option>
                                <option value="1" @if (old('status') == 1) selected @endif>@lang('common.active')</option>
                                <option value="0" @if (old('status') == 0) selected @endif>@lang('common.inactive')</option>
                            </select>
                          </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-5">@lang('common.submit')</button>
                    </form>
                </div>
              </div>
        </div>
        </div>
    </section>
@endsection