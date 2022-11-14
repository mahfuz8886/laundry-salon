<?php

namespace App\Http\Controllers\Editor;

use App\Agent;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Parcel;
use App\Codcharge;
use App\Deliveryman;
use App\Deliverycharge;
use App\DeliveryChargeHead;
use App\Division;
use App\Merchant;
use DB;
use Auth;
use App\Post;
use App\Parcelnote;
use App\Parceltype;
use App\Pickupman;
use App\PromotionalDiscount;
use App\Thana;
use App\Weight;
use Mail;
use Exception;
use Illuminate\Support\Facades\Session;

class ParcelManageController extends Controller
{
    public function parcel(Request $request)
    {

        $parceltype = Parceltype::where('slug', $request->slug)->first();
        $per_page = $request->per_page ?? 10;

        $show_data = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.status', $parceltype->id);
                if ($request->trackId != NULL) {
                    $show_data = $show_data->where('parcels.trackingCode', $request->trackId);
                }
                if ($request->merchantId != NULL) {
                    $show_data->where('parcels.merchantId', $request->merchantId);
                }
                if ($request->companyname != NULL) {
                    $show_data = $show_data->where('merchants.companyName', 'like', '%' . $request->companyname . '%');
                }
                if ($request->phoneNumber != NULL) {
                    $show_data = $show_data->where('parcels.recipientPhone', $request->phoneNumber);
                }
                if ($request->startDate != NULL && $request->endDate != NULL) {
                    $show_data = $show_data->whereDate('parcels.created_at', '>=', $request->startDate)
                    ->whereDate('parcels.created_at', '<=', $request->endDate);
                }

                $show_data = $show_data->orderBy('id', 'DESC')
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid');

                if ($per_page == 'all') {
                    $show_data = $show_data->get();
                } else {
                    $show_data = $show_data->paginate($per_page);
                }


        $merchants = Merchant::where('status', 1)->verify()->get();
        return view('backEnd.parcel.parcel', compact('show_data', 'parceltype', 'merchants'));
    }
    public function multipleParcelPick(Request $request)
    {
        $allparcel = null;
        $merchants = Merchant::where('status', 1)->verify()->get();
        if ($request->merchant_id) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', $request->merchant_id)
                ->where('parcels.status', 1)
                ->orderBy('parcels.id', 'DESC')
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->get();
        }


