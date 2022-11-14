@extends('backEnd.layouts.master')
@section('title','Super Admin Dashboard')
@section('content')
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@lang('common.dashborad')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">@lang('common.home')</a></li>
            <li class="breadcrumb-item active">@lang('common.dashborad')</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
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
          <!-- main col end -->
           <!-- <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card custom-card dashboard-body">
                  <div class="col-sm-12">
                    <div class="manage-button">
                      <div class="body-title">
                        <h5>@lang('common.overall_status')</h5>
                      </div>
                    </div>
                  </div>
              </div>
          </div> -->
          <!-- main col end -->
       </div>
       <!-- <div class="row">
        <div class="col-sm-12">
         <div class="card">
           <div class="card-header">
             <h3>@lang('common.parcel_statistics')</h3>
           </div>
           <div class="card-body">
             <canvas id="myChart"></canvas>
           </div>
         </div>
        </div>
      </div> -->
    </div>
  </div>
</section>

<script>
   var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: [@foreach($parceltypes as $parceltype)'{{$parceltype->title}}',@endforeach],
        datasets: [{
            label: 'Parcel Statistics',
            backgroundColor:['#1D2941','#5F45DA','#670A91','#096709','#FFAC0E','#AAB809','#2094A0','#9A8309','#C21010'],
            borderColor:['#1D2941','#5F45DA','#670A91','#096709','#FFAC0E','#AAB809','#2094A0','#9A8309','#C21010'],
             data: [@foreach($parceltypes as $parceltype)
             @php
             $parcelcount = App\Parcel::where('status',$parceltype->id)->count();
             @endphp {{$parcelcount}}, @endforeach]
        }]
    },

    // Configuration options go here
    options: {}
});
 </script>
@endsection