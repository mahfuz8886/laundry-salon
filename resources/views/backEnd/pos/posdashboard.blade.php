@extends('backEnd.layouts.master')
@section('title','Pos')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="box-content">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
          <div class=" custom-card dashboard-body">
                <div class="col-sm-12">
                  <div class="manage-button">
                    <div class="body-title">
                      <h5>@lang('common.parcel_overall_status')</h5>
                    </div>
                  </div>
                </div>
              <div>
                  <div class="row">
                    @foreach($parceltypes as $key=>$value)
                    @php
                      $parcelcount = App\Parcel::where('status',$value->id)->count();
                    @endphp
                     <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                          <span class="info-box-icon">
                          @switch($key)
                              @case(0)
                                  <i class="fab fa-algolia"></i>
                                  @break
                              @case(1)
                                  <i class="fas fa-tasks"></i>
                                  @break
                              @case(2)
                                  <i class="fas fa-car"></i>
                                  @break
                              @case(3)
                                  <i class="fas fa-check-circle"></i>
                                  @break
                              @case(4)
                                  <i class="fas fa-pause-circle"></i>
                                  @break
                              @case(5)
                                  <i class="fas fa-sync-alt"></i>
                                  @break
                              @case(6)
                                  <i class="fas fa-bezier-curve"></i>
                                  @break
                              @case(7)
                                  <i class="fas fa-diagnoses"></i>
                                  @break
                              @case(8)
                                  <i class="fas fa-ban"></i>
                                  @break
                              @default
                                <i class="fas fa-chart-bar"></i>
                          @endswitch
                            
                          </span>
                          <div class="info-box-content">
                            <a href="{{url('editor/parcel',$value->slug)}}">
                            <span class="info-box-text" style="color:green;">{{$value->title}}</span>
                            <span class="info-box-number" style="color:green;">{{$parcelcount}}</span>
                            </a>
                          </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                      </div>
                      <!-- col end -->
                      @endforeach
                  </div>
              </div>
            </div>
        </div>
        <!-- main col end -->
         <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="custom-card dashboard-body mt-3">
                <div class="col-sm-12">
                  <div class="manage-button">
                    <div class="body-title">
                      <h5>@lang('common.payment_overall_status')</h5>
                    </div>
                  </div>
                </div>
              <div>
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-university"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-title">@lang('common.total_amount')</span>
                          <span class="info-box-number">{{$totalamounts}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- col end -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-sort-amount-up-alt text-danger"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-title">@lang('common.merchant_due_amount')  </span>
                          <span class="info-box-number">{{$merchantsdue}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- col end -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-sort-amount-up"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-title">@lang('common.merchant_paid_amount')  </span>
                          <span class="info-box-number">{{$merchantspaid}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- col end -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fab fa-cc-mastercard"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-title">@lang('common.today_monthly_payment')</span>
                          <span class="info-box-number">{{$todaymerchantspaid}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- col end -->
                  </div>
              </div>
            </div>
        </div>
     </div>
  </div>
</div>
</section>

@endsection