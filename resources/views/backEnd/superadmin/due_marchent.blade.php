@extends('backEnd.layouts.master')
@section('payment', 'active menu-open')
@section('title',"Due marchant")
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

.activated {
    background: #d3eb72 !important;
}

</style>

<section>
    <form action="{{url('superadmin/show_due_marchant')}}" method="get" >
        @csrf
        <div class="container">
              <div class="card m-2 mt-5">
                <div class="row m-3 d-flex justify-content-center align-items-center">
                   <div class="col-md-4 offset-md-1">
                       <div class="form-group">
                           <input type="text" placeholder="@lang('common.company_name')"  value="@isset($_GET['mcompany_name']){{$_GET['mcompany_name']}}@endisset"  name="mcompany_name" class="form-control">
                       </div>
                   </div>
                   
                   <div class="col-md-2">
                       <div class="form-group">
                           <input type="submit" class="btn rounded-lg shadow px-4 btn-success border-0" value="@lang('common.search')">
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
                <div class="card custom-card">
                    <div class="col-sm-12">
                      <div class="manage-button">
                        <div class="body-title">
                          <h5> @lang('common.merchant')</h5>
                        </div>
                      </div>
                    </div>
                  <div class="table-responsive ">
                      <table class="table table-bordered table-striped table-sm custom-table ">
                          <thead style="background: #afe2e5;">
                              <tr>
                                  <th>@lang('common.company_name')</th>
                                  <th>@lang('common.payment_method')</th>
                                  <th>@lang('common.due')</th>
                                  <th class="text-center">@lang('common.action')</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                              <?php
                              $i = 0;
                                  foreach($results as $result) {

                                    /*.....total return delivery charge.....*/
                                    
                                    $returnDelCharge = DB::table('parcels')->where([
                                        ['merchantId', '=', $result->id],
                                        ['status', '>', '5'],
                                        ['status', '<', '9'],
                                    ])->sum('deliveryCharge');
                                    
                                    /*.....total return delivery charge.....*/    
            
            
                                    /*.....total delivered prepaid parcel delivery charge.....*/
                                    
                                    $prepDelAmount = App\Parcel::where(['merchantId'=>$result->id,'status'=>4,'percelType'=>1])->sum('deliveryCharge');   
                                    
                                    /*.....total delivered prepaid parcel delivery charge.....*/
                                    
                                    /*.....total marchant amount....*/
                                    $totalamount = App\Parcel::where(['merchantId'=>$result->id,'status'=>4])->sum('merchantAmount') - ($returnDelCharge + $prepDelAmount);
                                    /*.....total marchant amount....*/
                                  
                                    $allPaidParcels = App\Parcel::where(['merchantId'=>$result->id,'merchantpayStatus'=>1])->get();
            
                                    $total = 0;
                                    $totalDel = 0;
                                    foreach($allPaidParcels as $key=>$parcel) {
                                        if(($parcel->status > 5 && $parcel->status < 9) || ($parcel->percelType == 1 && $parcel->status == 4) ) {
                                            $totalDel += $parcel->deliveryCharge;
                                        }else {
                                            if($parcel->percelType == 2 && $parcel->status == 4) {
                                                $total += $parcel->merchantAmount;
                                            }
                                        }
                                    }
                                    
                                    
                                    $merchantPaid = $total - $totalDel;
          
                                    $merchantUnPaid= $totalamount - $merchantPaid;
                                    
                                     ?>
                                        <tr>
                                             <td>{{$result->companyName}}</td>
                                             <td>
                                                @if($result->paymentMethod == 1)
                                                    Bank
                                                @elseif($result->paymentMethod == 2)  
                                                    Bkash
                                                @elseif($result->paymentMethod == 3)
                                                    Rocket
                                                @elseif($result->paymentMethod == 4)
                                                    Nagad
                                                @else
                                                    Not set yet
                                                @endif
                                              </td>
                                              <td>{{$merchantUnPaid}}</td>
                                              <td class="text-center">
                                                  <a href="{{url('superadmin/payment_due_marchant/'.$result->id)}}" class="btn btn-success btn-sm"><i class="fas fa-cog"></i></a>
                                              </td>
                                         </tr>
                            <?php }
                              ?>
                          </tbody>
                          
                      </table>
                  </div>
                 
                  <div class="pagination-container d-flex justify-content-center mt-5">
                      {{$results->links()}}
                  </div>
                  
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
          </div>
        </div>
    </div>
  </section>
  
  <script>
    
    $(document).ready(function () {
    
        $('table tr').each(function(a,b){
            $(b).click(function(){
                 $('table tr').removeClass('activated');
                 $(this).addClass('activated');   
            });
        });
    
    
    });
      
  </script>
  
  
  
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
