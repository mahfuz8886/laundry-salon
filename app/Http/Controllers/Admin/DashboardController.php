<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Parcel;
use App\Merchant;
use App\Merchantpayment;
use Mail;
class DashboardController extends Controller
{
    public function index(){
    	return view('backEnd.superadmin.maindashboard');
    }
    
    public function bulkpayment(Request $request){
        
        $selectption = $request->selectptions;
        
        if($selectption==1){
        	$payment = new Merchantpayment();
        	$payment->merchantId = $request->merchantId;
        	$payment->parcelId   = $request->parcelId;
        	$payment->save();
            $parcels_id = $request->parcel_id;
            $total = 0;
            $finaltotal = 0;
            $totaldelcharge = 0;
            foreach($parcels_id as $parcel_id){
                $parcel = Parcel::find($parcel_id);
                $parcel->paymentInvoice = $payment->id;
                $parcel->merchantPaid = $parcel->merchantAmount;
		    	$parcel->merchantDue = 0;
		    	$parcel->merchantpayDate = date("Y-m-d");
		    	$parcel->merchantpayStatus = 1;
		    	$parcel->save();
		    	if(($parcel->status > 5 && $parcel->status < 9) || ($parcel->percelType == 1)) {
                    $totaldelcharge += $parcel->deliveryCharge;
                } else if($parcel->status == 4) {
                    $total += $parcel->merchantPaid;
                }
            }
            
            $finaltotal = $total - $totaldelcharge;
            
         $totalparcel = count(collect($request)->get('parcel_id'));
         $validMerchant = Merchant::find($request->merchantId);
         
        //  new api
        $number = "0".$validMerchant->phoneNumber;
        $msg = "A Payment (Invoice No. SC-".$payment->id.") has been issued of ".$finaltotal." Tk where ".$totalparcel." Parcels were paid. Check Invoice on your dashboard. \r\n Regards,\r\n Sensor Courier ";
        $send_sms = $this->sendSMS($number,$msg);
          
        Toastr::success('message', 'Invoice Processing successfully!');
        return redirect('editor/merchant/payment/invoice/'.$request->merchantId);
        }elseif($selectption==0){
            $parcels_id = $request->parcel_id;
            foreach($parcels_id as $parcel_id){
                $parcel = Parcel::find($parcel_id);
                $parcel->merchantpayDate = null;
                $parcel->merchantpayStatus = 0;
		    	$parcel->save();
            
        }
        
         Toastr::success('message', 'Invoice Paid successfully!');
         return redirect()->back();
		}
	}

    public function sendMail(){
        $data = array('name'=>"Al Arfin");
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('alarfin@gmail.com', 'Tutorials Point')->subject
                ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com','Al Arfin');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
