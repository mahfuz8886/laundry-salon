@extends('backEnd.layouts.master')
@section('title','Manage Merchant Payment')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="box-content">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card custom-card">
                    <div class="col-sm-12">
                      <div class="manage-button">
                        <div class="body-title">
                          <h5>@lang('common.payments')</h5>
                        </div>
                      </div>
                    </div>
                  <div class="card-body">
                    <table id="example" class="table table-bordered table-striped custom-table">
                      <thead>
                      <tr>
                        <th>@lang('common.id')</th>
                        <th>@lang('common.date')</th>
                        <th>@lang('common.total_invoice')</th>
                        <th>@lang('common.total_payment')</th>
                        <th>@lang('common.action')</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($merchantInvoice as $key=>$value)
                         @php
                            $parcelinfo = App\Parcel::where('paymentInvoice',$value->id)->get();
                            
                            $totalinvoice = App\Parcel::where('paymentInvoice',$value->id)->count();
                         @endphp
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
                          <td>
                            <ul class="action_buttons dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">@lang('common.action_button')
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li>
                                      <a class="edit_icon" href="{{url('editor/merchant/payment/invoice-details/'.$value->id)}}" title="View"><i class="fa fa-eye"></i> @lang('common.view')</a>
                                  </li>
                              </ul>
                          </td>
                        </tr>
                        @endforeach
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
          </div>
        </div>
    </div>
  </section>
<!-- Modal Section  -->
@endsection