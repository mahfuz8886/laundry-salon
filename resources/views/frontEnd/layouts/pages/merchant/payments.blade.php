@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('payment_status','active')
@section('title','Payments')
@section('content')
<div class="profile-edit mrt-30">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 style="margin-bottom: 10px;">@lang('common.payments')</h4>
                    </div>
                     <div class="col-sm-12">
                         <div class="payments-inner table-responsive-sm">
                           <table class="table  table-striped">
                             <tr>
                               <th>@lang('common.sl')</th>
                               <th>@lang('common.date')</th>
                               <th>@lang('common.total_invoice')</th>
                               <th>@lang('common.total_payment')</th>
                               <th>@lang('common.more')</th>
                             </tr>
                             @foreach($merchantInvoice as $key=>$value)
                              @php
                                $parcelinfo = App\Parcel::where('paymentInvoice',$value->id)->get();
                                $totalinvoice = App\Parcel::where('paymentInvoice',$value->id)->count();
                             @endphp
                            <tr>
                             <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$value->created_at}}</td>
                              <td>{{$totalinvoice}}</td>
                              <td>
                                  @php
                                    $total = 0;
                                    $totaldel = 0;
                                    foreach($parcelinfo as $key=>$parcel) {
                                        if(($parcel->status > 5 && $parcel->status < 9) || ($parcel->percelType == 1)) {
                                            $totaldel += $parcel->deliveryCharge;
                                        } else if($parcel->status == 4) {
                                            $total += $parcel->cod - ($parcel->deliveryCharge + $parcel->codCharge);
                                        }
                                    }
                                    
                                    echo $total - $totaldel;
                                    
                                  @endphp
                              </td>
                              <td> <a class="btn btn-primary" href="{{url('merchant/payment/invoice-details/'.$value->id)}}" title="View"><i class="fa fa-eye"></i> @lang('common.view')</a></td>
                             </tr>
                             @endforeach
                           </table>
                         </div>
                      </div>
                  </div>
        </div>
    </div>
    <!-- row end -->
</div>


@endsection