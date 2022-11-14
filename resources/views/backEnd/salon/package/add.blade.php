@extends('backEnd.layouts.master')
@section('package_section', 'active menu-open')
@section('package', 'active menu-open')
@section('add_package', 'active')
@section('title', 'Add package')

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
        <form action="{{ route('superadmin.salon.storePackage') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="card">
                    <h3 class="card-header">Add Package</h3>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-7 offset-2">
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Package Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="package_amount" id="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Package Duration (day)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="package_duration" id="" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="branch_id" class="col-sm-3 col-form-label">Branch</label>
                                <div class="col-sm-9">
                                    <select name="branch_id" class="form-control select2" id="branch_id" required>
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($allBranch as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                {{-- purchase area --}}
                <p>
                    <button type="button" onclick="addMoreItem()" class="btn btn-sm btn-success">@lang('common.add_more')</button>
                </p>
                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th>Max Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="rowContainer">
                            
                            <tr>
                                <td style="min-width: 40px"></td>
                                <td>
                                    <select name="service[]" id="item" class="form-control" required onchange="getBuyAndSalePrice(this.value, this)">
                                        @php
                                        $services = App\SalonService::where('status', 'Active')->get();
                                        @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($services as $item)
                                        <option value="{{ $item->id }}">{{ $item->service_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control" required>
                                </td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                
            </div>
        </form>

        {{-- template area --}}
        <template>
            <tr>
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td>
                    <select name="service[]" id="item" class="form-control" required onchange="getBuyAndSalePrice(this.value, this)">
                        @php
                        $services = App\SalonService::where('status', 'Active')->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach($services as $item)
                        <option value="{{ $item->id }}">{{ $item->service_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="amount[]" class="form-control" required>
                </td>
                <td>
                    <input type="number" name="qty[]" class="form-control" required>
                </td>
            </tr>
        </template>
        {{-- template area --}}





    </section>
@endsection

@section('script')
    <script>
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

        $(document).on('keyup', '.buyPrice', function() {
            let qty = $(this).closest('tr').find('.quantity');
            let subTotal = $(this).closest('tr').find('.subtotal');
            if(qty != null && qty.val()) {
                let quantity = parseFloat(qty.val());
                let buyPrice = parseFloat($(this).val());
                let subAmount = buyPrice * quantity;
                subTotal.val(subAmount);
                calculateInvoiceTotal();
            }  
        });

        $(document).on('keyup', '.quantity', function() {
            let buyPrice = $(this).closest('tr').find('.buyPrice');
            let subTotal = $(this).closest('tr').find('.subtotal');

            if(buyPrice != null && buyPrice.val()) {
                let quantity = parseFloat($(this).val());
                let buyAmount = parseFloat(buyPrice.val());

                let subAmount = buyAmount * quantity;
                subTotal.val(subAmount);
                calculateInvoiceTotal();
            }
            
        });

        function calculateInvoiceTotal() {

            let subtotal = document.querySelectorAll('.subtotal');
            let invTotal = document.querySelector('#invoiceTotal');
            let payable = document.querySelector('#payable');
            let discountElement = document.querySelector('#discount');
            let paid = document.querySelector('#paid');
            let due = document.querySelector('#due');

            let totalAmount = 0;
            let discountPrice = 0;
            let paidValue = 0;

            subtotal.forEach(element => {
                totalAmount += parseFloat(element.value);
            });
            invTotal.value = totalAmount;

            // discount calculate
            if(discountElement.value != '') {
                
                let discount = discountElement.value;
                let invTotalValue = totalAmount;

                if(invTotalValue > 0) {
                    if(discount.search('%') != -1) {
                        let splitValue = discount.split('%')
                        let discountParcent = parseInt(splitValue[0]);
                        discountPrice = (invTotalValue * discountParcent) / 100;
                    }else {
                        discountPrice = discount ;
                    }
                }
            }
            // discount calculate

            totalAmount = totalAmount - discountPrice;
            payable.value = totalAmount;

            if(paid.value > 0) {
                paidValue = parseFloat(paid.value);
            }


            due.value = totalAmount - paidValue;
        }
        
        function addDiscount(input) {
            let discount = input.value;
            let invTotal = document.querySelector('#invoiceTotal').value;
            let payable = document.querySelector('#payable');
            let due = document.querySelector('#due');

            if(invTotal > 0) {
                if(discount.search('%') != -1) {
                    let splitValue = discount.split('%')
                    let discountParcent = parseInt(splitValue[0]);
                    let finalPrice = invTotal - ( (parseFloat(invTotal) * discountParcent) / 100) ;
                    payable.value = finalPrice;
                    due.value = finalPrice;
                }else {
                    let finalPrice = invTotal - discount ;
                    payable.value = finalPrice;
                    due.value = finalPrice;
                }
            }
            
        }

        function paidAmount(input) {
            let paid = parseFloat(input.value);
            let payable = document.querySelector('#payable');
            let due = document.querySelector('#due');

            let payableAmount = parseFloat(payable.value);
            let finalDue = payableAmount - paid;
            due.value = finalDue;
        }

    </script>
@endsection