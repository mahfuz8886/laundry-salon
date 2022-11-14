<!DOCTYPE html>
<html>

<head>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- Ionicons -->
    {{-- <link rel="stylesheet"
        href="{{ asset('public/backEnd/') }}/plugins/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bbootstrap 4 -->
    {{-- <link rel="stylesheet"
        href="{{ asset('public/backEnd/') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> --}}

    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/adminlte.min.css"> --}}
    <!-- overlayScrollbars -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <!-- custom css -->
    {{-- <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/dist/css/custom.css"> --}}
</head>

<body>




    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <h5 class="card-header text-uppercase"> {{ Session::get('section') }} </h5>
                <div class="card-body">

                    <div class="d-flex">
                        <div class="mr-auto p-2">
                            @php
                                $list = $income_lists;
                                $income = App\SalonTransectionInfo::where('id', $list[0]->ref_table_id)->first();
                            @endphp
                            Invoice No.:&nbsp;<b> {{ $income->invoice_no }} </b>
                        </div>
                        <div class="p-2">
                            Date:&nbsp;<b> {{ date('d-M-Y', strtotime($income->issue_date)) }} </b>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">@lang('common.sl.')</th>
                                    <th>@lang('common.head_name')</th>
                                    <th>@lang('common.quantity')</th>
                                    <th>@lang('common.amount')</th>
                                    <th>@lang('common.total')</th>
                                </tr>
                            </thead>

                            <tbody class="rowContainer">
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($income_lists as $income_list)
                                    @php
                                        $total = $total + ($income_list->quantity * $income_list->amount);
                                    @endphp
                                    <tr class="item">
                                        <td class="text-center"> {{ ++$loop->index }} </td>
                                        <td>
                                            {{ $income_list->account_head->head_name }}
                                        </td>
                                        <td>
                                            {{ $income_list->quantity }}
                                        </td>
                                        <td>
                                            {{ $income_list->amount }}
                                        </td>
                                        <td>
                                            {{ $income_list->quantity * $income_list->amount }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                            <tfoot>
                                <th colspan="3">
                                <td class="text-right"> <label for=""> @lang('common.total') </label> </td>
                                <td>
                                    {{ $total }}
                                </td>
                                </th>
                            </tfoot>

                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

  <h1> Hello </h1>





</body>

</html>
