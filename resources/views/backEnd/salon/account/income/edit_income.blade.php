@extends('backEnd.layouts.master')
@section('account_section', 'active menu-open')
@section('income', 'active menu-open')
@section('add_income', 'active')
@section('title', 'Add Income')

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
            <form action="{{ route('superadmin.account.updateSalonIncome') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $income->id }}">
                <div class="card">
                    <h5 class="card-header text-uppercase">@lang('common.add_income')</h5>
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="head_name"> @lang('common.date') </label>
                                <input type="date" name="issue_date" value="{{ old('issue_date', $income->issue_date) }}"
                                    class="flatDate form-control flatpickr-input">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="invoice_no"> @lang('common.invoice_no') </label>
                                <input readonly type="text" name="invoice_no" value="{{ old('invoice_no', $income->invoice_no) }}"
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="payment_method">@lang('common.payment_method')</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="">@lang('common.choose')</option>
                                    <option value="1" @if (old('payment_method', $income->payment_method) == 1) selected @endif>
                                        @lang('common.cash')</option>
                                    <option value="2" @if (old('payment_method', $income->payment_method) == 2) selected @endif>
                                        @lang('common.bank')</option>
                                    <option value="3" @if (old('payment_method', $income->payment_method) == 3) selected @endif>
                                        @lang('common.mobile_banking')</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <button type="button" onclick="addMoreItem()"
                            class="btn btn-sm btn-success add">@lang('common.add_more')</button>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>@lang('common.action')</th>
                                        <th>@lang('common.head_name')</th>
                                        <th>@lang('common.quantity')</th>
                                        <th>@lang('common.amount')</th>
                                        <th>@lang('common.total')</th>
                                    </tr>
                                </thead>

                                <tbody class="rowContainer">

                                    @foreach ($income_lists as $income_list)
                                        <tr class="item">
                                            <td style="min-width: 40px"></td>
                                            <td>
                                                <select name="account_head_id[]" id="account_head_id" class="form-control account_head_id" required>
                                                    @php
                                                        $accounts = App\AccountHead::where('head_type', 3)->where('status', 1)->get();
                                                    @endphp
                                                    <option value="">@lang('common.choose')</option>
                                                    @foreach ($accounts as $item)
                                                        <option  @if ($income_list->account_head_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->head_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="list_id[]" value="{{ $income_list->id }}" class="form-control quantity" required>
                                                <input type="number" name="quantity[]" value="{{ $income_list->quantity }}" class="form-control quantity" required>
                                            </td>
                                            <td>
                                                <input type="number" name="amount[]" value="{{ $income_list->amount }}" class="form-control amount" required>
                                            </td>
                                            <td>
                                                <input readonly type="text" name="total[]" value="{{ $income_list->quantity * $income_list->amount }}" class="form-control total" required>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                                <tfoot>
                                    <th colspan="3">
                                        <td class="text-right"> <label for=""> @lang('common.total') </label> </td>
                                        <td>
                                            <input readonly type="text" id="sub_total" name="sub_total" value="{{ $income->total }}" class="form-control sub_total" required>
                                        </td>
                                    </th>
                                </tfoot>

                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">@lang('common.submit')</button>
                    </div>
                </div>
            </form>
        </div>
        </div>


        {{-- template area --}}
        <template id="template">
            <tr class="item">
                <td style="min-width: 40px"><i class="fas fa-trash text-danger" onclick="deleteRow(this)"></i></td>
                <td>
                    <select name="account_head_id[]" id="account_head_id" class="form-control account_head_id" required>
                        @php
                            $accounts = App\AccountHead::where('head_type', 3)->where('status', 1)->get();
                        @endphp
                        <option value="">@lang('common.choose')</option>
                        @foreach ($accounts as $item)
                            <option value="{{ $item->id }}">{{ $item->head_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="quantity[]" value="" class="form-control quantity" required>
                </td>
                <td>
                    <input type="number" name="amount[]" value="" class="form-control amount" required>
                </td>
                <td>
                    <input readonly type="text" name="total[]" class="form-control total" required>
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
          calculate();
        }

        function deleteRow(button) {
            // let tr = button.closest('tr');
            // tr.parentNode.removeChild('tr');
            // calculateInvoiceTotal();
            // console.log('asdfghj');
            let tr = button.closest('tr');
            //tr.parentNode.removeChild('tr');
            tr.remove();
            calculate();
            console.log(tr);
            //calculate();
        }

        $('body').on('click change keyup', '.quantity, .amount', function() {
                //console.log('changeeeee');
                calculate();
            });

        function calculate() {
            var total = 0;
            var total_quantity = 0;
            $('.item').each(function(i, obj) {
                var quantity = parseFloat($('.quantity:eq(' + i + ')').val() || 0);
                var amount = parseFloat($('.amount:eq(' + i + ')').val() || 0);
                $('.total:eq(' + i + ')').val('' + (quantity * amount).toFixed(2));

                total += (quantity * amount);
                total_quantity += quantity;
            });
            var sub_total = parseFloat(total);
            $('#sub_total').val('' + total.toFixed(2));
        }

    </script>
@endsection
