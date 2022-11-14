@extends('backEnd.layouts.master')
@section('title',"Daily")
@section('content')
<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible !important;
  }
  #printSection {
    position:absolute !important;
    left:0;
    top:0;
  }
}
</style>

<section>
    <form action="{{url('superadmin/date_to_date_reports')}}" method="get" >@csrf
    <div class="container">
          <div class="card m-2 mt-5">
            <div class="row m-3 ">
               <div class="col-md-4 offset-md-1">
                   <div class="form-group">
                       <input type="text" placeholder="start date"  value="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  name="start_date" class="mydatesNew form-control  flatpickr-input">
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="form-group">
                       <input type="text" placeholder="end date" value="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" name="end_date" class="mydatesNew form-control  flatpickr-input">
                   </div>
               </div>
               <div class="col-md-2">
                   <div class="form-group">
                       <input type="submit" class="btn rounded-lg shadow px-4 btn-success border-0" value="show">
                   </div>
               </div>
           </div>
       </div>
    </div>
  </form>
</section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="box-content">
          <div class="row">
            <div class="col-sm-10 col-md-10 col-lg-10 mx-auto">
                <div class="card   custom-card">
                    <div class="col-sm-12">
                      <div class="manage-button">
                        <div class="body-title">
                          <h5> Parcels Order Report </h5>
                        </div>
                      </div>
                    </div>
                  <div class="table-responsive ">
                      <table class="table table-bordered table-striped table-sm custom-table ">
                          <thead>
                              @php 
                                  $totalOrder=0;
                              @endphp
                             
                              @foreach($parcels as $parcel)
                              <tr>
                                  <th width="50%"> 
                                     <a href="javascript:void(0)" segment ="{{Request::segment(2)}}" order_title = "{{$parcel->title}}"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset"  @if(count($parcel->parcels)>0)  data-toggle="modal"  data-target="#priceModal" @endif   class="modal_data_active"  P_id = "{{$parcel->id}}"     > {{$parcel->title}}  </a>
                                  </th>
                                  <th  width="50%">
                                     ({{count($parcel->parcels)}})
                                     @php
                                       $totalOrder+=count($parcel->parcels);
                                     @endphp
                                  </th>
                              </tr>
                              @endforeach
                              
                                <tr>
                                  <th>
                                      Total order 
                                  </th>
                                  <th>
                                      ( {{$totalOrder}} )
                                  </th>
                              </tr>
                              
                              <tr>
                                  <th>
                                      <a href="javascript:void(0)"  segment = "{{Request::segment(2)}}" order_title = "Picked"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" class="modal_data_active"  Picked_id = "2"  @if(count($picked_parcels)>0)   data-toggle="modal"  data-target="#priceModal" @endif    >Picked</a>
                                      </th>
                                  <th>({{count($picked_parcels)}})</th>
                              </tr>
                              <tr>
                                   <th><a href="javascript:void(0)"  segment = "{{Request::segment(2)}}" order_title = "Pending"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" class="modal_data_active"  Picked_id = "1"  @if(count($pending_parcels)>0)  data-toggle="modal"  data-target="#priceModal" @endif    >
                                       Pending</a></th>
                                  <th>({{count($pending_parcels)}})</th>
                              </tr>
                              <tr>
                                  <th><a href="javascript:void(0)"  segment = "{{Request::segment(2)}}" order_title = "Delivered"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" class="modal_data_active"  Picked_id = "4"  @if(count($delivered_parcels)>0)  data-toggle="modal"  data-target="#priceModal" @endif    >Delivered </a></th>
                                  <th>({{count($delivered_parcels)}})</th>
                              </tr>
                           
                              <tr>
                                  <th><a href="javascript:void(0)"  segment = "{{Request::segment(2)}}" order_title = "Hold"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" class="modal_data_active"  Picked_id = "5"  @if(count($hold_parcels)>0)  data-toggle="modal"  data-target="#priceModal" @endif    >Hold</a></th>
                                  <th>({{count($hold_parcels)}})</th>
                              </tr>
                              
                              <tr>
                                  <th><a href="javascript:void(0)"  segment = "{{Request::segment(2)}}" order_title = "Return"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" class="modal_data_active"  return_id = "6"  @if(count($return_parcels)>0)  data-toggle="modal"  data-target="#priceModal" @endif    >Return</a></th>
                                  <th>({{count($return_parcels)}})</th>
                              </tr>
                              
                              <tr>
                                  <th><a href="javascript:void(0)"  segment = "{{Request::segment(2)}}" order_title = "Paid"  start_date="@isset($_GET['start_date']){{$_GET['start_date']}}@endisset"  end_date="@isset($_GET['end_date']){{$_GET['end_date']}}@endisset" class="modal_data_active"  paid_id = "15"  @if(count($paid_parcels)>0)  data-toggle="modal"  data-target="#priceModal" @endif    >Paid</a></th>
                                  <th>({{count($paid_parcels)}})</th>
                              </tr>
                              
                          </thead>
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








<!-- Modal -->
<div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content " style="background: -webkit-linear-gradient(#d9ebeb,#d9ebeb);  
      background: -moz-linear-gradient(#d9ebeb,#d9ebeb);  
      background: -o-linear-gradient(#d9ebeb,#d9ebeb);  
       background: linear-gradient(#d9ebeb,#d9ebeb);
       background-repeat:no-repeat;">
      <div class="modal-header">
        <h5 class="modal-title modal_title_parcel"  > </h5>
         <button type="button" class="  btn-outline-danger btn-sm rounded-lg" style="outline:none" data-dismiss="modal"><i class="far fa-window-close"></i></button>
        
       <!-- <button type="button" class="close" data-dismiss="modal" style="outline:none" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <div class="modal-body priceModal_Body table-responsive">
      </div>
      <div class="text-right m-1">
        <button type="button" class="  btn-outline-danger btn-sm rounded-lg" style="outline:none" data-dismiss="modal">close</button>
         
      </div>
    </div>
  </div>
</div>



@endsection
