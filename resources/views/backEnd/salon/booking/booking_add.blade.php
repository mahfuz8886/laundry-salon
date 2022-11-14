@extends('backEnd.layouts.master')
@section('salon_order_section', 'active menu-open')
@section('offline_order', 'active menu-open')
@section('add_offline_order', 'active')
@section('title', 'offline order')

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
                <h3 class="card-header">
                  Add new order
                </h3>
                <div class="card-body">
                    <form action="{{ route('superadmin.salon.storeOrders') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="customer">Customer</label>
                                <select name="customer" class="form-control select2" id="customer" required onchange="loadAddress(this.value)">
                                    <option value="">@lang('common.choose')</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->firstName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-4">
                                    <label for="category">Category</label>
                                    <select name="category" class="form-control select2" id="category" required onchange="loadService(this.value)">
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-4">
                                <label for="service">Service Type</label>
                                <select name="service" class="form-control select2" id="service" required onchange="loadSchedule(this.value)">
                                    <option value="">@lang('common.choose')</option>
                                    
                                </select>
                            </div> --}}

                            {{-- address --}}
                            <div class="form-group col-md-4">
                                <label for="customer_address">Customer Address</label>
                                <select name="customer_address" class="form-control select2" id="customer_address" required>
                                    <option value="">@lang('common.choose')</option>
                                    
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="branch_id">Branch</label>
                                <select name="branch_id" class="form-control select2" id="branch_id" required>
                                    <option value="">@lang('common.choose')</option>
                                    @foreach($allBranch as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group col-md-4">
                                <label for="pick_time">Booking Date</label>
                                <input type="text" name="booking_date" class="form-control flatDate" id="booking_date" required>
                            </div> --}}
                            {{-- <div class="form-group col-md-4">
                                <label for="pick_time">Time Schedule</label>
                                <select name="time_schedule" class="form-control select2" id="time_schedule" required>
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pick_time">Total Space</label>
                                <input type="number" name="space" class="form-control" id="space" required>
                            </div> --}}
                            
                        </div>

                        {{-- purchase area --}}
                        <p>
                            <button type="button" onclick="addMoreItem()" class="btn btn-sm btn-success">@lang('common.add_more')</button>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>@lang('common.action')</th>
                                        <th>Category</th>
                                        <th>Service</th>
                                        <th>Time schedule</th>
                                        <th>Space</th>
                                        <th>Booking Date</th>
                                        <th>Employee</th>
                                    </tr>
                                </thead>
                                <tbody class="rowContainer">
                                    <tr>
                                        <td style="min-width: 40px"></td>
                                        <td style="min-width: 200px">
                                            <select name="category[]" class="form-control" id="category" required onchange="loadService(this.value,this)">
                                                <option value="">@lang('common.choose')</option>
                                                @foreach($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td style="min-width: 200px">
                                            <select name="service[]" class="form-control" id="service" required onchange="loadSchedule(this.value,this)">
                                                <option value="">@lang('common.choose')</option>
                                                
                                            </select>
                                        </td>
                                        
                                        <td style="min-width: 200px">
                                            <select name="time_schedule[]" class="form-control" id="time_schedule" required>
                                                
                                            </select>
                                        </td>
                                        <td style="min-width: 100px">
                                            <input type="number" name="space[]" class="form-control" id="space" required>
                                        </td>
                                        <td style="min-width: 150px">
                                            <input type="date" name="booking_date[]" class="form-control" required>
                                        </td>
                                        <td style="min-width: 200px">
                                            <select name="employee[]" class="form-control" id="employee" required>
                                                
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-5">@lang('common.submit')</button>
                    </form>
                </div>
              </div>
            
        </div>
        </div>


        {{-- template area --}}
        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td style="min-width: 200px">
                    <select name="category[]" class="form-control" id="category" required onchange="loadService(this.value,this)">
                        <option value="">@lang('common.choose')</option>
                        @foreach($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                        @endforeach
                    </select>
                </td>

                <td style="min-width: 200px">
                    <select name="service[]" class="form-control" id="service" required onchange="loadSchedule(this.value,this)">
                        <option value="">@lang('common.choose')</option>
                        
                    </select>
                </td>
                
                <td style="min-width: 200px">
                    <select name="time_schedule[]" class="form-control" id="time_schedule" required>
                        
                    </select>
                </td>
                <td style="min-width: 100px">
                    <input type="number" name="space[]" class="form-control" id="space" required>
                </td>
                <td style="min-width: 150px">
                    <input type="date" name="booking_date[]" class="form-control" required>
                </td>
                <td style="min-width: 200px">
                    <select name="employee[]" class="form-control" id="employee" required>
                        
                    </select>
                </td>
            </tr>
        </template>
        {{-- template area --}}



    </section>
@endsection

@section('script')
    <script>

        function loadAddress(cid) {
            let customerId = cid;
            let options = '<option value="">@lang('common.choose')</option>';
            if(customerId != null) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.laundry.customerAddress') }}',
                    data: {customerId},
                    success: function(data) {
                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.thana.name + ','+ element.district.name + ',' + element.district.name +' </option>';
                            });
                            $('#customer_address').empty();
                            $('#customer_address').append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }

        function loadService(cid, ref) {
            let categoryId = cid;
            let options = '<option value="">@lang('common.choose')</option>';
            if(categoryId != null) {
                
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.salon.getSalonService') }}',
                    data: {categoryId},
                    success: function(data) {

                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.id + '"> ' + element.service_name +' </option>';
                            });

                            var tempService = $(ref).closest('tr').find('#service');
                            tempService.empty();
                            tempService.append(options);
                        }
                        
                        // console.log(options);
                    }
                })
            }
        }

        function loadSchedule(service, ref) {
            let serviceId = service;
            let options = '<option value="">@lang('common.choose')</option>';
            if(serviceId != null) {
                
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.salon.getServiceSchedule') }}',
                    data: {serviceId},
                    success: function(data) {

                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element + '"> ' + element +' </option>';
                            });

                            var tempSchedule = $(ref).closest('tr').find('#time_schedule');
                            tempSchedule.empty();
                            tempSchedule.append(options);
                        }
                        
                        // console.log(data);
                    }
                })
            }

            loadEmployee(service, ref);
        }

        function loadEmployee(service, ref) {
            let serviceId = service;
            let options = '<option value="">@lang('common.choose')</option>';
            if(serviceId != null) {
                
                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.salon.getServiceEmployee') }}',
                    data: {serviceId},
                    success: function(data) {

                        if(data != null) {
                            data.forEach(element => {
                                options += '<option value="' + element.employee_id + '"> ' + element.employee.name +' </option>';
                            });

                            var tempEmp = $(ref).closest('tr').find('#employee');
                            tempEmp.empty();
                            tempEmp.append(options);
                        }
                        
                        // console.log(data);
                    }
                })
            }
        }


        function addMoreItem() {
          var temp = document.getElementsByTagName("template")[0];
          var clon = temp.content.cloneNode(true);
          document.querySelector('.rowContainer').appendChild(clon);
        }

        function deleteRow(button) {
            let tr = button.closest('tr');
            tr.parentNode.removeChild(tr);
            calculateInvoiceTotal();
        }

    </script>
@endsection