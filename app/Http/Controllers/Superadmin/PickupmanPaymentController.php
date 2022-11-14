<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Parcel;
use App\Pickupman;
use App\PickupmanPayment;

class PickupmanPaymentController extends Controller
{
    public function pickupmanPaymentSummary(Request $request){
        $pickupmen = Pickupman::where('status', 1)->paginate(15);
        return view('backEnd.pickupman_payment.payment_summary', compact('pickupmen'));
    }

    public function pickupmanPayments(Request $request, $type, $pickupmanId){
        $pickupman = Pickupman::find($pickupmanId);
        $query = Parcel::where('pickupmanId', $pickupmanId)->where('status', '>',1);
        if ($type=='paid') {
            $query->where('pickupman_due',0);
        }

        if ($type=='due') {
            $query->where('pickupman_due', '>',0);
        }

        $pickupman_parcels = $query->paginate(15);

        return view('backEnd.pickupman_payment.pickupman_payments', compact('pickupman_parcels','pickupman','type'));
    }

    public function pickupmanPayment(Request $request){
        $this->validate($request, [
            'parcel_id' => 'required'
        ]);

        foreach($request->parcel_id as $parcel_id){
            $parcel = Parcel::find($parcel_id);
            $parcel->pickupman_paid = $parcel->pickupman_amount;
            $parcel->pickupman_due = $parcel->pickupman_amount-$parcel->pickupman_paid;
            $parcel->save();

            $payment = PickupmanPayment::create([
                'pickupman_id' => $request->pickupmanId,
                'parcel_id' => $parcel_id,
                'amount' => $parcel->pickupman_paid,
            ]);
            $payment->invoice_no = str_pad($payment->id, 0, 5, STR_PAD_LEFT);
            $payment->save();

        }
        $msg = count($request->parcel_id).' percel paid successfully done.';
        return redirect()->back()->with('success', $msg);
    }

    public function pickupmanPaymentInvoice(Request $request, $parcel_id){
        $parcel = Parcel::find($parcel_id);
        $payment = PickupmanPayment::where('parcel_id', $parcel_id)->first();
        return view('backEnd.pickupman_payment.payment_invoice', compact('parcel','payment'));
    }
}
