@extends('backEnd.layouts.master')
@section('purchase_section', 'active menu-open')
@section('purchase', 'active menu-open')
@section('manage_purchase', 'active')
@section('title', 'Edit purchase')

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
        <form action="{{ route('superadmin.salon.updatePurchase') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="card">
                    <h3 class="card-header">Details Purchase</h3>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-7 offset-2">
                            <div class="form-group row">
                                <label for="dateInput" class="col-sm-3 col-form-label">Purchase Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="purchase_date" class="form-control flatDate" id="dateInput" value="{{ $purchase->purchase_date }}" required>
                                    <input type="hidden" name="pid" value="{{ $purchase->id }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                                <div class="col-sm-9">
                                    <select name="supplier" class="form-control select2" id="supplier" required>
                                    @php
                                        $suppliers = App\Supplier::where('status', 1)->get();
                                    @endphp
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($suppliers as $supplier)
                                        <option {{ $purchase->supplier_id==$supplier->id? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                {{-- purchase area --}}
                {{-- <p>
                    <button type="button" onclick="addMoreItem()" class="btn btn-sm btn-success">@lang('common.add_more')</button>
                </p> --}}
                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>@lang('common.action')</th>
                                <th>@lang('common.item')</th>
                                {{-- <th>@lang('common.unit_type')</th> --}}
                                <th>@lang('common.buy_price')</th>
                                <th>@lang('common.sale_price')</th>
                                <th>@lang('common.quantity')</th>
                                <th>@lang('common.sub_total')</th>
                            </tr>
                        </thead>
                        <tbody class="rowContainer">
                            @if($pitems)
                            @foreach($pitems as $pitem)
                            <tr>
                                <td style="min-width: 40px"></td>
                                <td style="min-width: 200px">
                                    <select name="item[]" id="item" class="form-control" required>
                                        <option value="">@lang('common.choose')</option>
                                        @foreach($items as $item)
                                        <option {{ $pitem->item_id==$item->id? 'selected':'' }}  value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                {{-- <td style="min-width: 200px">
                                        <select name="unit[]" id="item" class="form-control" required>
                                            <option value="">@lang('common.choose')</option>
                                            @foreach($units as $unit)
                                            <option {{ $pitem->unit_id==$unit->id? 'selected':'' }} value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                                            @endforeach
                                        </select>
                                </td> --}}
                                <td style="min-width: 150px"><input type="number" value="{{ $pitem->buy_price }}" step="any" class="form-control buyPrice" name="buy_price[]" required></td>
                                <td style="min-width: 150px"><input type="number" value="{{ $pitem->sale_price }}" step="any" class="form-control saleprice" name="sale_price[]" required></td>
                                <td style="min-width: 150px"><input type="number" value="{{ $pitem->quantity }}" class="form-control quantity" name="quantity[]" required></td>
                                <td style="min-width: 150px"><input type="number" value="{{ $pitem->subtotal }}" step="any" readonly class="form-control subtotal" name="sub_total[]" required></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right"><b>Invoice Total</b></td>
                                    <td style="min-width: 150px"><input type="number" value="{{ $purchase->invoice_total }}" step="any" readonly class="form-control" name="invoice_total" id="invoiceTotal" required></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right"><b>Discount</b></td>
                                    <td style="min-width: 150px"><input type="text" value="{{ $purchase->discount }}" placeholder="Discount" class="form-control" name="discount" onkeyup="addDiscount(this)" id="discount"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right"><b>Payable amount</b></td>
                                    <td style="min-width: 150px"><input type="number" value="{{ $purchase->payable }}" step="any" readonly placeholder="Payable" class="form-control" name="payable" id="payable"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right"><b>Paid amount</b></td>
                                    <td style="min-width: 150px"><input type="number" value="{{ $purchase->paid }}" step="any" placeholder="Paid" onkeyup="paidAmount(this)" class="form-control" name="paid" id="paid"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right"><b>Due amount</b></td>
                                    <td style="min-width: 150px"><input type="number" value="{{ $purchase->due }}" step="any" readonly placeholder="Due" class="form-control" name="due" id="due"></td>
                                </tr>
                                {{-- <tr>
                                    <td colspan="7" class="text-right"><button type="submit" class="btn btn-primary btn-sm">submit</button></td>
                                </tr> --}}
                        </tfoot>
                    </table>
                </div>
                
            </div>
        </form>

        {{-- template area --}}
        <template>
            <tr>
              <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
              <td style="min-width: 200px">
                  <select name="item[]" id="item" class="form-control" required>
                    <option value="">@lang('common.choose')</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
              </td>
              {{-- <td style="min-width: 200px">
                    <select name="unit[]" id="item" class="form-control" required>
                      <option value="">@lang('common.choose')</option>
                        @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_type }}</option>
                        @endforeach
                    </select>
              </td> --}}
              <td style="min-width: 150px"><input type="number" step="any" class="form-control buyPrice" name="buy_price[]" required></td>
              <td style="min-width: 150px"><input type="number" step="any" class="form-control saleprice" name="sale_price[]" required></td>
              <td style="min-width: 150px"><input type="number" class="form-control quantity" name="quantity[]" required></td>
              <td style="min-width: 150px"><input type="number" step="any" class="form-control subtotal" readonly name="sub_total[]" required></td>
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