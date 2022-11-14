@extends('backEnd.layouts.master')
@section('title','Order Manage')
@section('content')
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
      @page { size: auto;  margin: 0mm; }
      @media print {
        header,
        footer {
            display: none !important;
        }
      }
    .invoice-box {
        max-width: 1100px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    .table.table-bordered.parcel-invoice td {
      padding: 5px 20px;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    p{
        margin:0;
    }
    </style>
</head>

<body>
  <div style="padding-top: 50px"></div>
  <button onclick="myFunction()" style="color: #fff;border: 0;padding: 6px 12px;margin-bottom: 8px !important;display: block;margin: 0 auto;margin-bottom: 0px;text-align: center;
background: #F32C01;
border-radius: 5px;"><i class="fa fa-print"></i></button>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                @foreach($whitelogo as $logo)
                                <img src="{{asset($logo->image)}}" style="width:100%; max-width:100px;">
                                @endforeach
                            </td>
                            
                            <td>
                               <p> @lang('common.invoice') #: SC-{{$invoiceInfo->id}}</p>
                                <p> @lang('common.date') : {{date('F d, Y', strtotime($invoiceInfo->created_at))}}</p>
                                <p> @lang('common.time'):  {{date('h:i:s a', strtotime($invoiceInfo->created_at))}}</p>
                                <p>@lang('common.merchant_name') : {{$merchantInfo->companyName}}</p>
                                <p>@lang('common.merchant_mobile') : {{$merchantInfo->phoneNumber}}</p>
                                <p></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered parcel-invoice">
          <tbody>
            <tr class="heading">
                <td>@lang('common.track_id')</td>
                <td>@lang('common.name')</td>
                <td>@lang('common.mobile')</td>
                <td>@lang('common.type')</td>
                <td>@lang('common.status')</td>
                <td>@lang('common.total')</td>
                <td>@lang('common.charge')</td>
                <td>@lang('common.sub_total')</td>
                <td>@lang('common.payments')</td>
            </tr>
            @php
              $total = 0;
              $totalDel = 0;
            @endphp
            @foreach($inovicedetails as $key=>$value)
            <tr class="item">
                <td>{{$value->trackingCode}}</td>
                <td>{{$value->recipientName}}</td>
                <td>{{$value->recipientPhone}}</td>
                <td>
                    @if ($value->percelType == 1)
                        Prepaid
                    @else
                        Cash collection
                    @endif
                </td>
                <td>
                    @if( $value->status > 5 && $value->status < 9 )
                        Return
                    @elseif ($value->status == 4)
                        Delivered
                    @endif
                </td>
    
                @if(($value->status > 5 && $value->status < 9) || ($value->percelType == 1) )
                <td>0</td>
                <td>{{$value->deliveryCharge}}</td>
                <td>-{{$value->deliveryCharge}}</td>
                <td>-{{$value->deliveryCharge}}/-</td>
              
                @else 
                <td>{{$value->cod}}</td>
                <td> {{$value->deliveryCharge+$value->codCharge}}</td>
                <td> {{$value->cod - ($value->deliveryCharge + $value->codCharge)}}</td>
                <td>{{$value->cod - ($value->deliveryCharge + $value->codCharge)}} /-</td>
                @endif
                
                
            </tr>
            @php
                if(($value->status > 5 && $value->status < 9) || ($value->percelType == 1) ) {
                    $totalDel += $value->deliveryCharge;
                }else if($value->status == 4) {
                    $total += $value->cod - ($value->deliveryCharge + $value->codCharge);
                }
            @endphp
            
            @endforeach

            <tr class="heading">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                 
                <td>{{$total - $totalDel}} /-</td>
                
                
            </tr>
          </tbody>
        </table>
        </div>
    </div>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
</body>
</html>
@endsection