        return view('backEnd.parcel.multiple_parcel_pick', compact('allparcel', 'merchants'));
    }

    public function multipleParcelPicked(Request $request)
    {
        $this->validate($request, [
            'parcel_select' => 'required'
        ]);
        $total_parcel = 0;
        $tracking_codes = '';

        foreach ($request->parcel_select ?? [] as $parcel_id) {
            $parcel = Parcel::find($parcel_id);
            $merchantinfo = Merchant::find($parcel->merchantId);
            $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();

            if ($parcel) {
                $parcel->pickup_date = now();
                if ($pickupmanInfo) {
                    $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                    $parcel->pickupman_paid = 0;
                    $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                }

                $parcel->status = 2;
                $parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $parcel_id;
                $note->note = "Your parcel PICKED";
                $note->save();

                // Send Customer Message 
                if ($parcel->recipientPhone) {
                    $customer_numbers = $parcel->recipientPhone;
                    $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is PICKED. \r\n Regards,\r\n Sensor Courier ";
                    $this->sendSMS($customer_numbers, $customer_msg);
                }

                $total_parcel += 1;
                $tracking_codes .= $parcel->trackingCode . ',';
            }
        }

        $numbers = "0" . $merchantinfo->phoneNumber;
        $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID $tracking_codes are PICKED.
                        Regards,
                        Sensor Courier";
        $this->sendSMS($numbers, $msg);

        return redirect()->back()->with('success', $total_parcel . ' parcel picked successfully done.');
    }

    // public function getDatatableData() {

    // }


    public function invoice($id)
    {
        $show_data = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
            ->where('parcels.id', $id)
            ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();
        return view('backEnd.parcel.invoice', compact('show_data'));
    }

    public function agentasign(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'agentId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->agentId = $request->agentId;
        $parcel->save();

        $agentInfo = Agent::find($request->agentId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Agent Asign";
        $note->remark = $agentInfo->name . ' - ' . $agentInfo->phone;
        $note->save();

        Toastr::success('message', 'A agent asign successfully!');
        return redirect()->back();
    }



    public function pickupmanasign(Request $request)
    {
        $this->validate($request, [
            'pickupmanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->pickupmanId = $request->pickupmanId;
        $parcel->save();

        $pickupman = Pickupman::find($request->pickupmanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Pickupman Asign";
        $note->remark = $pickupman->name . ' - ' . $pickupman->phone;
        $note->save();

        Toastr::success('message', 'A Pickupman asign successfully!');
        return redirect()->back();
        $pickupmanInfo = Pickupman::find($parcel->pickupmanId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        // if ($merchantinfo->emailAddress) {
        //     $data = array(
        //         'contact_mail' => $merchantinfo->emailAddress,
        //         'ridername' => $pickupmanInfo->name,
        //         'riderphone' => $pickupmanInfo->phone,
        //         'codprice' => $parcel->cod,
        //         'trackingCode' => $parcel->trackingCode,
        //     );
        //     $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
        //         $textmsg->from('info@sensorbd.com');
        //         $textmsg->to($data['contact_mail']);
        //         $textmsg->subject('Percel Assign Notification');
        //     });
        // }
    }

    public function deliverymanasign(Request $request)
    {
        $this->validate($request, [
            'deliverymanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->deliverymanId = $request->deliverymanId;
        $parcel->save();

        $deliveryman = Deliveryman::find($request->deliverymanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Deliveryman Asign";
        $note->remark = $deliveryman->name . ' - ' . $deliveryman->phone;
        $note->save();

        Toastr::success('message', 'A deliveryman asign successfully!');
        return redirect()->back();
        $deliverymanInfo = Deliveryman::find($parcel->deliverymanId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        // if ($merchantinfo->emailAddress) {
        //     $data = array(
        //         'contact_mail' => $merchantinfo->emailAddress,
        //         'ridername' => $deliverymanInfo->name,
        //         'riderphone' => $deliverymanInfo->phone,
        //         'codprice' => $parcel->cod,
        //         'trackingCode' => $parcel->trackingCode,
        //     );
        //     $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
        //         $textmsg->from('info@sensorbd.com');
        //         $textmsg->to($data['contact_mail']);
        //         $textmsg->subject('Percel Assign Notification');
        //     });
        // }
    }


    public function parcelupdatebyselect(Request $request)
    {

        $selectLength = ($request->parcel_select) ? count($request->parcel_select) : 0;

        if ($request->updstatus && $selectLength > 0) {
            $totalSuccess = 0;
            foreach ($request->parcel_select as $parcelId) {
                $parcel = Parcel::find($parcelId);
                $merchantinfo = Merchant::find($parcel->merchantId);
                $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
                $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();

                if ($request->updstatus == 1) {
                    $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
                    $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
                } elseif ($request->updstatus == 2) {
                    $parcel->pickup_date = now();
                    if ($pickupmanInfo) {
                        $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                        $parcel->pickupman_paid = 0;
                        $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                        $parcel->save();
                    }

                    if ($pickupmanInfo != NULL) {
                        // Sens Merchant message
                        $numbers = "0" . $merchantinfo->phoneNumber;
                        $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID $parcel->trackingCode for $pickupmanInfo->name , $pickupmanInfo->phone is PICKED.
                        Regards,
                        Sensor Courier";
                        $this->sendSMS($numbers, $msg);
                    }

                    // Send Customer message
                    if ($parcel->recipientPhone) {
                        $customer_numbers = $parcel->recipientPhone;
                        $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is PICKED. \r\n Regards,\r\n Sensor Courier ";
                        $this->sendSMS($customer_numbers, $customer_msg);
                    }
                } elseif ($request->updstatus == 3) {
                    $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
                    $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
                } elseif ($request->updstatus == 4) {
                    $parcel->merchantDue = $parcel->merchantAmount;
                    $parcel->delivery_date = now();
                    if ($deliverymanInfo) {
                        $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                        $parcel->deliveryman_paid = 0;
                        $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
                    }
                    $parcel->save();
                    $validMerchant = Merchant::find($parcel->merchantId);

                    // Sens Merchant message
                    $numbers = "0" . $validMerchant->phoneNumber;
                    $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier";
                    $this->sendSMS($numbers, $msg);

                    // Sens Customer message
                    $customer_numbers = $parcel->recipientPhone;
                    $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier ";
                    $this->sendSMS($customer_numbers, $customer_msg);
                } elseif ($request->updstatus == 5) {
                    if ($deliverymanInfo) {
                        // Send Customer message
                        $customer_numbers = $parcel->recipientPhone;
                        $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $deliverymanInfo->name , $deliverymanInfo->phone is on HOLD. \r\n Regards,\r\n Sensor Courier ";
                        $this->sendSMS($customer_numbers, $customer_msg);
                    }
                } elseif ($request->updstatus == 9) {
                    if ($parcel->updstatus < 2) {
                        $parcel->cod = 0;
                        $parcel->merchantAmount = 0;
                        $parcel->merchantDue = 0;
                        $parcel->deliveryCharge = 0;
                        $parcel->codCharge = 0;
                    }
                } else {
                    $parcel->cod = 0;
                    $parcel->codCharge = 0;
                    $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge);
                    $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
                    // Send Merchant message
                    $numbers = "0" . $merchantinfo->phoneNumber;
                    $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is RETURN. \r\n Regards,\r\n Sensor Courier";
                    $this->sendSMS($numbers, $msg);
                }

                $parcel->status = $request->updstatus;
                $parcel->save();

                $pnote = Parceltype::find($request->updstatus);
                $note = new Parcelnote();
                $note->parcelId = $parcelId;
                $note->note = "Your parcel " . $pnote->title;
                $note->save();

                $totalSuccess += 1;
            }

            Toastr::success('message', $totalSuccess . ' Parcel information update successfully!');
            return redirect()->back();
        } else {
            Toastr::error('Opps', 'Please ensure that you have select any record!');
            return redirect()->back();
        }
    }


    public function statusupdate(Request $request)
    {

        $this->validate($request, [
            'hidden_id' => 'required',
            'status' => 'required',
        ]);

        $parcel = Parcel::find($request->hidden_id);
        $merchantinfo = Merchant::find($parcel->merchantId);
        $pickupmanInfo = pickupman::where(['id' => $parcel->pickupmanId])->first();
        $deliverymanInfo = Deliveryman::where(['id' => $parcel->pickupmanId])->first();

        if ($request->updstatus == 1) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->updstatus == 2) {
            $parcel->pickup_date = now();
            if ($pickupmanInfo) {
                $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                $parcel->pickupman_paid = 0;
                $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                $parcel->save();
            }

            if ($pickupmanInfo != NULL) {
                // Sens Merchant message
                $numbers = "0" . $merchantinfo->phoneNumber;
                $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID $parcel->trackingCode for $pickupmanInfo->name , $pickupmanInfo->phone is PICKED.
                        Regards,
                        Sensor Courier";
                $this->sendSMS($numbers, $msg);
            }

            if ($parcel->recipientPhone) {
                $msg = "Dear " . $parcel->recipientName . ", Your Parcel Tracking ID $parcel->trackingCode is PICKED.
                        Regards,
                        Sensor Courier";
                $this->sendSMS($parcel->recipientPhone, $msg);
            }
        } elseif ($request->updstatus == 3) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->updstatus == 4) {
            $parcel->merchantDue = $parcel->merchantAmount;
            $parcel->delivery_date = now();
            if ($deliverymanInfo) {
                $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                $parcel->deliveryman_paid = 0;
                $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
            }
            $parcel->save();
            $validMerchant = Merchant::find($parcel->merchantId);
            // Sens Merchant message
            $numbers = "0" . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier";
            $this->sendSMS($numbers, $msg);

            // Sens Customer message
            $customer_numbers = $parcel->recipientPhone;
            $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier ";
            $this->sendSMS($customer_numbers, $customer_msg);
        } elseif ($request->updstatus == 5) {
            if ($deliverymanInfo) {
                // Send Customer message
                $customer_numbers = $parcel->recipientPhone;
                $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $deliverymanInfo->name , $deliverymanInfo->phone is on HOLD. \r\n Regards,\r\n Sensor Courier ";
                $this->sendSMS($customer_numbers, $customer_msg);
            }
        } elseif ($request->updstatus == 9) {
            if ($parcel->updstatus < 2) {
                $parcel->cod = 0;
                $parcel->merchantAmount = 0;
                $parcel->merchantDue = 0;
                $parcel->deliveryCharge = 0;
                $parcel->codCharge = 0;
            }
        } else {
            $parcel->cod = 0;
            $parcel->codCharge = 0;
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
            // Send Merchant message
            $numbers = "0" . $merchantinfo->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is RETURN. \r\n Regards,\r\n Sensor Courier";
            $this->sendSMS($numbers, $msg);
        }

        $parcel->status = $request->updstatus;
        $parcel->save();

        $pnote = Parceltype::find($request->updstatus);
        $note = new Parcelnote();
        $note->parcelId = $parcel->id;
        $note->note = "Your parcel " . $pnote->title;
        $note->save();

        Toastr::success('message', 'Parcel information update successfully!');
        return redirect()->back();
    }

    public function create()
    {
        $merchants = Merchant::orderBy('id', 'DESC')->get();
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        $weights = Weight::where('status', 1)->get();
        return view('backEnd.addparcel.create', compact('merchants', 'weights', 'delivery_charge_heads', 'divisions', 'pickup_thanas'));
    }

    public function parcelstore(Request $request)
    {
        $this->validate($request, [
            'merchantId' => 'required',
            'weight_id' => 'required|numeric',
            'name' => 'required',
            'phonenumber' => 'required',
            // 'pickup_thana_id' => 'required',
            // 'pickLocation' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'delivery_address' => 'required',
        ]);

        //clear session
        Session::forget('codpay');
        Session::forget('pcodecharge');
        Session::forget('pdeliverycharge');

        $mercharntInfo = Merchant::where('id', $request->merchantId)->first();
        $weight = Weight::find($request->weight_id);
        $thana = Thana::find($request->thana_id);
        if (empty($thana->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }
        $percelType = 1;
        if ($request->productPrice > 0) {
            $percelType = 2;  // COD Collection
        }

        // get deliverycharge
        $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
        $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

        // Extra charge
        $extra_weight = $weight->value - 1;
        $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);


        // Promotional Charge
        $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->where('status', 1)->first();
        if ($promotiuonal_discount_exist) {
            $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
        } else {
            $promotiuonal_discount = 0;
        }
        $delivery_charge = $delivery_charge - $promotiuonal_discount;

        // cod charge
        // $codChargeInfo = Codcharge::where(['status' => 1])->first();
        $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
        $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

        $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
        $merchantDue = round($merchantAmount, 2);

        $tracking_code   = "SC-" . mt_rand(111111, 999999);
        $store_parcel = new Parcel;
        $store_parcel->invoiceNo = $request->invoiceno;
        $store_parcel->merchantId = $request->merchantId;
        $store_parcel->cod = $request->productPrice;
        $store_parcel->percelType = $percelType;
        $store_parcel->recipientName = $request->name;
        $store_parcel->recipientAddress = $request->delivery_address;
        $store_parcel->recipientPhone = $request->phonenumber;
        $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
        $store_parcel->pickLocation = $mercharntInfo->pickLocation;
        $store_parcel->productWeight = $weight->value;
        $store_parcel->trackingCode  = $tracking_code;
        $store_parcel->note = $request->note;
        $store_parcel->deliveryCharge = round($delivery_charge, 2);
        $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
        $store_parcel->codCharge = round($codcharge, 2);
        $store_parcel->division_id = $request->division_id;
        $store_parcel->district_id = $request->district_id;
        $store_parcel->thana_id = $request->thana_id;
        $store_parcel->area_id = $request->area_id;
        $store_parcel->delivery_address = $request->delivery_address;
        $store_parcel->productPrice = 0;
        $store_parcel->merchantAmount = $merchantAmount;
        $store_parcel->merchantDue = 0;
        $store_parcel->orderType = $deliveryChargeInfo->id;
        $store_parcel->codType = $deliveryChargeInfo->id;
        $store_parcel->status = 1;
        $store_parcel->save();

        $note = new Parcelnote();
        $note->parcelId = $store_parcel->id;
        $note->note = 'Parcel create successfully';
        $note->save();

        Toastr::success('Success!', 'Thanks! your parcel add successfully');
        return redirect('editor/parcel/pending');
    }

    public function parceledit($id)
    {
        $edit_data = Parcel::find($id);
        $merchants = Merchant::orderBy('id', 'DESC')->get();
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        $weights = Weight::where('status', 1)->get();
        return view('backEnd.addparcel.edit', compact('edit_data', 'merchants', 'weights', 'delivery_charge_heads', 'divisions', 'pickup_thanas'));
    }

    public function parcelupdate(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'merchantId' => 'required',
            'weight_id' => 'required|numeric',
            'name' => 'required',
            'phonenumber' => 'required',
            // 'pickup_thana_id' => 'required',
            // 'pickLocation' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'delivery_address' => 'required',
        ]);

        $update_parcel = Parcel::find($request->hidden_id);
        $mercharntInfo = Merchant::where('id', $request->merchantId)->first();
        $weight = Weight::find($request->weight_id);
        $thana = Thana::find($request->thana_id);
        if (empty($thana->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }
        $percelType = 1;
        if ($request->productPrice > 0) {
            $percelType = 2;  // COD Collection
        }

        // get deliverycharge
        $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
        $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

        // Extra charge
        $extra_weight = $weight->value - 1;
        $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

        // Promotional Charge
        $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->where('status', 1)->first();
        if ($promotiuonal_discount_exist) {
            $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
        } else {
            $promotiuonal_discount = 0;
        }
        $delivery_charge = $delivery_charge - $promotiuonal_discount;


        // cod charge
        // $codChargeInfo = Codcharge::where(['status' => 1])->first();
        $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
        $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

        $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
        $merchantDue = round($merchantAmount - $update_parcel->merchantPaid, 2);

        // Update parcel
        $update_parcel->invoiceNo = $request->invoiceno;
        $update_parcel->merchantId = $request->merchantId;
        $update_parcel->cod = $request->productPrice;
        $update_parcel->percelType = $percelType;
        $update_parcel->recipientName = $request->name;
        $update_parcel->recipientAddress = $request->delivery_address;
        $update_parcel->recipientPhone = $request->phonenumber;
        $update_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
        $update_parcel->pickLocation = $mercharntInfo->pickLocation;
        $update_parcel->productWeight = $weight->value;
        $update_parcel->note = $request->note;
        $update_parcel->deliveryCharge = round($delivery_charge, 2);
        $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
        $update_parcel->codCharge = round($codcharge, 2);
        $update_parcel->division_id = $request->division_id;
        $update_parcel->district_id = $request->district_id;
        $update_parcel->thana_id = $request->thana_id;
        $update_parcel->area_id = $request->area_id;
        $update_parcel->delivery_address = $request->delivery_address;
        $update_parcel->productPrice = 0;
        $update_parcel->merchantAmount = $merchantAmount;
        $update_parcel->merchantDue = 0;
        $update_parcel->orderType = $deliveryChargeInfo->id;
        $update_parcel->codType = $deliveryChargeInfo->id;
        $update_parcel->status = 1;
        $update_parcel->save();

        $note = new Parcelnote();
        $note->parcelId = $update_parcel->id;
        $note->note = 'Parcel updated successfully';
        $note->save();

        Toastr::success('Success!', 'Thanks! your parcel update successfully');
        return redirect()->back();
    }

    public function merchants(Request $request)
    {
        $query = Merchant::where('status', 1);

        $merchants = $query->get();
        return view('backEnd.parcel.merchants', compact('merchants'));
    }

    public function merchantParcels(Request $request, $merchant_id)
    {
        $merchant = Merchant::find($merchant_id);
        $query = Parcel::where('merchantId', $merchant_id)->with('division', 'district', 'thana', 'area');
        if ($request->parcel_type) {
            $query = $query->where('status', $request->parcel_type);
        }
        $parcels = $query->paginate(20);
        return view('backEnd.parcel.merchant_parcels', compact('parcels', 'merchant'));
    }
}
