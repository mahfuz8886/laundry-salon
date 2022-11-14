<?php

namespace App\Http\Controllers\Superadmin;

use App\Deliveryman;
use App\DeliverymanPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Parcel;

class DeliverymanPaymentController extends Controller
{
    public function deliverymanPaymentSummary(Request $request){
        $deliverymen = Deliveryman::where('status', 1)->paginate(15);
        return view('backEnd.deliveryman_payment.payment_summary', compact('deliverymen'));
    }

    public function deliverymanPayments(Request $request, $type, $deliverymanId){
        $deliveryman = Deliveryman::find($deliverymanId);
        $query = Parcel::where('deliverymanId', $deliverymanId)->where('status', '>',1);
        if ($type=='paid') {
            $query->where('deliveryman_paid', '>',0);
        }

        if ($type=='due') {
            $query->where('deliveryman_due', '>',0);
        }

        $deliveryman_parcels = $query->paginate(15);

        return view('backEnd.deliveryman_payment.deliveryman_payments', compact('deliveryman_parcels','deliveryman','type'));
    }

    public function deliverymanPayment(Request $request){
        $this->validate($request, [
            'parcel_id' => 'required'
        ]);

        foreach($request->parcel_id as $parcel_id){
            $parcel = Parcel::find($parcel_id);
            $parcel->deliveryman_paid = $parcel->deliveryman_amount;
            $parcel->deliveryman_due = $parcel->deliveryman_amount-$parcel->deliveryman_paid;
            $parcel->save();

            $payment = DeliverymanPayment::create([
                'deliveryman_id' => $request->deliverymanId,
                'parcel_id' => $parcel_id,
                'amount' => $parcel->deliveryman_paid,
            ]);
            $payment->invoice_no = str_pad($payment->id, 0, 5, STR_PAD_LEFT);
            $payment->save();
        }
        $msg = count($request->parcel_id).' percel paid successfully done.';
        return redirect()->back()->with('success', $msg);
    }

    public function deliverymanPaymentInvoice(Request $request, $parcel_id){
        $parcel = Parcel::find($parcel_id);
        $payment = DeliverymanPayment::where('parcel_id', $parcel_id)->first();
        return view('backEnd.deliveryman_payment.payment_invoice', compact('parcel','payment'));
    }
}
