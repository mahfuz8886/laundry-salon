@extends('backEnd.layouts.master')
@section('product_section', 'active menu-open')
@section('service', 'active menu-open')
@section('add_service', 'active')
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
                <div class="col-md-12">
                    <div class="box-content">
                        <form action="{{ route('superadmin.salon.storeService') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                <h5 class="text-primary"><b>@lang('common.add_service')</b></h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.service_name')</label>
                                                <input type="text" value="{{ old('service_name') }}" name="service_name" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.category')</label>
                                                <select name="category_id" id="" class="form-control select2" required onchange="loadParentService(this.value)">
                                                    <option value="">@lang('common.choose')</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.parent_service')</label>
                                                <select name="parent_service_id" id="parent_service_id" class="form-control select2" required>
                                                    <option value="">@lang('common.choose')</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.service_start_time')</label>
                                                <input type="time" name="start_time" value="{{ old('start_time') }}" id="" placeholder="hh:00 am" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.service_end_time')</label>
                                                <input type="time" name="end_time" value="{{ old('end_time') }}" id="" placeholder="hh:00 am" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.duration')(minutes)</label>
                                                <input type="number" name="duration" value="{{ old('duration') }}" id="" placeholder="Ex: 60" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="">@lang('common.price_per_space')</label>
                                                <input type="number" name="price_per_space" value="{{ old('price_per_space') }}" id="" placeholder="amount per space" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">@lang('common.description')</label>
                                                <textarea name="description" rows="3" id="editor1" data-placeholder="Write service description here........." class="form-control editor1" required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-3">
                                            <label for="">Allow multiple booking</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="allow_multiple_booking" id="yesRadio"  value="1">
                                                <label class="form-check-label" for="yesRadio">
                                                  Yes
                                                </label>

                                                <input class="form-check-input" type="radio" name="allow_multiple_booking" id="noRadio" value="0" checked>
                                                <label class="form-check-label" for="noRadio">
                                                  No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">@lang('common.status')</label>
                                                <select type="text" name="status" id="" class="form-control" required>
                                                    <option value="">@lang('common.select')</option>
                                                    <option value="Active">@lang('common.active')</option>
                                                    <option value="Inactive">@lang('common.inactive')</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">@lang('common.image') <span class="text-danger"> * </span> </label>
                                                <input type="file" name="image" value="" id="image" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="service_and_amount">Service cost</label>
                                                <p><button type="button" onclick="addNewCost()" class="btn btn-sm btn-primary">@lang('common.add_more')</button></p>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 20px">@lang('common.action')</th>
                                                            <th>Item</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="rowContainer">
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <select name="item[]" id="item" class="form-control" required onchange="getBuyAndSalePrice(this.value, this)">
                                                                    @php
                                                                    $branches = App\helper\CustomHelper::getUserBranch();
                                                                    $items = App\SalonInventoryLog::groupBy('item_id')->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
                                                                    ->where('in_out', 'In');
                                                                    if($branches != null) {
                                                                        $items = $items->whereIn('branch_id', $branches);
                                                                    }
                                                                    $items = $items->with('item')->with('unit')->get();
                                                                    @endphp
                                                                    <option value="">@lang('common.choose')</option>
                                                                    @foreach($items as $item)
                                                                    <option value="{{ $item->item_id }},{{ $item->branch_id }}">{{ $item->item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="qty[]" class="form-control" required>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mt-5">
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
                
            </div>
        </div>
        

        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td>
                    <select name="item[]" id="item" class="form-control" required onchange="getBuyAndSalePrice(this.value, this)">
                        @php
                        $branches = App\helper\CustomHelper::getUserBranch();
                        $items = App\SalonInventoryLog::groupBy('item_id')->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
                        ->where('in_out', 'In');
                        if($branches != null) {
                            $items = $items->whereIn('branch_id', $branches);
                        }
                        $items = $items->with('item')->with('unit')->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach($items as $item)
                        <option value="{{ $item->item_id }},{{ $item->branch_id }}">{{ $item->item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="qty[]" class="form-control" required>
                </td>
            </tr>
        </template>

    </section>
@endsection


@section('script')
    <script>

        function addNewCost() {
          var temp = document.getElementsByTagName("template")[0];
          var clon = temp.content.cloneNode(true);
          document.querySelector('.rowContainer').appendChild(clon);
        }

        function deleteRow(ref) {
            $(ref).closest('tr').remove();
        }

        function loadParentService(params) {
            var url = "{{ route('superadmin.salon.getParentService') }}";
            var options = '<option value="">@lang('common.select')</option>';
            
            if(params) {
                $.ajax({
                    type: "GET",
                    url,
                    data:{cat_id: params},
                    success: function (data) {
                        if(data) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.service_name + ' </option>';
                            });
                            $('#parent_service_id').html(options);
                        }
                    }
                });
            }
        }
    </script>
@endsection