 <div class="">
     
     <table class="table table-bordered table-hover">
      <thead>
        <tr class="table-success">
            <th>SL no.</th>
            <th>Company Name</th>
            <th>Ricipient</th>
            <th>Tracking ID</th>
            <th>Area</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Created  Date</th>
            <th>Last Update</th>
            <th>Status</th>
            <th>Total</th>
            <th>Charge</th>
            <th>Sub Total</th>
            <th>Actual Price</th>
         </tr>
      </thead>
      <tbody>
           @foreach($show_data as $key=>$value)
            <tr>
              <td>{{$loop->iteration}}</td>
              @php
                $merchant = App\Merchant::find($value->merchantId);
                $agentInfo = App\Agent::find($value->agentId);
                $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                 $pickupmanInfo = App\Deliveryman::find($value->pickupmanId);
              @endphp
               <td>{{$merchant->companyName}}</td>
              <td>{{$value->recipientName}}</td>
              <td>{{$value->trackingCode}}</td>
              <td>{{DB::table('nearestzones')->where('id',$value->reciveZone)->value('zonename')}}</td>
              <td>{{$value->recipientAddress}}</td>
              <td>{{$value->recipientPhone}}</td>
              <td>{{date('F d, Y', strtotime($value->created_at))}}</td>
              <td>{{date('F d, Y', strtotime($value->updated_at))}}</td>
              <td>{{DB::table('parceltypes')->where('id',$value->status)->value('title')}}</td>
              <td> {{$value->cod}}</td>
              <td> {{$value->deliveryCharge+$value->codCharge}}</td>
              <td> {{$value->cod-($value->deliveryCharge+$value->codCharge)}}</td>
              <td>{{$value->productPrice}}</td>
            </tr>
            @endforeach
      </tbody>
</table>
 </div>